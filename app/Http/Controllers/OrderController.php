<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems');

        return view('orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->order_status !== 'SHIPPED') {
            return back()->with(
                'error',
                'Pesanan hanya dapat dikonfirmasi setelah dikirim.'
            );
        }

        $order->update([
            'order_status' => 'COMPLETED',
        ]);

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Pesanan berhasil dikonfirmasi sebagai diterima.'
            );
    }
}