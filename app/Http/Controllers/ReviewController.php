<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = auth()->user();

        // Cek apakah user pernah membeli produk ini
        $hasPurchased = $user->orders()
            ->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (! $hasPurchased) {
            return back()->with(
                'error',
                'Anda hanya dapat memberikan review untuk produk yang pernah dibeli.'
            );
        }

        // Satu user hanya boleh memberikan satu review untuk satu produk
        $alreadyReviewed = $product->reviews()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with(
                'error',
                'Anda sudah memberikan review untuk produk ini.'
            );
        }

        $product->reviews()->create([
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with(
            'success',
            'Review berhasil ditambahkan.'
        );
    }

    //EDIT REVIEW
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $review = $product->reviews()
            ->where('user_id', auth()->id())
            ->first();

        if (! $review) {
            return back()->with('error', 'Review tidak ditemukan.');
        }

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Review berhasil diperbarui.');
    }
    
    //HAPUS REVIEW
    public function destroy(Product $product): RedirectResponse
    {
        $review = $product->reviews()
            ->where('user_id', auth()->id())
            ->first();

        if (! $review) {
            return back()->with('error', 'Review tidak ditemukan.');
        }

        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }
}