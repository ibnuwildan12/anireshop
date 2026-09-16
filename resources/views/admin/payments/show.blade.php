@extends('layouts.app')

@section('title', 'Payment Verification - Anireshop')

@section('content')

<div class="container py-5">

    <div class="mb-4">

        <a
            href="{{ route('admin.payments.index') }}"
            class="btn btn-outline-ani mb-3"
        >
            ← Kembali
        </a>

        <h1 class="ani-section-title">
            Payment <span>Verification</span>
        </h1>

        <p class="ani-section-subtitle">
            Detail pembayaran pesanan {{ $order->order_number }}
        </p>

    </div>


    <div class="row g-4">

        {{-- ORDER INFO --}}
        <div class="col-lg-7">

            <div class="ani-card p-4">

                <h4 class="mb-4">
                    Informasi Pesanan
                </h4>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        Order Number
                    </div>

                    <div class="col-sm-7 fw-bold">
                        {{ $order->order_number }}
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        Customer
                    </div>

                    <div class="col-sm-7">
                        {{ $order->user->name }}
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        WhatsApp
                    </div>

                    <div class="col-sm-7">
                        {{ $order->user->whatsapp }}
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        Payment Method
                    </div>

                    <div class="col-sm-7">
                        {{ $order->payment_method }}
                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        Payment Submitted
                    </div>

                    <div class="col-sm-7">

                        @if($order->payment_submitted_at)

                            {{ $order->payment_submitted_at->format('d-m-Y H:i:s') }}

                        @else

                            -

                        @endif

                    </div>

                </div>


                <div class="row mb-3">

                    <div class="col-sm-5 text-muted">
                        Payment Status
                    </div>

                    <div class="col-sm-7">

                        <span class="ani-badge">
                            {{ $order->payment_status }}
                        </span>

                    </div>

                </div>


                <hr>


                <h5 class="mb-3">
                    Produk
                </h5>


                @foreach($order->orderItems as $item)

                    <div class="d-flex justify-content-between border-bottom py-3">

                        <div>

                            <strong>
                                {{ $item->product_name }}
                            </strong>

                            @if($item->variation_note)

                                <div class="text-muted small">
                                    Variasi:
                                    {{ $item->variation_note }}
                                </div>

                            @endif

                            <div class="text-muted small">
                                {{ $item->quantity }} ×
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>

                        </div>


                        <div class="fw-bold">

                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}

                        </div>

                    </div>

                @endforeach


                <div class="d-flex justify-content-between mt-4">

                    <span>
                        Ongkir
                    </span>

                    <strong>
                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between mt-2 fs-5">

                    <strong>
                        Total
                    </strong>

                    <strong class="price">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- PAYMENT PROOF --}}
        <div class="col-lg-5">

            <div class="ani-card p-4">

                <h4 class="mb-4">
                    Bukti Pembayaran
                </h4>


                @if($order->payment_proof)

                    <div class="text-center">

                        <img
                            src="{{ asset('storage/' . $order->payment_proof) }}"
                            alt="Bukti Pembayaran"
                            class="img-fluid rounded"
                            style="max-height: 500px;"
                        >

                    </div>

                @else

                    <div class="alert alert-warning">
                        Bukti pembayaran belum tersedia.
                    </div>

                @endif


                @if($order->payment_status === 'WAITING_VERIFICATION')

                    <div class="d-grid gap-2 mt-4">

                        {{-- APPROVE --}}

                        <form
                            method="POST"
                            action="{{ route('admin.payments.approve', $order) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-ani w-100"
                                onclick="return confirm('Setujui pembayaran ini?')"
                            >
                                ✓ Approve Payment
                            </button>

                        </form>


                        {{-- REJECT --}}

                        <form
                            method="POST"
                            action="{{ route('admin.payments.reject', $order) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-outline-danger w-100"
                                onclick="return confirm('Tolak pembayaran ini?')"
                            >
                                ✕ Reject Payment
                            </button>

                        </form>

                    </div>

                @else

                    <div class="alert alert-info mt-4">
                        Pembayaran ini sudah diproses.
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection