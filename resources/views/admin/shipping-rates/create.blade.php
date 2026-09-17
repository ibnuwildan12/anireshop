@extends('layouts.app')

@section('title', 'Tambah Shipping Rate - Anireshop')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Tambah Shipping Rate</h2>
        <p class="text-secondary mb-0">
            Tambahkan tarif pengiriman baru
        </p>
    </div>

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body p-4">

            <form action="{{ route('admin.shipping-rates.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label for="courier" class="form-label">
                        Courier
                    </label>

                    <select name="courier"
                            id="courier"
                            class="form-select @error('courier') is-invalid @enderror">

                        <option value="">-- Pilih Courier --</option>

                        <option value="JNE"
                            {{ old('courier') === 'JNE' ? 'selected' : '' }}>
                            JNE
                        </option>

                        <option value="J&T"
                            {{ old('courier') === 'J&T' ? 'selected' : '' }}>
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
                           value="{{ old('city') }}"
                           class="form-control @error('city') is-invalid @enderror"
                           placeholder="Contoh: Boyolali">

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
                           value="{{ old('cost') }}"
                           min="0"
                           class="form-control @error('cost') is-invalid @enderror"
                           placeholder="Contoh: 15000">

                    @error('cost')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-ani">
                        Simpan
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