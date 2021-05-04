<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use OpenPayU;
class PayuController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'sub_id' => 'required|int|max:255',
            'invoice' => 'required|bool',
        ]);
        $order = new Order();

        $message = $order->create($request->user()->id,$request->invoice,$request->sub_id);
        if (!empty($message)) {
            return response()->json($message, 200);
        }
        return response()->json(['message' => 'Create order error'], 401);
    }
    public function getPaymentStatus(Request $request)
    {
        return  0;
    }
}
