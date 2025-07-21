<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $request->amount * 100, // in paise
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'razorpay_key' => env('RAZORPAY_KEY')
        ]);
    }
}
