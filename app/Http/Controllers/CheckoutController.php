<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->withErrors([
                    'cart' => 'Keranjang masih kosong.',
                ]);
        }

        $products = Product::with('images')
            ->whereIn('id', array_keys($cart))
            ->get();

        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id]['quantity'];
            $subtotal += $product->price * $quantity;
        }

        $shippingRates = ShippingRate::orderBy('courier')
            ->orderBy('city')
            ->get();

        return view(
            'checkout.index',
            compact(
                'products',
                'cart',
                'subtotal',
                'shippingRates'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_district' => 'required|string|max:100',
            'shipping_postal_code' => [
                'required',
                'digits:5',
            ],
            'courier' => 'required|in:JNE,J&T',
            'shipping_cost' => 'required|numeric|min:0',
            'payment_method' => 'required|in:QRIS,BANK_TRANSFER',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->withErrors([
                    'cart' => 'Keranjang masih kosong.',
                ]);
        }

        $order = DB::transaction(function () use (
            $validated,
            $cart
        ) {
            $products = Product::whereIn(
                'id',
                array_keys($cart)
            )
            ->lockForUpdate()
            ->get()
            ->keyBy('id');

            $subtotal = 0;

            foreach ($cart as $productId => $item) {
                if (!isset($products[$productId])) {
                    throw new \Exception(
                        'Produk tidak ditemukan.'
                    );
                }

                $product = $products[$productId];

                $availableStock =
                    $product->stock -
                    $product->reserved_stock;

                if ($item['quantity'] > $availableStock) {
                    throw new \Exception(
                        "Stok {$product->name} tidak mencukupi."
                    );
                }

                $subtotal +=
                    $product->price *
                    $item['quantity'];
            }

            $shippingRate = ShippingRate::where(
                'courier',
                $validated['courier']
            )
            ->where(
                'city',
                $validated['shipping_city']
            )
            ->first();

            if (!$shippingRate) {
                throw new \Exception(
                    'Ongkir untuk kota dan kurir tersebut belum tersedia.'
                );
            }

            if (
                (float) $shippingRate->cost !==
                (float) $validated['shipping_cost']
            ) {
                throw new \Exception(
                    'Biaya pengiriman tidak valid.'
                );
            }

            $totalAmount =
                $subtotal +
                $shippingRate->cost;

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' =>
                    'ANS-' .
                    now()->format('YmdHis') .
                    '-' .
                    strtoupper(Str::random(5)),

                'total_amount' => $totalAmount,
                'shipping_cost' => $shippingRate->cost,

                'courier' => $validated['courier'],

                'shipping_address' =>
                    $validated['shipping_address'],

                'shipping_city' =>
                    $validated['shipping_city'],

                'shipping_district' =>
                    $validated['shipping_district'],

                'shipping_postal_code' =>
                    $validated['shipping_postal_code'],

                'payment_method' =>
                    $validated['payment_method'],

                'payment_status' => 'PENDING',
                'order_status' => 'PENDING',

                'expires_at' => now()->addHours(2),
            ]);

            foreach ($cart as $productId => $item) {
                $product = $products[$productId];

                $subtotalItem =
                    $product->price *
                    $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,

                    'product_name' =>
                        $product->name,

                    'quantity' =>
                        $item['quantity'],

                    'price' =>
                        $product->price,

                    'subtotal' =>
                        $subtotalItem,

                    'variation_note' =>
                        $item['variation_note'] ?? null,
                ]);

                $product->increment(
                    'reserved_stock',
                    $item['quantity']
                );
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()
            ->route(
                'orders.show',
                $order
            )
            ->with(
                'success',
                'Pesanan berhasil dibuat. Silakan lakukan pembayaran.'
            );
    }
}