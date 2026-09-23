@extends('layouts.app')

@section('title', 'Tambah Shipping Rate - Admin Anireshop')

@section('content')

<div class="ani-admin-shipping-form-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-shipping-form-header">

            <div>
                <span class="ani-admin-eyebrow">
                    SHIPPING MANAGEMENT
                </span>

                <h1>Tambah Shipping Rate</h1>

                <p>
                    Tambahkan tarif pengiriman baru untuk Anireshop.
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
                            01
                        </div>

                        <div>

                            <span>
                                SHIPPING INFORMATION
                            </span>

                            <h2>Data Tarif Pengiriman</h2>

                        </div>

                    </div>


                    <form action="{{ route('admin.shipping-rates.store') }}"
                          method="POST">

                        @csrf

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

                                    <option value="">
                                        -- Pilih Courier --
                                    </option>

                                    <option value="JNE"
                                        {{ old('courier') === 'JNE' ? 'selected' : '' }}>
                                        JNE
                                    </option>

                                    <option value="J&T"
                                        {{ old('courier') === 'J&T' ? 'selected' : '' }}>
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
                                       value="{{ old('city') }}"
                                       class="@error('city') is-invalid @enderror"
                                       placeholder="Contoh: Boyolali"
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
                                           value="{{ old('cost') }}"
                                           min="0"
                                           class="@error('cost') is-invalid @enderror"
                                           placeholder="15000"
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
                                    ✓ Simpan Tarif
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
                        🚚
                    </div>

                    <span class="ani-admin-card-eyebrow">
                        SHIPPING GUIDE
                    </span>

                    <h2>
                        Tarif Pengiriman
                    </h2>

                    <p>
                        Data shipping rate digunakan oleh sistem
                        untuk menghitung biaya pengiriman saat customer
                        melakukan checkout.
                    </p>


                    <div class="ani-admin-shipping-info-divider"></div>


                    <div class="ani-admin-shipping-info-item">

                        <div class="ani-admin-shipping-info-item-icon">
                            🚚
                        </div>

                        <div>
                            <strong>Courier</strong>
                            <span>
                                JNE atau J&T
                            </span>
                        </div>

                    </div>


                    <div class="ani-admin-shipping-info-item">

                        <div class="ani-admin-shipping-info-item-icon">
                            📍
                        </div>

                        <div>
                            <strong>Tujuan</strong>
                            <span>
                                Kabupaten / Kota
                            </span>
                        </div>

                    </div>


                    <div class="ani-admin-shipping-info-item">

                        <div class="ani-admin-shipping-info-item-icon">
                            💰
                        </div>

                        <div>
                            <strong>Biaya</strong>
                            <span>
                                Dalam Rupiah
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection