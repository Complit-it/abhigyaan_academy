<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Razorpay\Api\Api;
use App\Models\UserPackages;
use Carbon\Carbon;

class PaymentController extends Controller
{
    //


public function addPayment(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer|exists:users,id',
        'package_id' => 'required|integer',
        'amount' => 'required|numeric',
        'transaction_id' => 'required|string'
    ]);

    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $order = $api->order->create([
        'receipt' => uniqid(),
        'amount' => $request->amount * 100,
        'currency' => 'INR',
        'payment_capture' => 1
    ]);

    $payment = Payment::create([
        'user_id' => $request->user_id,
        'transaction_id' => $request->transaction_id,
        'package_id' => $request->package_id,
        'razorpay_id' => $order['id'],
        'order_id' => $order['id']
    ]);

    return response()->json([
        'error' => false,
        'message' => 'Congratulations! You have successfully registered.',
        'data' => [
            'payment_id' => $payment->id,
            'razorpay_order_id' => $order['id'],
            'amount' => $order['amount'],
            'currency' => $order['currency']
        ]
    ]);
}

public function addToUserPackageOnPaymentSuccess(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer|exists:users,id',
        'package_id' => 'required|integer',
        'payment_id' => 'required|integer|exists:payments,id',
    ]);

    $now = Carbon::now();
    $end = $now->copy()->addMonths(13);

    $userPackage = UserPackages::create([
        'user_id'               => $request->user_id,
        'package_id'            => $request->package_id,
        'package_code'          => null, // or auto-generate if needed
        'applied_discount_code' => null, // or use from request if any
        'payment_id'            => $request->payment_id,
        'payment_status'        => 'SUCCESS',
        'package_start_date'    => $now->toDateTimeString(),
        'package_end_date'      => $end->toDateTimeString(),
        'is_paused'             => false,
        'status'                => 1, // assuming 1 = active
    ]);

    return response()->json([
        'error' => false,
        'message' => 'User package successfully added.',
        'data' => [
            'user_package_id' => $userPackage->id
        ]
    ]);
}


public function verifyPayment(Request $request)
{
    $request->validate([
        'order_id' => 'required|string',
        'payment_id' => 'required|string',
        'signature' => 'required|string',
    ]);

    $body = $request->order_id . '|' . $request->payment_id;
    $expected = hash_hmac('sha256', $body, env('RAZORPAY_SECRET'));

    if (hash_equals($expected, $request->signature)) {
        return response()->json([
            'error' => false,
            'message' => 'Payment Successful!',
            'data' => null
        ]);
    }

    return response()->json([
        'error' => false,
        'message' => 'Signature is invalid',
        'data' => null
    ]);
}



}
