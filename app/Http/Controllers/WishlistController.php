<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index(): View
    {
        $wishlists = auth()->user()
            ->wishlists()
            ->with('product')
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    /**
     * Add a product to the wishlist.
     */
    public function store(Product $product): RedirectResponse
    {
        auth()->user()
            ->wishlists()
            ->firstOrCreate([
                'product_id' => $product->id,
            ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke wishlist.');
    }

    /**
     * Remove a product from the wishlist.
     */
    public function destroy(Product $product): RedirectResponse
    {
        auth()->user()
            ->wishlists()
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Produk berhasil dihapus dari wishlist.');
    }
}