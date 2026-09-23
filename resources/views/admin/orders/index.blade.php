@extends('layouts.app')

@section('title', 'Orders - Admin Anireshop')

@section('content')

<div class="ani-admin-orders-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-orders-header">

            <div>
                <span class="ani-admin-eyebrow">
                    ORDER MANAGEMENT
                </span>

                <h1>Orders</h1>

                <p>
                    Kelola pesanan customer Anireshop.
                </p>
            </div>

        </div>


        {{-- ALERT --}}
        @if(session('success'))

            <div class="ani-admin-order-alert success">
                <div class="ani-admin-order-alert-icon">
                    ✓
                </div>

                <div>
                    <strong>Berhasil</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>

        @endif


        @if(session('error'))

            <div class="ani-admin-order-alert error">
                <div class="ani-admin-order-alert-icon">
                    !
                </div>

                <div>
                    <strong>Terjadi Kesalahan</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>

        @endif


        {{-- ORDERS CARD --}}
        <div class="ani-admin-orders-card">

            {{-- CARD HEADER --}}
            <div class="ani-admin-orders-card-header">

                <div>
                    <span class="ani-admin-card-eyebrow">
                        ORDER LIST
                    </span>

                    <h2>Daftar Pesanan</h2>
                </div>

                <div class="ani-admin-order-count">
                    {{ $orders->total() }} Order
                </div>

            </div>


            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="ani-admin-orders-table">

                    <thead>
                        <tr>
                            <th class="col-number">#</th>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status Order</th>
                            <th>Courier</th>
                            <th class="col-action">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            @php
                                $paymentClass = match($order->payment_status) {
                                    'PAID' => 'paid',
                                    'WAITING_VERIFICATION' => 'waiting',
                                    'REJECTED' => 'rejected',
                                    default => 'default',
                                };

                                $orderClass = match($order->order_status) {
                                    'PROCESSING' => 'processing',
                                    'SHIPPED' => 'shipped',
                                    'COMPLETED' => 'completed',
                                    'CANCELLED' => 'cancelled',
                                    'EXPIRED' => 'expired',
                                    default => 'default',
                                };
                            @endphp

                            <tr>

                                {{-- NUMBER --}}
                                <td class="order-number">
                                    {{ $orders->firstItem() + $loop->index }}
                                </td>


                                {{-- ORDER --}}
                                <td>

                                    <div class="ani-admin-order-id">
                                        {{ $order->order_number }}
                                    </div>

                                    <small class="ani-admin-order-date">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </small>

                                </td>


                                {{-- CUSTOMER --}}
                                <td>

                                    <div class="ani-admin-customer">

                                        <div class="ani-admin-customer-avatar">
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

                                    <span class="ani-admin-order-total">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- PAYMENT --}}
                                <td>

                                    <span class="ani-admin-status-badge payment {{ $paymentClass }}">
                                        {{ $order->payment_status }}
                                    </span>

                                </td>


                                {{-- ORDER STATUS --}}
                                <td>

                                    <span class="ani-admin-status-badge order {{ $orderClass }}">
                                        {{ $order->order_status }}
                                    </span>

                                </td>


                                {{-- COURIER --}}
                                <td>

                                    @if($order->courier)

                                        <span class="ani-admin-courier-badge">
                                            {{ $order->courier }}
                                        </span>

                                    @else

                                        <span class="ani-admin-no-courier">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="ani-admin-order-detail-btn">
                                        Detail
                                        <span>→</span>
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8">

                                    <div class="ani-admin-order-empty">

                                        <div class="ani-admin-order-empty-icon">
                                            📦
                                        </div>

                                        <strong>
                                            Belum Ada Order
                                        </strong>

                                        <p>
                                            Belum ada pesanan customer
                                            yang tersedia.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($orders->hasPages())

                <div class="ani-admin-orders-footer">

                    <div class="ani-admin-pagination-info">
                        Menampilkan
                        <strong>{{ $orders->firstItem() }}</strong>
                        –
                        <strong>{{ $orders->lastItem() }}</strong>
                        dari
                        <strong>{{ $orders->total() }}</strong>
                        order
                    </div>

                    <nav>
                        <ul class="pagination mb-0">

                            @if ($orders->onFirstPage())

                                <li class="page-item disabled">
                                    <span class="page-link">‹</span>
                                </li>

                            @else

                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ $orders->previousPageUrl() }}">
                                        ‹
                                    </a>
                                </li>

                            @endif


                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)

                                <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">

                                    <a class="page-link"
                                       href="{{ $url }}">
                                        {{ $page }}
                                    </a>

                                </li>

                            @endforeach


                            @if ($orders->hasMorePages())

                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ $orders->nextPageUrl() }}">
                                        ›
                                    </a>
                                </li>

                            @else

                                <li class="page-item disabled">
                                    <span class="page-link">›</span>
                                </li>

                            @endif

                        </ul>
                    </nav>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection