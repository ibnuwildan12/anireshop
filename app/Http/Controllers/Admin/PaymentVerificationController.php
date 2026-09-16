<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class PaymentVerificationController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->where('payment_status', 'WAITING_VERIFICATION')
            ->latest('payment_submitted_at')
            ->paginate(10);

        return view('admin.payments.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems']);

        return view('admin.payments.show', compact('order'));
    }

    public function approve(Order $order)
    {
        if ($order->payment_status !== 'WAITING_VERIFICATION') {
            return back()->with('error', 'Pembayaran tidak dapat diverifikasi.');
        }

        DB::transaction(function () use ($order) {
            $order = Order::with('orderItems')
                ->lockForUpdate()
                ->findOrFail($order->id);

            if ($order->payment_status !== 'WAITING_VERIFICATION') {
                abort(400, 'Status pembayaran sudah berubah.');
            }

            foreach ($order->orderItems as $item) {
                $product = $item->product()
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($product->reserved_stock < $item->quantity) {
                    abort(400, 'Reserved stock tidak mencukupi.');
                }

                if ($product->stock < $item->quantity) {
                    abort(400, 'Stock produk tidak mencukupi.');
                }

                $product->decrement('reserved_stock', $item->quantity);
                $product->decrement('stock', $item->quantity);
            }

            $order->update([
                'payment_status' => 'PAID',
                'payment_verified_at' => now(),
                'order_status' => 'PROCESSING',
            ]);
        });

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function reject(Order $order)
    {
        if ($order->payment_status !== 'WAITING_VERIFICATION') {
            return back()->with('error', 'Pembayaran tidak dapat ditolak.');
        }

        DB::transaction(function () use ($order) {
            $order = Order::with('orderItems')
                ->lockForUpdate()
                ->findOrFail($order->id);

            if ($order->payment_status !== 'WAITING_VERIFICATION') {
                abort(400, 'Status pembayaran sudah berubah.');
            }

            foreach ($order->orderItems as $item) {
                $product = $item->product()
                    ->lockForUpdate()
                    ->firstOrFail();

                $product->decrement(
                    'reserved_stock',
                    min($product->reserved_stock, $item->quantity)
                );
            }

            $order->update([
                'payment_status' => 'REJECTED',
            ]);
        });

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran ditolak dan stock reservation dilepas.');
    }
}