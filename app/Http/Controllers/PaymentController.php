<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function show($bookingId)
    {
        $booking = Booking::with('destination', 'facilities')->findOrFail($bookingId);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('user.payment.show', compact('booking', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to get payment token.');
        }
    }

    public function callback(Request $request)
    {

        $serverKey = config('midtrans.server_key');
        $order_id = $request->order_id;
        $status_code = $request->status_code;
        $gross_amount = $request->gross_amount;
        $transaction_status = $request->transaction_status;

        $hashed = hash("sha512", $order_id . $status_code . $gross_amount . $serverKey);

        if ($hashed) { // Compare this with the signature key that you expect
            $booking = Booking::findOrFail($order_id);

            if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
                $booking->status = 'approved';
            } elseif ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
                $booking->status = 'rejected';
            }

            $booking->save();

            return response()->json(['status' => 'success', 'message' => 'Transaction status updated']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);

    }

    public function success($bookingId)
    {
        $booking = Booking::with('destination', 'facilities')->findOrFail($bookingId);
        return view('user.payment.success', compact('booking'));
    }

    public function pending($bookingId)
    {
        $booking = Booking::with('destination', 'facilities')->findOrFail($bookingId);
        return view('user.payment.pending', compact('booking'));
    }
}

