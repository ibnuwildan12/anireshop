@extends('layouts.app')

@section('title', 'Detail Order - Anireshop')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Detail Order</h2>
            <p class="text-secondary mb-0">
                {{ $order->order_number }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-secondary">
            ← Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- INFORMASI ORDER --}}
    <div class="row g-4">

        <div class="col-lg-6">

            <div class="card bg-dark border-secondary h-100">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Informasi Order
                    </h5>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Nomor Order
                        </small>
                        <strong>
                            {{ $order->order_number }}
                        </strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Tanggal Order
                        </small>
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Status Order
                        </small>

                        <span class="badge bg-secondary">
                            {{ $order->order_status }}
                        </span>
                    </div>

                    <div>
                        <small class="text-secondary d-block">
                            Status Pembayaran
                        </small>

                        <span class="badge bg-secondary">
                            {{ $order->payment_status }}
                        </span>
                    </div>

                </div>
            </div>

        </div>


        {{-- CUSTOMER --}}
        <div class="col-lg-6">

            <div class="card bg-dark border-secondary h-100">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Informasi Customer
                    </h5>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Nama
                        </small>

                        {{ $order->user->name }}
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Email
                        </small>

                        {{ $order->user->email }}
                    </div>

                    <div>
                        <small class="text-secondary d-block">
                            WhatsApp
                        </small>

                        {{ $order->user->whatsapp ?? '-' }}
                    </div>

                </div>
            </div>

        </div>

    </div>


    {{-- PRODUK --}}
    <div class="card bg-dark border-secondary mt-4">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">
                Produk
            </h5>

            <div class="table-responsive">

                <table class="table table-dark align-middle">

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
                                    {{ $item->product_name }}
                                </td>

                                <td>
                                    {{ $item->variation_note ?: '-' }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- PENGIRIMAN --}}
    <div class="row g-4 mt-0">

        <div class="col-lg-6">

            <div class="card bg-dark border-secondary h-100">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Alamat Pengiriman
                    </h5>

                    <p class="mb-2">
                        {{ $order->shipping_address }}
                    </p>

                    <p class="mb-2">
                        {{ $order->shipping_district }},
                        {{ $order->shipping_city }}
                    </p>

                    <p class="mb-0">
                        {{ $order->shipping_postal_code }}
                    </p>

                </div>

            </div>

        </div>


        {{-- PEMBAYARAN --}}
        <div class="col-lg-6">

            <div class="card bg-dark border-secondary h-100">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Pembayaran
                    </h5>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Metode
                        </small>

                        {{ $order->payment_method }}
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block">
                            Bukti Pembayaran
                        </small>

                        @if($order->payment_proof)

                            <a href="{{ asset('storage/' . $order->payment_proof) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-light">
                                Lihat Bukti Pembayaran
                            </a>

                        @else

                            <span class="text-secondary">
                                Belum ada bukti pembayaran
                            </span>

                        @endif

                    </div>

                    <div>
                        <small class="text-secondary d-block">
                            Waktu Upload
                        </small>

                        {{ $order->payment_submitted_at
                            ? $order->payment_submitted_at->format('d/m/Y H:i')
                            : '-' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL --}}
    <div class="card bg-dark border-secondary mt-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal Produk</span>

                <span>
                    Rp {{ number_format(
                        $order->total_amount - $order->shipping_cost,
                        0,
                        ',',
                        '.'
                    ) }}
                </span>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <span>Ongkir</span>

                <span>
                    Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                </span>
            </div>

            <hr>

            <div class="d-flex justify-content-between fs-5 fw-bold">

                <span>Total</span>

                <span>
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </span>

            </div>

        </div>

    </div>


    {{-- UPDATE ORDER --}}
<div class="card bg-dark border-secondary mt-4">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-4">
            Update Order
        </h5>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.orders.update', $order) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label for="order_status" class="form-label">
                    Status Order
                </label>

                <select name="order_status"
                        id="order_status"
                        class="form-select @error('order_status') is-invalid @enderror">

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
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-3">

                <label for="courier" class="form-label">
                    Courier
                </label>

                <select name="courier"
                        id="courier"
                        class="form-select @error('courier') is-invalid @enderror">

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
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-4">

                <label for="tracking_number" class="form-label">
                    Tracking Number
                </label>

                <input type="text"
                       id="tracking_number"
                       name="tracking_number"
                       value="{{ old('tracking_number', $order->tracking_number) }}"
                       class="form-control @error('tracking_number') is-invalid @enderror"
                       placeholder="Contoh: JNE123456789">

                @error('tracking_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <button type="submit" class="btn btn-ani">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</div>
@endsection