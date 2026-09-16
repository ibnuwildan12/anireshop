<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Checkout - Anireshop</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #0f0f13;
            color: #ffffff;
        }

        .navbar {
            background: #111116;
        }

        .navbar-brand {
            color: #ff4fd8 !important;
            font-weight: 700;
        }

        .checkout-card {
            background: #18181f;
            border: 1px solid #292936;
            border-radius: 15px;
        }

        .form-control,
        .form-select {
            background: #101015;
            color: #ffffff;
            border-color: #3a3a45;
        }

        .form-control:focus,
        .form-select:focus {
            background: #101015;
            color: #ffffff;
        }

        .price {
            color: #ff4fd8;
            font-weight: 700;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">

        <a
            href="{{ route('home') }}"
            class="navbar-brand"
        >
            Anireshop
        </a>

        <a
            href="{{ route('cart.index') }}"
            class="btn btn-outline-light btn-sm"
        >
            ← Keranjang
        </a>

    </div>
</nav>


<div class="container py-5">

    <h1 class="mb-4">
        Checkout
    </h1>

    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>
    @endif


    <form
        method="POST"
        action="{{ route('checkout.store') }}"
    >
        @csrf

        <div class="row g-4">

            {{-- SHIPPING --}}
            <div class="col-lg-7">

                <div class="checkout-card p-4">

                    <h4 class="mb-4">
                        Alamat Pengiriman
                    </h4>

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat Lengkap
                        </label>

                        <textarea
                            name="shipping_address"
                            class="form-control"
                            rows="4"
                            required
                        >{{ old('shipping_address') }}</textarea>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Kabupaten / Kota
                        </label>

                        <select
                            name="shipping_city"
                            id="shipping_city"
                            class="form-select"
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


                    <div class="mb-3">

                        <label class="form-label">
                            Kecamatan
                        </label>

                        <input
                            type="text"
                            name="shipping_district"
                            class="form-control"
                            value="{{ old('shipping_district') }}"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Kode Pos
                        </label>

                        <input
                            type="text"
                            name="shipping_postal_code"
                            class="form-control"
                            value="{{ old('shipping_postal_code') }}"
                            maxlength="5"
                            required
                        >

                    </div>

                </div>


                {{-- COURIER --}}
                <div class="checkout-card p-4 mt-4">

                    <h4 class="mb-4">
                        Kurir
                    </h4>

                    <div class="mb-3">

                        <label class="form-label">
                            Pilih Kurir
                        </label>

                        <select
                            name="courier"
                            id="courier"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Kurir
                            </option>

                            <option value="JNE">
                                JNE
                            </option>

                            <option value="J&T">
                                J&T
                            </option>

                        </select>

                    </div>


                    <div class="mb-0">

                        <label class="form-label">
                            Ongkir
                        </label>

                        <input
                            type="text"
                            id="shipping_cost_display"
                            class="form-control"
                            value="Rp 0"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="shipping_cost"
                            id="shipping_cost"
                            value="0"
                        >

                    </div>

                </div>


                {{-- PAYMENT --}}
                <div class="checkout-card p-4 mt-4">

                    <h4 class="mb-4">
                        Metode Pembayaran
                    </h4>

                    <div class="mb-3">

                        <select
                            name="payment_method"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Pembayaran
                            </option>

                            <option value="QRIS">
                                QRIS
                            </option>

                            <option value="BANK_TRANSFER">
                                Bank Transfer
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- SUMMARY --}}
            <div class="col-lg-5">

                <div class="checkout-card p-4">

                    <h4>
                        Ringkasan Pesanan
                    </h4>

                    <hr>

                    @foreach ($products as $product)

                        @php
                            $quantity =
                                $cart[$product->id]['quantity'];

                            $itemTotal =
                                $product->price * $quantity;
                        @endphp

                        <div class="d-flex justify-content-between mb-3">

                            <div>
                                <div>
                                    {{ $product->name }}
                                </div>

                                <small class="text-secondary">
                                    {{ $quantity }} ×
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </small>
                            </div>

                            <strong>
                                Rp {{ number_format($itemTotal, 0, ',', '.') }}
                            </strong>

                        </div>

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between mt-2">

                        <span>
                            Ongkir
                        </span>

                        <strong id="summaryShipping">
                            Rp 0
                        </strong>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fs-5">

                        <strong>
                            Total
                        </strong>

                        <strong
                            class="price"
                            id="summaryTotal"
                        >
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </strong>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-light w-100 mt-4"
                    >
                        Buat Pesanan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>


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

    const subtotal = {{ $subtotal }};


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

        shippingCostDisplay.value =
            'Rp ' +
            cost.toLocaleString('id-ID');

        summaryShipping.textContent =
            'Rp ' +
            cost.toLocaleString('id-ID');

        summaryTotal.textContent =
            'Rp ' +
            (subtotal + cost)
                .toLocaleString('id-ID');
    }


    citySelect.addEventListener(
        'change',
        updateShipping
    );

    courierSelect.addEventListener(
        'change',
        updateShipping
    );
</script>

</body>
</html>