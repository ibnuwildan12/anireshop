<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpireOrders extends Command
{
    protected $signature = 'orders:expire';

    protected $description = 'Expire unpaid orders and release reserved stock';

    public function handle(): int
    {
        $orders = Order::where('order_status', 'PENDING')
            ->where('payment_status', 'PENDING')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($orders as $order) {

            DB::transaction(function () use ($order) {

                $order = Order::where('id', $order->id)
                    ->lockForUpdate()
                    ->first();

                if (
                    !$order ||
                    $order->order_status !== 'PENDING' ||
                    $order->payment_status !== 'PENDING' ||
                    !$order->expires_at ||
                    $order->expires_at->isFuture()
                ) {
                    return;
                }

                $order->load('orderItems');

                foreach ($order->orderItems as $item) {

                    $product = $item->product()
                        ->lockForUpdate()
                        ->first();

                    if (!$product) {
                        continue;
                    }

                    $releaseQuantity = min(
                        $product->reserved_stock,
                        $item->quantity
                    );

                    if ($releaseQuantity > 0) {
                        $product->decrement(
                            'reserved_stock',
                            $releaseQuantity
                        );
                    }
                }

                $order->update([
                    'order_status' => 'EXPIRED',
                ]);
            });

            $this->info(
                "Order {$order->order_number} expired."
            );
        }

        return self::SUCCESS;
    }
}