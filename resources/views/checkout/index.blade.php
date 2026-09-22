@extends('layouts.app')

@section('title', 'Checkout - Anireshop')

@section('content')

<div class="ani-checkout-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-checkout-header">

            <div>
                <span class="ani-checkout-eyebrow">
                    SECURE CHECKOUT
                </span>

                <h1>
                    Checkout
                </h1>

                <p>
                    Lengkapi detail pengiriman dan pembayaran untuk menyelesaikan pesananmu.
                </p>
            </div>

            <a
                href="{{ route('cart.index') }}"
                class="ani-checkout-back"
            >
                ← Kembali ke Keranjang
            </a>

        </div>


        {{-- ERRORS --}}
        @if ($errors->any())

            <div class="ani-checkout-alert">

                <div class="ani-checkout-alert-icon">
                    !
                </div>

                <div>
                    <strong>Periksa kembali data pesanan</strong>

                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('checkout.store') }}"
        >

            @csrf

            <div class="row g-4 align-items-start">

                {{-- LEFT --}}
                <div class="col-lg-7">


                    {{-- SHIPPING ADDRESS --}}
                    <div class="ani-checkout-card">

                        <div class="ani-checkout-section-heading">

                            <div class="ani-checkout-number">
                                01
                            </div>

                            <div>
                                <span>SHIPPING</span>
                                <h2>Alamat Pengiriman</h2>
                            </div>

                        </div>


                        <div class="ani-form-group">

                            <label for="shipping_address">
                                Alamat Lengkap
                            </label>

                            <textarea
                                id="shipping_address"
                                name="shipping_address"
                                class="ani-form-control"
                                rows="4"
                                placeholder="Contoh: Jl. Merpati No. 10, RT 02/RW 03"
                                required
                            >{{ old('shipping_address') }}</textarea>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="ani-form-group">

                                    <label for="shipping_city">
                                        Kabupaten / Kota
                                    </label>

                                    <select
                                        name="shipping_city"
                                        id="shipping_city"
                                        class="ani-form-control"
                                        required
                                    >

                                        <option value="">
                                            Pilih Kabupaten / Kota
                                        </option>

                                        @foreach (
                                            $shippingRates->pluck('city')->unique()
                                            as $city
                                        )

                                            <option
                                                value="{{ $city }}"
                                                {{ old('shipping_city') === $city ? 'selected' : '' }}
                                            >
                                                {{ $city }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="ani-form-group">

                                    <label for="shipping_district">
                                        Kecamatan
                                    </label>

                                    <input
                                        type="text"
                                        id="shipping_district"
                                        name="shipping_district"
                                        class="ani-form-control"
                                        value="{{ old('shipping_district') }}"
                                        placeholder="Nama Kecamatan"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="ani-form-group mb-0">

                                    <label for="shipping_postal_code">
                                        Kode Pos
                                    </label>

                                    <input
                                        type="text"
                                        id="shipping_postal_code"
                                        name="shipping_postal_code"
                                        class="ani-form-control"
                                        value="{{ old('shipping_postal_code') }}"
                                        maxlength="5"
                                        placeholder="573xx"
                                        required
                                    >

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- COURIER --}}
                    <div class="ani-checkout-card">

                        <div class="ani-checkout-section-heading">

                            <div class="ani-checkout-number">
                                02
                            </div>

                            <div>
                                <span>DELIVERY</span>
                                <h2>Kurir Pengiriman</h2>
                            </div>

                        </div>


                        <div class="ani-form-group">

                            <label for="courier">
                                Pilih Kurir
                            </label>

                            <select
                                name="courier"
                                id="courier"
                                class="ani-form-control"
                                required
                            >

                                <option value="">
                                    Pilih Kurir
                                </option>

                                <option
                                    value="JNE"
                                    {{ old('courier') === 'JNE' ? 'selected' : '' }}
                                >
                                    JNE
                                </option>

                                <option
                                    value="J&T"
                                    {{ old('courier') === 'J&T' ? 'selected' : '' }}
                                >
                                    J&T
                                </option>

                            </select>

                        </div>


                        <div class="ani-shipping-cost">

                            <div>

                                <span>
                                    Ongkos Kirim
                                </span>

                                <strong id="shipping_cost_display">
                                    Rp 0
                                </strong>

                            </div>

                            <div class="ani-shipping-icon">
                                🚚
                            </div>

                        </div>

                        <input
                            type="hidden"
                            name="shipping_cost"
                            id="shipping_cost"
                            value="0"
                        >

                    </div>



                    {{-- PAYMENT --}}
                    <div class="ani-checkout-card">

                        <div class="ani-checkout-section-heading">

                            <div class="ani-checkout-number">
                                03
                            </div>

                            <div>
                                <span>PAYMENT</span>
                                <h2>Metode Pembayaran</h2>
                            </div>

                        </div>


                        <div class="ani-payment-options">

                            <label class="ani-payment-option">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="QRIS"
                                    {{ old('payment_method') === 'QRIS' ? 'checked' : '' }}
                                    required
                                >

                                <div class="ani-payment-content">

                                    <div class="ani-payment-icon">
                                        QR
                                    </div>

                                    <div>

                                        <strong>
                                            QRIS
                                        </strong>

                                        <span>
                                            Bayar menggunakan QRIS
                                        </span>

                                    </div>

                                </div>

                                <span class="ani-payment-check">
                                    ✓
                                </span>

                            </label>


                            <label class="ani-payment-option">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="BANK_TRANSFER"
                                    {{ old('payment_method') === 'BANK_TRANSFER' ? 'checked' : '' }}
                                >

                                <div class="ani-payment-content">

                                    <div class="ani-payment-icon bank">
                                        BRI
                                    </div>

                                    <div>

                                        <strong>
                                            Bank Transfer
                                        </strong>

                                        <span>
                                            Transfer melalui rekening BRI
                                        </span>

                                    </div>

                                </div>

                                <span class="ani-payment-check">
                                    ✓
                                </span>

                            </label>

                        </div>

                    </div>

                </div>



                {{-- RIGHT SUMMARY --}}
                <div class="col-lg-5">

                    <div class="ani-checkout-summary">

                        <div class="ani-summary-heading">

                            <span>
                                ORDER SUMMARY
                            </span>

                            <h2>
                                Ringkasan Pesanan
                            </h2>

                        </div>


                        {{-- PRODUCTS --}}
                        <div class="ani-checkout-products">

                            @foreach ($products as $product)

                                @php
                                    $quantity = $cart[$product->id]['quantity'];
                                    $variation = $cart[$product->id]['variation_note'] ?? null;
                                    $itemTotal = $product->price * $quantity;
                                @endphp

                                <div class="ani-checkout-product">

                                    <div class="ani-checkout-product-image">

                                        @if ($product->images->first())

                                            <img
                                                src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                                alt="{{ $product->name }}"
                                            >

                                        @else

                                            <span>
                                                —
                                            </span>

                                        @endif

                                    </div>


                                    <div class="ani-checkout-product-info">

                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                        <span>
                                            {{ $quantity }} ×
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>

                                        @if ($variation)
                                            <small>
                                                {{ $variation }}
                                            </small>
                                        @endif

                                    </div>


                                    <div class="ani-checkout-product-total">

                                        Rp {{ number_format($itemTotal, 0, ',', '.') }}

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <div class="ani-summary-divider"></div>


                        <div class="ani-checkout-total-line">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </strong>

                        </div>


                        <div class="ani-checkout-total-line muted">

                            <span>
                                Ongkir
                            </span>

                            <strong id="summaryShipping">
                                Rp 0
                            </strong>

                        </div>


                        <div class="ani-summary-divider"></div>


                        <div class="ani-checkout-grand-total">

                            <span>
                                Total Pembayaran
                            </span>

                            <strong id="summaryTotal">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </strong>

                        </div>


                        <button
                            type="submit"
                            class="ani-place-order-btn"
                        >
                            <span>
                                Buat Pesanan
                            </span>

                            <span>
                                →
                            </span>
                        </button>


                        <div class="ani-checkout-security">
                            🔒 Data pesanan diproses secara aman.
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script>

    const shippingRates = @json($shippingRates);

    const citySelect =
        document.getElementById('shipping_city');

    const courierSelect =
        document.getElementById('courier');

    const shippingCost =
        document.getElementById('shipping_cost');

    const shippingCostDisplay =
        document.getElementById('shipping_cost_display');

    const summaryShipping =
        document.getElementById('summaryShipping');

    const summaryTotal =
        document.getElementById('summaryTotal');

    const subtotal =
        {{ $subtotal }};


    function updateShipping() {

        const city = citySelect.value;
        const courier = courierSelect.value;

        const rate = shippingRates.find(item =>
            item.city === city &&
            item.courier === courier
        );

        const cost = rate
            ? Number(rate.cost)
            : 0;


        shippingCost.value = cost;


        shippingCostDisplay.textContent =
            'Rp ' +
            cost.toLocaleString('id-ID');


        summaryShipping.textContent =
            'Rp ' +
            cost.toLocaleString('id-ID');


        summaryTotal.textContent =
            'Rp ' +
            (subtotal + cost).toLocaleString('id-ID');

    }


    citySelect.addEventListener(
        'change',
        updateShipping
    );


    courierSelect.addEventListener(
        'change',
        updateShipping
    );


    updateShipping();

</script>

@endpush