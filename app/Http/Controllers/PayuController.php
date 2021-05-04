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
            'invoice' => 'required|bool|max:1',
            'user_personal_data' => 'required|array|max:255'
        ]);
        $order = new Order();
        $message = $order->createOrder($request->user()->id, $request->sub_id, $request->invoice, $request->user_personal_data);
        if (!empty($message)) {
            return response()->json(['order_id' => $message], 200);
        }
        return response()->json(['message' => 'Create order error'], 401);
    }

    public function getPaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|max:255',
        ]);
        $order = new Order();
        $message = $order->status($request->order_id);
        if (!empty($message)) {
            return response()->json(['order_id' => $message], 200);
        }
        return response()->json(['message' => 'Create order error'], 401);
    }
}
