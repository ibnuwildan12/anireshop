<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems');

        return view('payments.show', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Payment status
        |--------------------------------------------------------------------------
        | Customer boleh upload jika:
        | PENDING   -> upload pertama
        | REJECTED  -> upload ulang
        */

        if (!in_array($order->payment_status, ['PENDING', 'REJECTED'])) {
            return back()->with(
                'error',
                'Pembayaran tidak dapat dilakukan pada status ini.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Check payment deadline
        |--------------------------------------------------------------------------
        */

        if ($order->expires_at && now()->greaterThan($order->expires_at)) {
            return back()->with(
                'error',
                'Batas waktu pembayaran telah berakhir.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'payment_proof' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Delete old payment proof
        |--------------------------------------------------------------------------
        */

        if ($order->payment_proof) {
            Storage::disk('public')->delete(
                $order->payment_proof
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Store new payment proof
        |--------------------------------------------------------------------------
        */

        $path = $request->file('payment_proof')
            ->store('payment-proofs', 'public');

        /*
        |--------------------------------------------------------------------------
        | Update payment status
        |--------------------------------------------------------------------------
        */

        $order->update([
            'payment_proof' => $path,
            'payment_status' => 'WAITING_VERIFICATION',
            'payment_submitted_at' => now(),
            'payment_verified_at' => null,
        ]);

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Bukti pembayaran berhasil dikirim dan menunggu verifikasi admin.'
            );
    }
}