@extends('layouts.app')

@section('title', 'Edit Shipping Rate - Anireshop')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Shipping Rate</h2>
        <p class="text-secondary mb-0">
            Perbarui tarif pengiriman Anireshop
        </p>
    </div>

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body p-4">

            <form action="{{ route('admin.shipping-rates.update', $shippingRate) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="courier" class="form-label">
                        Courier
                    </label>

                    <select name="courier"
                            id="courier"
                            class="form-select @error('courier') is-invalid @enderror">

                        <option value="JNE"
                            {{ old('courier', $shippingRate->courier) === 'JNE' ? 'selected' : '' }}>
                            JNE
                        </option>

                        <option value="J&T"
                            {{ old('courier', $shippingRate->courier) === 'J&T' ? 'selected' : '' }}>
                            J&T
                        </option>

                    </select>

                    @error('courier')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">
                        Kabupaten/Kota
                    </label>

                    <input type="text"
                           id="city"
                           name="city"
                           value="{{ old('city', $shippingRate->city) }}"
                           class="form-control @error('city') is-invalid @enderror">

                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cost" class="form-label">
                        Biaya Pengiriman
                    </label>

                    <input type="number"
                           id="cost"
                           name="cost"
                           value="{{ old('cost', $shippingRate->cost) }}"
                           min="0"
                           class="form-control @error('cost') is-invalid @enderror">

                    @error('cost')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-ani">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.shipping-rates.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection