@extends('layouts.app')

@section('title', 'Pesanan Saya - Anireshop')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <div class="text-uppercase fw-bold"
             style="color:#ec4899; letter-spacing:2px; font-size:13px;">
            CUSTOMER AREA
        </div>

        <h1 class="fw-bold text-white">
            Pesanan Saya
        </h1>

        <p style="color:#b8b8b8;">
            Lihat semua pesanan dan status pembayaran kamu.
        </p>
    </div>


    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- ORDER LIST --}}
    @if($orders->count())

        @foreach($orders as $order)

            <div class="ani-card p-4 mb-3">

                <div class="row align-items-center">

                    {{-- ORDER NUMBER --}}
                    <div class="col-lg-3 mb-3 mb-lg-0">

                        <small style="color:#999;">
                            Nomor Pesanan
                        </small>

                        <div class="fw-bold"
                             style="color:#f472b6;">
                            {{ $order->order_number }}
                        </div>

                        <small style="color:#999;">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </small>

                    </div>


                    {{-- TOTAL --}}
                    <div class="col-lg-2 mb-3 mb-lg-0">

                        <small style="color:#999;">
                            Total
                        </small>

                        <div class="fw-bold text-white">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>

                    </div>


                    {{-- PAYMENT STATUS --}}
                    <div class="col-lg-2 mb-3 mb-lg-0">

                        <small style="color:#999;">
                            Pembayaran
                        </small>

                        <div class="mt-1">

                            @if($order->payment_status === 'PENDING')

                                <span class="badge bg-warning text-dark">
                                    PENDING
                                </span>

                            @elseif($order->payment_status === 'WAITING_VERIFICATION')

                                <span class="badge"
                                      style="background:#7c3aed;">
                                    MENUNGGU VERIFIKASI
                                </span>

                            @elseif($order->payment_status === 'PAID')

                                <span class="badge bg-success">
                                    PAID
                                </span>

                            @elseif($order->payment_status === 'REJECTED')

                                <span class="badge bg-danger">
                                    REJECTED
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ORDER STATUS --}}
                    <div class="col-lg-2 mb-3 mb-lg-0">

                        <small style="color:#999;">
                            Status Pesanan
                        </small>

                        <div class="mt-1">

                            <span class="badge"
                                  style="background:#222; color:#fff; border:1px solid #444;">
                                {{ $order->order_status }}
                            </span>

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="col-lg-3 text-lg-end">

                        <a href="{{ route('orders.show', $order) }}"
                           class="btn btn-ani">
                            Detail
                        </a>

                        @if(in_array($order->payment_status, ['PENDING', 'REJECTED']))

                            <a href="{{ route('payments.show', $order) }}"
                               class="btn btn-secondary">
                                Bayar
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @endforeach


        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>


    @else

        {{-- EMPTY STATE --}}
        <div class="ani-card text-center p-5">

            <div style="font-size:50px;">
                🛒
            </div>

            <h4 class="text-white fw-bold mt-3">
                Belum Ada Pesanan
            </h4>

            <p style="color:#aaa;">
                Kamu belum memiliki pesanan di Anireshop.
            </p>

            <a href="{{ route('home') }}"
               class="btn btn-ani">
                Mulai Belanja
            </a>

        </div>

    @endif

</div>

@endsection