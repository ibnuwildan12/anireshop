@extends('layouts.app')

@section('title', 'Payment Verification - Anireshop')

@section('content')

<div class="admin-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="admin-header">

            <div>
                <div class="admin-label">
                    ADMIN PANEL
                </div>

                <h1>
                    Payment Verification
                </h1>

                <p>
                    Daftar pembayaran yang menunggu verifikasi.
                </p>
            </div>

            <div>
                <span class="admin-badge">
                    {{ $orders->total() }} Menunggu
                </span>
            </div>

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


        {{-- PAYMENT LIST --}}

        @if($orders->count() > 0)

            <div class="ani-card overflow-hidden">

                <div class="table-responsive">

                    <table class="table ani-admin-table align-middle mb-0">

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

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    {{-- ORDER --}}

                                    <td>

                                        <strong class="order-number">
                                            {{ $order->order_number }}
                                        </strong>

                                    </td>


                                    {{-- CUSTOMER --}}

                                    <td>

                                        <strong>
                                            {{ $order->user->name }}
                                        </strong>

                                        <br>

                                        <small class="customer-email">
                                            {{ $order->user->email }}
                                        </small>

                                    </td>


                                    {{-- TOTAL --}}

                                    <td>

                                        <strong class="payment-price">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </strong>

                                    </td>


                                    {{-- PAYMENT METHOD --}}

                                    <td>

                                        @if($order->payment_method === 'QRIS')

                                            <span class="payment-method qris">
                                                QRIS
                                            </span>

                                        @else

                                            <span class="payment-method bank">
                                                Bank Transfer
                                            </span>

                                        @endif

                                    </td>


                                    {{-- SUBMITTED --}}

                                    <td>

                                        @if($order->payment_submitted_at)

                                            <span class="submitted-date">

                                                {{ $order->payment_submitted_at->format('d/m/Y') }}

                                                <br>

                                                <small>
                                                    {{ $order->payment_submitted_at->format('H:i') }}
                                                </small>

                                            </span>

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        <span class="payment-status">
                                            WAITING VERIFICATION
                                        </span>

                                    </td>


                                    {{-- ACTION --}}

                                    <td>

                                        <a
                                            href="{{ route('admin.payments.show', $order) }}"
                                            class="btn btn-ani btn-sm"
                                        >
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}

            <div class="admin-pagination mt-4">

                {{ $orders->links() }}

            </div>


        @else

            {{-- EMPTY STATE --}}

            <div class="ani-card">

                <div class="empty-payment">

                    <div class="empty-payment-icon">
                        ✓
                    </div>

                    <h4>
                        Tidak ada pembayaran
                    </h4>

                    <p>
                        Belum ada pembayaran yang menunggu verifikasi.
                    </p>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection