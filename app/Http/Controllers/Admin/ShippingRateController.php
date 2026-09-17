<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShippingRateController extends Controller
{
    public function index()
    {
        $shippingRates = ShippingRate::latest()->paginate(10);

        return view('admin.shipping-rates.index', compact('shippingRates'));
    }

    public function create()
    {
        return view('admin.shipping-rates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'courier' => ['required', 'in:JNE,J&T'],
            'city' => ['required', 'string', 'min:2', 'max:100'],
            'cost' => ['required', 'numeric', 'min:0'],
        ]);

        ShippingRate::create($validated);

        return redirect()
            ->route('admin.shipping-rates.index')
            ->with('success', 'Tarif pengiriman berhasil ditambahkan.');
    }

    public function edit(ShippingRate $shippingRate)
    {
        return view('admin.shipping-rates.edit', compact('shippingRate'));
    }

    public function update(Request $request, ShippingRate $shippingRate)
    {
        $validated = $request->validate([
            'courier' => ['required', 'in:JNE,J&T'],
            'city' => ['required', 'string', 'min:2', 'max:100'],
            'cost' => ['required', 'numeric', 'min:0'],
        ]);

        $shippingRate->update($validated);

        return redirect()
            ->route('admin.shipping-rates.index')
            ->with('success', 'Tarif pengiriman berhasil diperbarui.');
    }

    public function destroy(ShippingRate $shippingRate)
    {
        $shippingRate->delete();

        return redirect()
            ->route('admin.shipping-rates.index')
            ->with('success', 'Tarif pengiriman berhasil dihapus.');
    }
}