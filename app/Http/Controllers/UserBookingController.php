<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Transaction;

class UserBookingController extends Controller
{
    private $booking;

    public function index()
    {
        return view('user.booking');
    }

    public function payIndex($bookingCode)
    {
        $booking = $this->getPendingBooking($bookingCode);

        if (!$booking) {
            Alert::error('Booking not found', 'Booking not found');
            return redirect()->route('booking');
        }

        if (is_null($booking->snap_token)) {
            $booking->snap_token = $this->createSnapToken($booking);
            $booking->save();
        }

        $this->booking = $booking;
        return view('user.payment', compact('booking'));
    }

    private function configureMidtrans()
    {
        // Configure Midtrans settings
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');
    }

    private function createSnapToken($booking)
    {
        $this->configureMidtrans();

        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ], 
        ];

        return Snap::getSnapToken($params);
    }

    private function getPendingBooking($bookingCode)
    {
        return Booking::where([
            ['user_id', auth()->user()->id],
            ['status', 'pending'],
            ['booking_code', $bookingCode],
        ])
            ->with(['user:id,name,email'])
            ->first();
    }

    private function checkStatus($orderId)
    {
        // Set your server key
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');

        try {
            $status = Transaction::status($orderId);
            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentSuccess($bookingCode)
    {

        $booking = $this->getPendingBooking($bookingCode);
        if ($booking) {
            $booking->status = 'success';
            $booking->save();

            Alert::success('Payment Success', 'Payment Success');
        }

        return view('user.booking');
    }

    public function paymentFailed()
    {
        Alert::error('Payment Failed', 'Payment Failed');
        return view('user.booking');
    }
}
