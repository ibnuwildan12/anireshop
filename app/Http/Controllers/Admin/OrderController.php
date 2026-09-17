<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'orderItems.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => [
                'required',
                'in:PENDING,PROCESSING,SHIPPED,COMPLETED',
            ],
            'courier' => [
                'nullable',
                'in:JNE,J&T',
            ],
            'tracking_number' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $newStatus = $validated['order_status'];
        $currentStatus = $order->order_status;

        // PENDING → PROCESSING
        if ($newStatus === 'PROCESSING') {

            if ($order->payment_status !== 'PAID') {
                return back()
                    ->with('error', 'Order hanya dapat diproses setelah pembayaran terverifikasi.');
            }

            if ($currentStatus !== 'PENDING') {
                return back()
                    ->with('error', 'Status order tidak dapat diubah ke PROCESSING dari status saat ini.');
            }
        }

        // PROCESSING → SHIPPED
        if ($newStatus === 'SHIPPED') {

            if ($currentStatus !== 'PROCESSING') {
                return back()
                    ->with('error', 'Order harus berstatus PROCESSING sebelum dikirim.');
            }

            if (empty($validated['courier'])) {
                return back()
                    ->with('error', 'Courier wajib diisi sebelum order dikirim.');
            }

            if (empty($validated['tracking_number'])) {
                return back()
                    ->with('error', 'Tracking number wajib diisi sebelum order dikirim.');
            }
        }

        // SHIPPED → COMPLETED
        if ($newStatus === 'COMPLETED') {

            if ($currentStatus !== 'SHIPPED') {
                return back()
                    ->with('error', 'Order harus berstatus SHIPPED sebelum diselesaikan.');
            }
        }

        $order->update([
            'order_status' => $newStatus,
            'courier' => $validated['courier'] ?? $order->courier,
            'tracking_number' => $validated['tracking_number'] ?? $order->tracking_number,
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order berhasil diperbarui.');
    }
}