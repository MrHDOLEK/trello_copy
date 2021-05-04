<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Validator;
use OpenPayU_Configuration;
use OpenPayU_Order;

class Order extends Model
{

    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status', 'user_id', 'subscription_id', 'invoice_data', 'updated_at', 'created_at', 'invoice_data', 'invoice', 'hash'
    ];

    protected $hidden = [

    ];

    private $status_completed = 1;
    private $status_not_completed = 0;
    private $free_tier_packets = 1;


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function packet()
    {
        return $this->hasOne(Packet::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function initPayu()
    {
        OpenPayU_Configuration::setEnvironment(env('NAME'));
        OpenPayU_Configuration::setMerchantPosId(env('POS_ID'));
        OpenPayU_Configuration::setSignatureKey(env('MD5_KEY'));
        OpenPayU_Configuration::setOauthClientId(env('CLIENT_ID'));
        OpenPayU_Configuration::setOauthClientSecret(env('CLIENT_SECRET'));
    }

    public function createOrder($user_id, int $sub_id, bool $invoice, array $user_personal_data)
    {
        $packets = Packet::where('id', $sub_id)->firstOrFail();
        if ($sub_id == $this->free_tier_packets) {
            return null;
        }
        if (self::validPersonalDates($user_personal_data, $invoice) === true) {
            return null;
        }
        $order = Order::create([
            'status' => $this->status_not_completed,
            'invoice' => $invoice,
            'invoice_data' => json_encode($user_personal_data),
            'hash' => rand(0, 99999999),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => $user_id,
            'subscription_id' => $sub_id
        ]);
        return self::createOrderPayu($order);

    }

    private function createOrderPayu(Order $order)
    {
        self::initPayu();
        $packet = Packet::where('id', $order->subscription_id)->get();
        $user = User::where('id', $order->user_id)->get('email');
        $user_data = self::getPersonalData($order->invoice_data);
        $payUPrice = $packet[0]->price;
        $order = [
            'continueUrl' => env('continueUrl') . $order->id,
            'customerIp' => $_SERVER['REMOTE_ADDR'],
            'merchantPosId' => OpenPayU_Configuration::getMerchantPosId(),
            'description' => $order->subscription_id,
            'currencyCode' => 'PLN',
            'totalAmount' => $payUPrice,
            'extOrderId' => $order->hash,
            'buyer' => [
                'email' => $user[0]->email,
                'phone' => $user_data->phone,
                'firstName' => $user_data->first_name,
                'lastName' => $user_data->last_name,
                'language' => 'pl',
            ],
            'products' => [
                [
                    'name' => $packet[0]->name,
                    'unitPrice' => $payUPrice,
                    'quantity' => 1
                ]
            ],
        ];

        $response = OpenPayU_Order::create($order);
        return $response->getResponse();
    }

    public function status(string $ext_order_id)
    {
        self::initPayu();
        $wait_time = (int)0;
        while (true) {
            sleep($wait_time);
            $response = OpenPayU_Order::retrieve($ext_order_id);
            $payu_order = $response->getResponse()->orders[0];
            $status = $payu_order->status;
            if ($status == 'COMPLETED') {
                Order::where('hash',$payu_order->extOrderId)->update(['status',$this->status_completed]);
                return $status;
            }
            $wait_time += 4;
        }
    }
    /*To do:
     *Kaskodowe update w permisjach
     *Wystawianie rachunku/faktury do poprawy
     * readme
     */
    private function validPersonalDates(array $user_personal_data, bool $invoice): bool
    {
        if ($invoice) {
            $validator = Validator::make($user_personal_data[0], [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|int',
                'address' => 'required|string|max:255',
            ]);
            return $validator->fails();
        } else {
            $validator = Validator::make($user_personal_data[0], [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|int',
            ]);
            return $validator->fails();
        }
    }

    private function getPersonalData($json)
    {
        $array = json_decode($json);
        return $array[0];
    }
}
