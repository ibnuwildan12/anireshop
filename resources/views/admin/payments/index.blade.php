@extends('layouts.app')

@section('title', 'Payment Verification - Admin Anireshop')

@section('content')

<div class="ani-admin-payments-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-payments-header">

            <div>
                <span class="ani-admin-eyebrow">
                    PAYMENT MANAGEMENT
                </span>

                <h1>
                    Payment Verification
                </h1>

                <p>
                    Daftar pembayaran yang menunggu verifikasi.
                </p>
            </div>

            <div class="ani-admin-payment-waiting-badge">
                <span>●</span>
                {{ $orders->total() }} Menunggu
            </div>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))

            <div class="ani-admin-payment-alert success">

                <div class="ani-admin-payment-alert-icon">
                    ✓
                </div>

                <div>
                    <strong>Berhasil</strong>
                    <p>{{ session('success') }}</p>
                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="ani-admin-payment-alert error">

                <div class="ani-admin-payment-alert-icon">
                    !
                </div>

                <div>
                    <strong>Terjadi Kesalahan</strong>
                    <p>{{ session('error') }}</p>
                </div>

            </div>

        @endif


        {{-- PAYMENT LIST --}}
        @if($orders->count() > 0)

            <div class="ani-admin-payment-card">

                {{-- CARD HEADER --}}
                <div class="ani-admin-payment-card-header">

                    <div>
                        <span class="ani-admin-card-eyebrow">
                            PAYMENT QUEUE
                        </span>

                        <h2>
                            Pembayaran Menunggu Verifikasi
                        </h2>
                    </div>

                    <div class="ani-admin-payment-count">
                        {{ $orders->total() }} Payment
                    </div>

                </div>


                {{-- TABLE --}}
                <div class="table-responsive">

                    <table class="ani-admin-payment-table">

                        <thead>

                            <tr>

                                <th>
                                    Order
                                </th>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Payment
                                </th>

                                <th>
                                    Submitted
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="payment-action-column">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    {{-- ORDER --}}
                                    <td>

                                        <div class="ani-admin-payment-order">

                                            <strong>
                                                {{ $order->order_number }}
                                            </strong>

                                            <small>
                                                Order #{{ $order->id }}
                                            </small>

                                        </div>

                                    </td>


                                    {{-- CUSTOMER --}}
                                    <td>

                                        <div class="ani-admin-payment-customer">

                                            <div class="ani-admin-payment-avatar">
                                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $order->user->name }}
                                                </strong>

                                                <small>
                                                    {{ $order->user->email }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                        <span class="ani-admin-payment-price">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    {{-- PAYMENT METHOD --}}
                                    <td>

                                        @if($order->payment_method === 'QRIS')

                                            <span class="ani-admin-payment-method qris">
                                                <span>▣</span>
                                                QRIS
                                            </span>

                                        @else

                                            <span class="ani-admin-payment-method bank">
                                                <span>▤</span>
                                                Bank Transfer
                                            </span>

                                        @endif

                                    </td>


                                    {{-- SUBMITTED --}}
                                    <td>

                                        @if($order->payment_submitted_at)

                                            <div class="ani-admin-payment-submitted">

                                                <strong>
                                                    {{ $order->payment_submitted_at->format('d/m/Y') }}
                                                </strong>

                                                <small>
                                                    {{ $order->payment_submitted_at->format('H:i') }} WIB
                                                </small>

                                            </div>

                                        @else

                                            <span class="ani-admin-payment-no-date">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        <span class="ani-admin-payment-status">
                                            <span>●</span>
                                            WAITING VERIFICATION
                                        </span>

                                    </td>


                                    {{-- ACTION --}}
                                    <td>

                                        <a href="{{ route('admin.payments.show', $order) }}"
                                           class="ani-admin-payment-detail-btn">

                                            Detail

                                            <span>→</span>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- FOOTER --}}
                <div class="ani-admin-payment-footer">

                    <div class="ani-admin-pagination-info">

                        Menampilkan

                        <strong>
                            {{ $orders->firstItem() }}
                        </strong>

                        –

                        <strong>
                            {{ $orders->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $orders->total() }}
                        </strong>

                        pembayaran

                    </div>

                    <div class="ani-admin-payment-pagination">

                        {{ $orders->links() }}

                    </div>

                </div>

            </div>


        @else

            {{-- EMPTY STATE --}}
            <div class="ani-admin-payment-card">

                <div class="ani-admin-payment-empty">

                    <div class="ani-admin-payment-empty-icon">
                        ✓
                    </div>

                    <strong>
                        Tidak Ada Pembayaran
                    </strong>

                    <p>
                        Belum ada pembayaran yang menunggu verifikasi.
                    </p>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection