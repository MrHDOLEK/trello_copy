<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckPaymentsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Cron check status payments is runing');
        $order = new Order();
        $orders_list = Order::where('status', 0)->get();
        foreach ($orders_list as $order_value) {
            $payment_id = $order_value->ext_order_id;
            if (!(empty($payment_id))) {
                $order->status($payment_id);
            }

        }
        Log::info('Cron check status payments complete');
    }
}
