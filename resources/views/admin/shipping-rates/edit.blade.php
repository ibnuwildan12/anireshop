@extends('layouts.app')

@section('title', 'Edit Shipping Rate - Admin Anireshop')

@section('content')

<div class="ani-admin-shipping-form-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-shipping-form-header">

            <div>
                <span class="ani-admin-eyebrow">
                    SHIPPING MANAGEMENT
                </span>

                <h1>Edit Shipping Rate</h1>

                <p>
                    Perbarui tarif pengiriman Anireshop.
                </p>
            </div>

            <a href="{{ route('admin.shipping-rates.index') }}"
               class="ani-admin-back-btn">
                ← Kembali ke Shipping Rates
            </a>

        </div>


        {{-- VALIDATION ALERT --}}
        @if ($errors->any())

            <div class="ani-admin-shipping-form-alert">

                <div class="ani-admin-shipping-form-alert-icon">
                    !
                </div>

                <div>

                    <strong>
                        Periksa kembali data shipping rate
                    </strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            </div>

        @endif


        <div class="row g-4">

            {{-- FORM --}}
            <div class="col-lg-8">

                <div class="ani-admin-shipping-form-card">

                    <div class="ani-admin-shipping-form-card-header">

                        <div class="ani-admin-form-number">
                            02
                        </div>

                        <div>

                            <span>
                                SHIPPING INFORMATION
                            </span>

                            <h2>{{ $shippingRate->courier }} — {{ $shippingRate->city }}</h2>

                        </div>

                    </div>


                    <form action="{{ route('admin.shipping-rates.update', $shippingRate) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="ani-admin-shipping-form-body">


                            {{-- COURIER --}}
                            <div class="ani-admin-shipping-field">

                                <label for="courier">
                                    Courier
                                    <span>*</span>
                                </label>

                                <select name="courier"
                                        id="courier"
                                        class="@error('courier') is-invalid @enderror"
                                        required>

                                    <option value="JNE"
                                        {{ old('courier', $shippingRate->courier) === 'JNE' ? 'selected' : '' }}>
                                        JNE
                                    </option>

                                    <option value="J&T"
                                        {{ old('courier', $shippingRate->courier) === 'J&T' ? 'selected' : '' }}>
                                        J&T
                                    </option>

                                </select>

                                <div class="ani-admin-shipping-field-help">
                                    Pilih jasa pengiriman yang digunakan untuk tarif ini.
                                </div>

                                @error('courier')

                                    <div class="ani-admin-shipping-field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- CITY --}}
                            <div class="ani-admin-shipping-field">

                                <label for="city">
                                    Kabupaten / Kota
                                    <span>*</span>
                                </label>

                                <input type="text"
                                       id="city"
                                       name="city"
                                       value="{{ old('city', $shippingRate->city) }}"
                                       class="@error('city') is-invalid @enderror"
                                       autocomplete="off"
                                       required>

                                <div class="ani-admin-shipping-field-help">
                                    Masukkan nama Kabupaten atau Kota tujuan pengiriman.
                                </div>

                                @error('city')

                                    <div class="ani-admin-shipping-field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- COST --}}
                            <div class="ani-admin-shipping-field">

                                <label for="cost">
                                    Biaya Pengiriman
                                    <span>*</span>
                                </label>

                                <div class="ani-admin-shipping-input-prefix">

                                    <span>Rp</span>

                                    <input type="number"
                                           id="cost"
                                           name="cost"
                                           value="{{ old('cost', $shippingRate->cost) }}"
                                           min="0"
                                           class="@error('cost') is-invalid @enderror"
                                           required>

                                </div>

                                <div class="ani-admin-shipping-field-help">
                                    Masukkan biaya pengiriman dalam Rupiah tanpa titik atau koma.
                                </div>

                                @error('cost')

                                    <div class="ani-admin-shipping-field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                        </div>


                        {{-- FOOTER --}}
                        <div class="ani-admin-shipping-form-footer">

                            <div class="ani-admin-shipping-required-info">
                                <span>*</span>
                                Field wajib diisi
                            </div>

                            <div class="ani-admin-shipping-form-actions">

                                <a href="{{ route('admin.shipping-rates.index') }}"
                                   class="ani-admin-shipping-cancel-btn">
                                    Batal
                                </a>

                                <button type="submit"
                                        class="ani-admin-shipping-save-btn">
                                    ✓ Simpan Perubahan
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- INFO CARD --}}
            <div class="col-lg-4">

                <div class="ani-admin-shipping-info-card">

                    <div class="ani-admin-shipping-info-icon">
                        ✏️
                    </div>

                    <span class="ani-admin-card-eyebrow">
                        CURRENT SHIPPING RATE
                    </span>

                    <h2>
                        Tarif Saat Ini
                    </h2>

                    <div class="ani-admin-shipping-current-info">

                        <div class="ani-admin-shipping-current-item">

                            <span>Courier</span>

                            <strong>
                                {{ $shippingRate->courier }}
                            </strong>

                        </div>

                        <div class="ani-admin-shipping-current-item">

                            <span>Kabupaten / Kota</span>

                            <strong>
                                {{ $shippingRate->city }}
                            </strong>

                        </div>

                        <div class="ani-admin-shipping-current-item">

                            <span>Biaya</span>

                            <strong class="cost">
                                Rp {{ number_format($shippingRate->cost, 0, ',', '.') }}
                            </strong>

                        </div>

                    </div>


                    <div class="ani-admin-shipping-info-divider"></div>


                    <div class="ani-admin-shipping-info-note">

                        <span>i</span>

                        <p>
                            Perubahan tarif akan digunakan oleh sistem
                            pada checkout berikutnya.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection