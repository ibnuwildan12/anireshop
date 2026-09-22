@extends('layouts.app')

@section('title', 'Detail Pesanan - Anireshop')

@section('content')

<div class="ani-order-page">

    <div class="container py-5">

        {{-- SUCCESS --}}
        @if (session('success'))

            <div class="ani-order-alert success">
                <div class="ani-order-alert-icon">✓</div>
                <div>{{ session('success') }}</div>
            </div>

        @endif


        {{-- HEADER --}}
        <div class="ani-order-header">

            <div>

                <span class="ani-order-eyebrow">
                    ORDER DETAILS
                </span>

                <h1>
                    Detail Pesanan
                </h1>

                <p>
                    {{ $order->order_number }}
                </p>

            </div>


            <div class="ani-order-status">

                <span class="ani-status-label">
                    STATUS PESANAN
                </span>

                <strong>
                    {{ $order->order_status }}
                </strong>

            </div>

        </div>


        <div class="row g-4 align-items-start">

            {{-- LEFT --}}
            <div class="col-lg-8">


                {{-- ORDER INFORMATION --}}
                <div class="ani-order-card">

                    <div class="ani-order-card-heading">

                        <div class="ani-order-heading-icon">
                            #
                        </div>

                        <div>
                            <span>ORDER</span>
                            <h2>Informasi Pesanan</h2>
                        </div>

                    </div>


                    <div class="ani-order-info-grid">


                        <div class="ani-order-info-item">

                            <span>
                                Nomor Pesanan
                            </span>

                            <strong>
                                {{ $order->order_number }}
                            </strong>

                        </div>


                        <div class="ani-order-info-item">

                            <span>
                                Status Pesanan
                            </span>

                            <strong class="ani-order-status-text">
                                {{ $order->order_status }}
                            </strong>

                        </div>


                        <div class="ani-order-info-item">

                            <span>
                                Status Pembayaran
                            </span>

                            <strong class="ani-order-status-text">
                                {{ $order->payment_status }}
                            </strong>

                        </div>


                        <div class="ani-order-info-item">

                            <span>
                                Metode Pembayaran
                            </span>

                            <strong>
                                {{ $order->payment_method }}
                            </strong>

                        </div>


                        <div class="ani-order-info-item">

                            <span>
                                Kurir
                            </span>

                            <strong>
                                {{ $order->courier ?? '-' }}
                            </strong>

                        </div>


                        @if ($order->tracking_number)

                            <div class="ani-order-info-item">

                                <span>
                                    Nomor Resi
                                </span>

                                <strong class="ani-tracking-number">
                                    {{ $order->tracking_number }}
                                </strong>


                                @php

                                    $trackingUrl = match ($order->courier) {

                                        'JNE' => 'https://www.jne.co.id/',

                                        'J&T' => 'https://jet.co.id/',

                                        default => null,

                                    };

                                @endphp


                                @if ($trackingUrl)

                                    <a
                                        href="{{ $trackingUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="ani-track-btn"
                                    >
                                        🔎 Lacak Pengiriman
                                    </a>

                                @endif

                            </div>

                        @endif


                        @if ($order->payment_status !== 'PAID')

                            <div class="ani-order-info-item">

                                <span>
                                    Batas Pembayaran
                                </span>

                                <strong>
                                    @if ($order->expires_at)

                                        {{ $order->expires_at->format('d M Y H:i') }}

                                    @else

                                        -

                                    @endif
                                </strong>

                            </div>

                        @endif

                    </div>

                </div>



                {{-- SHIPPING --}}
                <div class="ani-order-card">

                    <div class="ani-order-card-heading">

                        <div class="ani-order-heading-icon">
                            📍
                        </div>

                        <div>
                            <span>DELIVERY</span>
                            <h2>Alamat Pengiriman</h2>
                        </div>

                    </div>


                    <div class="ani-address-box">

                        <strong>
                            Alamat Tujuan
                        </strong>

                        <p>
                            {{ $order->shipping_address }}
                        </p>

                        <span>
                            {{ $order->shipping_district }},
                            {{ $order->shipping_city }},
                            {{ $order->shipping_postal_code }}
                        </span>

                    </div>

                </div>



                {{-- PRODUCTS --}}
                <div class="ani-order-card">

                    <div class="ani-order-card-heading">

                        <div class="ani-order-heading-icon">
                            🛍
                        </div>

                        <div>
                            <span>ITEMS</span>
                            <h2>Produk Pesanan</h2>
                        </div>

                    </div>


                    <div class="ani-order-products">

                        @foreach ($order->orderItems as $item)

                            <div class="ani-order-product">

                                <div class="ani-order-product-icon">
                                    🛍
                                </div>


                                <div class="ani-order-product-info">

                                    <strong>
                                        {{ $item->product_name }}
                                    </strong>

                                    <span>
                                        {{ $item->quantity }}
                                        ×
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>

                                    @if ($item->variation_note)

                                        <small>
                                            Catatan: {{ $item->variation_note }}
                                        </small>

                                    @endif

                                </div>


                                <strong class="ani-order-product-total">

                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}

                                </strong>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>



            {{-- RIGHT --}}
            <div class="col-lg-4">


                {{-- TOTAL --}}
                <div class="ani-order-summary">

                    <div class="ani-order-summary-heading">

                        <span>
                            PAYMENT SUMMARY
                        </span>

                        <h2>
                            Ringkasan Pembayaran
                        </h2>

                    </div>


                    <div class="ani-order-total-line">

                        <span>
                            Subtotal Produk
                        </span>

                        <strong>
                            Rp {{ number_format(
                                $order->total_amount - $order->shipping_cost,
                                0,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>


                    <div class="ani-order-total-line">

                        <span>
                            Ongkir
                        </span>

                        <strong>
                            Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="ani-order-summary-divider"></div>


                    <div class="ani-order-grand-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </strong>

                    </div>


                    {{-- PAYMENT STATUS --}}
                    <div class="ani-payment-status-box">

                        @if ($order->payment_status === 'PENDING')

                            <span class="status-icon pending">
                                !
                            </span>

                            <div>
                                <strong>
                                    Pembayaran diperlukan
                                </strong>

                                <small>
                                    Silakan selesaikan pembayaran untuk melanjutkan pesanan.
                                </small>
                            </div>

                        @elseif ($order->payment_status === 'WAITING_VERIFICATION')

                            <span class="status-icon waiting">
                                ⏳
                            </span>

                            <div>
                                <strong>
                                    Menunggu verifikasi
                                </strong>

                                <small>
                                    Bukti pembayaran sedang diperiksa admin.
                                </small>
                            </div>

                        @elseif ($order->payment_status === 'PAID')

                            <span class="status-icon paid">
                                ✓
                            </span>

                            <div>
                                <strong>
                                    Pembayaran terverifikasi
                                </strong>

                                <small>
                                    Pembayaran pesanan ini sudah dikonfirmasi.
                                </small>
                            </div>

                        @elseif ($order->payment_status === 'REJECTED')

                            <span class="status-icon rejected">
                                !
                            </span>

                            <div>
                                <strong>
                                    Pembayaran ditolak
                                </strong>

                                <small>
                                    Silakan upload ulang bukti pembayaran.
                                </small>
                            </div>

                        @endif

                    </div>


                    {{-- ACTION --}}
                    <div class="ani-order-actions">


                        @if ($order->payment_status === 'PENDING')

                            <a
                                href="{{ route('payments.show', $order) }}"
                                class="ani-order-primary-btn"
                            >
                                <span>💳</span>
                                Bayar Sekarang
                                <b>→</b>
                            </a>

                        @endif


                        @if ($order->payment_status === 'WAITING_VERIFICATION')

                            <div class="ani-order-disabled-btn waiting">
                                ⏳ Menunggu Verifikasi Admin
                            </div>

                        @endif


                        @if ($order->payment_status === 'PAID')

                            <div class="ani-order-disabled-btn paid">
                                ✓ Pembayaran Terverifikasi
                            </div>

                        @endif


                        @if ($order->payment_status === 'REJECTED')

                            <a
                                href="{{ route('payments.show', $order) }}"
                                class="ani-order-primary-btn rejected-btn"
                            >
                                <span>🔄</span>
                                Upload Ulang Bukti
                                <b>→</b>
                            </a>

                        @endif


                        @if ($order->order_status === 'SHIPPED')

                            <form
                                action="{{ route('orders.complete', $order) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu sudah menerima pesanan ini?');"
                            >

                                @csrf
                                @method('PUT')

                                <button
                                    type="submit"
                                    class="ani-order-received-btn"
                                >
                                    ✓ Pesanan Diterima
                                </button>

                            </form>

                        @endif


                        <a
                            href="{{ route('products.index') }}"
                            class="ani-order-shop-btn"
                        >
                            ← Kembali Belanja
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection