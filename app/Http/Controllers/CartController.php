<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $products = Product::with('images')
            ->whereIn('id', array_keys($cart))
            ->get();

        $total = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id]['quantity'];
            $total += $product->price * $quantity;
        }

        return view('cart.index', compact(
            'products',
            'cart',
            'total'
        ));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'variation_note' => 'nullable|string|max:500',
        ]);

        $availableStock = $product->available_stock;

        if ($validated['quantity'] > $availableStock) {
            return back()->withErrors([
                'quantity' => 'Jumlah melebihi stok yang tersedia.',
            ]);
        }

        $cart = session()->get('cart', []);

        $productId = $product->id;

        if (isset($cart[$productId])) {
            $newQuantity =
                $cart[$productId]['quantity']
                + $validated['quantity'];

            if ($newQuantity > $availableStock) {
                return back()->withErrors([
                    'quantity' => 'Jumlah produk di keranjang melebihi stok yang tersedia.',
                ]);
            }

            $cart[$productId]['quantity'] = $newQuantity;

            if (!empty($validated['variation_note'])) {
                $cart[$productId]['variation_note'] =
                    $validated['variation_note'];
            }
        } else {
            $cart[$productId] = [
                'quantity' => $validated['quantity'],
                'variation_note' =>
                    $validated['variation_note'] ?? null,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang.'
            );
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'variation_note' => 'nullable|string|max:500',
        ]);

        if ($validated['quantity'] > $product->available_stock) {
            return back()->withErrors([
                'quantity' => 'Jumlah melebihi stok yang tersedia.',
            ]);
        }

        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return back();
        }

        $cart[$product->id]['quantity'] =
            $validated['quantity'];

        $cart[$product->id]['variation_note'] =
            $validated['variation_note'] ?? null;

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Keranjang berhasil diperbarui.'
        );
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }
}