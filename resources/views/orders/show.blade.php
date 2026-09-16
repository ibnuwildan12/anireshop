<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Detail Pesanan - Anireshop</title>

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

        .order-card {
            background: #18181f;
            border: 1px solid #292936;
            border-radius: 15px;
        }

        .price {
            color: #ff4fd8;
            font-weight: 700;
        }

        .status {
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
            href="{{ route('home') }}"
            class="btn btn-outline-light btn-sm"
        >
            Home
        </a>

    </div>
</nav>


<div class="container py-5">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>
                Detail Pesanan
            </h1>

            <p class="text-secondary mb-0">
                {{ $order->order_number }}
            </p>
        </div>

        <span class="status">
            {{ $order->order_status }}
        </span>

    </div>


    {{-- ORDER INFORMATION --}}
    <div class="order-card p-4 mb-4">

        <h4 class="mb-4">
            Informasi Pesanan
        </h4>

        <div class="row g-3">

            <div class="col-md-6">

                <strong>
                    Nomor Pesanan
                </strong>

                <div class="text-secondary">
                    {{ $order->order_number }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>
                    Status Pesanan
                </strong>

                <div class="status">
                    {{ $order->order_status }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>
                    Status Pembayaran
                </strong>

                <div class="status">
                    {{ $order->payment_status }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>
                    Metode Pembayaran
                </strong>

                <div class="text-secondary">
                    {{ $order->payment_method }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>
                    Kurir
                </strong>

                <div class="text-secondary">
                    {{ $order->courier ?? '-' }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>
                    Batas Pembayaran
                </strong>

                <div class="text-secondary">

                    @if ($order->expires_at)
                        {{ $order->expires_at->format('d M Y H:i') }}
                    @else
                        -
                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- SHIPPING --}}
    <div class="order-card p-4 mb-4">

        <h4 class="mb-4">
            Alamat Pengiriman
        </h4>

        <p class="mb-1">
            {{ $order->shipping_address }}
        </p>

        <p class="text-secondary mb-0">
            {{ $order->shipping_district }},
            {{ $order->shipping_city }},
            {{ $order->shipping_postal_code }}
        </p>

    </div>


    {{-- ITEMS --}}
    <div class="order-card p-4 mb-4">

        <h4 class="mb-4">
            Produk
        </h4>

        @foreach ($order->orderItems as $item)

            <div class="d-flex justify-content-between mb-3">

                <div>

                    <strong>
                        {{ $item->product_name }}
                    </strong>

                    <div class="text-secondary">

                        {{ $item->quantity }}
                        ×
                        Rp {{ number_format($item->price, 0, ',', '.') }}

                    </div>

                    @if ($item->variation_note)

                        <small class="text-secondary">

                            Catatan:
                            {{ $item->variation_note }}

                        </small>

                    @endif

                </div>


                <strong>
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </strong>

            </div>

        @endforeach

    </div>


    {{-- TOTAL --}}
    <div class="order-card p-4">

        <div class="d-flex justify-content-between mb-2">

            <span>
                Ongkir
            </span>

            <strong>
                Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
            </strong>

        </div>


        <hr>


        <div class="d-flex justify-content-between fs-4">

            <strong>
                Total
            </strong>

            <strong class="price">
                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </strong>

        </div>

    </div>


    <div class="mt-4">

        <div class="d-flex gap-2 flex-wrap mt-4">

    @if($order->payment_status === 'PENDING')
        <a href="{{ route('payments.show', $order) }}"
           class="btn btn-primary">
            💳 Bayar Sekarang
        </a>
    @endif

    @if($order->payment_status === 'WAITING_VERIFICATION')
        <span class="btn btn-warning disabled">
            ⏳ Menunggu Verifikasi Admin
        </span>
    @endif

    @if($order->payment_status === 'PAID')
        <span class="btn btn-success disabled">
            ✓ Pembayaran Terverifikasi
        </span>
    @endif

    @if($order->payment_status === 'REJECTED')
        <a href="{{ route('payments.show', $order) }}"
           class="btn btn-danger">
            🔄 Upload Ulang Bukti Pembayaran
        </a>
    @endif

    <a href="{{ url('/') }}" class="btn btn-secondary">
        Kembali Belanja
    </a>

</div>

    </div>

</div>

</body>
</html>