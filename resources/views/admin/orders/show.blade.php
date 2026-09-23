@extends('layouts.app')

@section('title', 'Detail Order - Admin Anireshop')

@section('content')

<div class="ani-admin-order-detail-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-order-detail-header">

            <div>
                <span class="ani-admin-eyebrow">
                    ORDER MANAGEMENT
                </span>

                <h1>Detail Order</h1>

                <p>
                    {{ $order->order_number }}
                </p>
            </div>

            <a href="{{ route('admin.orders.index') }}"
               class="ani-admin-back-btn">
                ← Kembali ke Orders
            </a>

        </div>


        {{-- ALERT --}}
        @if(session('success'))
            <div class="ani-admin-order-detail-alert success">
                <div class="ani-admin-order-detail-alert-icon">✓</div>

                <div>
                    <strong>Berhasil</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="ani-admin-order-detail-alert error">
                <div class="ani-admin-order-detail-alert-icon">!</div>

                <div>
                    <strong>Terjadi Kesalahan</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif


        {{-- ORDER + CUSTOMER --}}
        <div class="row g-4">

            {{-- ORDER INFORMATION --}}
            <div class="col-lg-6">

                <div class="ani-admin-order-detail-card h-100">

                    <div class="ani-admin-detail-card-header">
                        <div class="ani-admin-detail-card-icon purple">
                            #
                        </div>

                        <div>
                            <span>ORDER INFORMATION</span>
                            <h2>Informasi Order</h2>
                        </div>
                    </div>

                    <div class="ani-admin-detail-card-body">

                        <div class="ani-admin-detail-info-row">
                            <span>Nomor Order</span>
                            <strong>
                                {{ $order->order_number }}
                            </strong>
                        </div>

                        <div class="ani-admin-detail-info-row">
                            <span>Tanggal Order</span>
                            <strong>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </strong>
                        </div>

                        <div class="ani-admin-detail-info-row">
                            <span>Status Order</span>

                            <span class="ani-admin-detail-status order-status">
                                {{ $order->order_status }}
                            </span>
                        </div>

                        <div class="ani-admin-detail-info-row">
                            <span>Status Pembayaran</span>

                            <span class="ani-admin-detail-status payment-status">
                                {{ $order->payment_status }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- CUSTOMER --}}
            <div class="col-lg-6">

                <div class="ani-admin-order-detail-card h-100">

                    <div class="ani-admin-detail-card-header">
                        <div class="ani-admin-detail-card-icon pink">
                            👤
                        </div>

                        <div>
                            <span>CUSTOMER INFORMATION</span>
                            <h2>Informasi Customer</h2>
                        </div>
                    </div>

                    <div class="ani-admin-detail-card-body">

                        <div class="ani-admin-detail-info-row">
                            <span>Nama</span>
                            <strong>
                                {{ $order->user->name }}
                            </strong>
                        </div>

                        <div class="ani-admin-detail-info-row">
                            <span>Email</span>
                            <strong>
                                {{ $order->user->email }}
                            </strong>
                        </div>

                        <div class="ani-admin-detail-info-row">
                            <span>WhatsApp</span>
                            <strong>
                                {{ $order->user->whatsapp ?? '-' }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCTS --}}
        <div class="ani-admin-order-detail-card mt-4">

            <div class="ani-admin-detail-card-header">

                <div class="ani-admin-detail-card-icon purple">
                    🛍
                </div>

                <div>
                    <span>ORDER ITEMS</span>
                    <h2>Produk</h2>
                </div>

            </div>

            <div class="ani-admin-order-products-wrapper">

                <div class="table-responsive">

                    <table class="ani-admin-order-products-table">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Variasi / Catatan</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($order->orderItems as $item)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $item->product_name }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="ani-admin-variation">
                                            {{ $item->variation_note ?: '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="ani-admin-quantity">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="ani-admin-item-price">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong class="ani-admin-item-subtotal">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- SHIPPING + PAYMENT --}}
        <div class="row g-4 mt-0">

            {{-- SHIPPING --}}
            <div class="col-lg-6">

                <div class="ani-admin-order-detail-card h-100">

                    <div class="ani-admin-detail-card-header">

                        <div class="ani-admin-detail-card-icon green">
                            🚚
                        </div>

                        <div>
                            <span>SHIPPING INFORMATION</span>
                            <h2>Alamat Pengiriman</h2>
                        </div>

                    </div>

                    <div class="ani-admin-detail-card-body">

                        <div class="ani-admin-shipping-address">

                            <p>
                                {{ $order->shipping_address }}
                            </p>

                            <p>
                                {{ $order->shipping_district }},
                                {{ $order->shipping_city }}
                            </p>

                            <p>
                                {{ $order->shipping_postal_code }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PAYMENT --}}
            <div class="col-lg-6">

                <div class="ani-admin-order-detail-card h-100">

                    <div class="ani-admin-detail-card-header">

                        <div class="ani-admin-detail-card-icon pink">
                            💳
                        </div>

                        <div>
                            <span>PAYMENT INFORMATION</span>
                            <h2>Pembayaran</h2>
                        </div>

                    </div>

                    <div class="ani-admin-detail-card-body">

                        <div class="ani-admin-detail-info-row">

                            <span>Metode</span>

                            <strong>
                                {{ $order->payment_method }}
                            </strong>

                        </div>


                        <div class="ani-admin-detail-info-row">

                            <span>Bukti Pembayaran</span>

                            <div>

                                @if($order->payment_proof)

                                    <a href="{{ asset('storage/' . $order->payment_proof) }}"
                                       target="_blank"
                                       class="ani-admin-payment-proof-btn">
                                        Lihat Bukti
                                    </a>

                                @else

                                    <span class="ani-admin-no-proof">
                                        Belum ada bukti
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="ani-admin-detail-info-row">

                            <span>Waktu Upload</span>

                            <strong>
                                {{ $order->payment_submitted_at
                                    ? $order->payment_submitted_at->format('d/m/Y H:i')
                                    : '-' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL --}}
        <div class="ani-admin-order-total-card mt-4">

            <div class="ani-admin-total-row">
                <span>Subtotal Produk</span>

                <strong>
                    Rp {{ number_format(
                        $order->total_amount - $order->shipping_cost,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>
            </div>

            <div class="ani-admin-total-row">
                <span>Ongkir</span>

                <strong>
                    Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                </strong>
            </div>

            <div class="ani-admin-total-divider"></div>

            <div class="ani-admin-total-final">
                <span>Total</span>

                <strong>
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </strong>
            </div>

        </div>


        {{-- UPDATE ORDER --}}
        <div class="ani-admin-order-update-card mt-4">

            <div class="ani-admin-detail-card-header">

                <div class="ani-admin-detail-card-icon purple">
                    ⚙
                </div>

                <div>
                    <span>ORDER MANAGEMENT</span>
                    <h2>Update Order</h2>
                </div>

            </div>


            <form action="{{ route('admin.orders.update', $order) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="ani-admin-order-update-body">

                    {{-- STATUS --}}
                    <div class="ani-admin-order-field">

                        <label for="order_status">
                            Status Order
                        </label>

                        <select name="order_status"
                                id="order_status"
                                class="@error('order_status') is-invalid @enderror">

                            <option value="PENDING"
                                {{ $order->order_status === 'PENDING' ? 'selected' : '' }}>
                                PENDING
                            </option>

                            <option value="PROCESSING"
                                {{ $order->order_status === 'PROCESSING' ? 'selected' : '' }}>
                                PROCESSING
                            </option>

                            <option value="SHIPPED"
                                {{ $order->order_status === 'SHIPPED' ? 'selected' : '' }}>
                                SHIPPED
                            </option>

                            <option value="COMPLETED"
                                {{ $order->order_status === 'COMPLETED' ? 'selected' : '' }}>
                                COMPLETED
                            </option>

                        </select>

                        @error('order_status')
                            <div class="ani-admin-order-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- COURIER --}}
                    <div class="ani-admin-order-field">

                        <label for="courier">
                            Courier
                        </label>

                        <select name="courier"
                                id="courier"
                                class="@error('courier') is-invalid @enderror">

                            <option value="">
                                -- Pilih Courier --
                            </option>

                            <option value="JNE"
                                {{ old('courier', $order->courier) === 'JNE' ? 'selected' : '' }}>
                                JNE
                            </option>

                            <option value="J&T"
                                {{ old('courier', $order->courier) === 'J&T' ? 'selected' : '' }}>
                                J&T
                            </option>

                        </select>

                        @error('courier')
                            <div class="ani-admin-order-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TRACKING --}}
                    <div class="ani-admin-order-field">

                        <label for="tracking_number">
                            Tracking Number
                        </label>

                        <input type="text"
                               id="tracking_number"
                               name="tracking_number"
                               value="{{ old('tracking_number', $order->tracking_number) }}"
                               class="@error('tracking_number') is-invalid @enderror"
                               placeholder="Contoh: JNE123456789">

                        @error('tracking_number')
                            <div class="ani-admin-order-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="ani-admin-order-update-footer">

                    <span>
                        Perubahan akan diterapkan pada order ini.
                    </span>

                    <button type="submit"
                            class="ani-admin-order-save-btn">
                        ✓ Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection