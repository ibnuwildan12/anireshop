@extends('layouts.app')

@section('title', 'Orders - Anireshop')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Orders</h2>
        <p class="text-secondary mb-0">
            Kelola pesanan customer Anireshop
        </p>
    </div>

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

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status Order</th>
                            <th>Courier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr>

                                <td>
                                    {{ $orders->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $order->order_number }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>

                                <td>
                                    <div>
                                        {{ $order->user->name }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $order->user->email }}
                                    </small>
                                </td>

                                <td>
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>

                                <td>
                                    @php
                                        $paymentClass = match($order->payment_status) {
                                            'PAID' => 'bg-success',
                                            'WAITING_VERIFICATION' => 'bg-warning text-dark',
                                            'REJECTED' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $paymentClass }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>

                                <td>
                                    @php
                                        $orderClass = match($order->order_status) {
                                            'PROCESSING' => 'bg-info text-dark',
                                            'SHIPPED' => 'bg-primary',
                                            'COMPLETED' => 'bg-success',
                                            'CANCELLED' => 'bg-danger',
                                            'EXPIRED' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $orderClass }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $order->courier ?? '-' }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-light">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="text-center text-secondary py-5">
                                    Belum ada order.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

            {{-- PAGINATION --}}
            @if($orders->hasPages())

                <div class="mt-4 d-flex justify-content-center">

                    <nav>
                        <ul class="pagination pagination-sm mb-0">

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