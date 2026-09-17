@extends('layouts.app')

@section('title', 'Pembayaran - Anireshop')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- HEADER --}}
            <div class="mb-4">
                <div class="text-uppercase fw-bold"
                     style="color:#ec4899; letter-spacing:2px; font-size:13px;">
                    PEMBAYARAN
                </div>

                <h1 class="fw-bold text-white mb-1">
                    Pembayaran Pesanan
                </h1>

                <p style="color:#b8a9c9;">
                    {{ $order->order_number }}
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


            {{-- ORDER SUMMARY --}}
            <div class="ani-card p-4 mb-4">

                <h5 class="text-white fw-bold mb-4">
                    Ringkasan Pesanan
                </h5>

                @foreach($order->orderItems as $item)

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>
                            <div class="text-white fw-semibold">
                                {{ $item->product_name }}
                            </div>

                            <small style="color:#b8a9c9;">
                                {{ $item->quantity }} ×
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </small>

                            @if($item->variation_note)
                                <div class="mt-1">
                                    <small style="color:#c4b5fd;">
                                        Pilihan: {{ $item->variation_note }}
                                    </small>
                                </div>
                            @endif
                        </div>

                        <div class="text-white fw-bold">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>

                    </div>

                @endforeach

                <hr style="border-color:#3b2454;">

                <div class="d-flex justify-content-between mb-2">
                    <span style="color:#b8a9c9;">
                        Ongkir
                    </span>

                    <span class="text-white">
                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                    </span>
                </div>

                <div class="d-flex justify-content-between">
                    <span class="text-white fw-bold">
                        Total
                    </span>

                    <span style="color:#ec4899; font-size:20px; font-weight:800;">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>

            </div>


            {{-- PAYMENT INFORMATION --}}
            <div class="ani-card p-4 mb-4">

                <h5 class="text-white fw-bold mb-4">
                    Instruksi Pembayaran
                </h5>

                @if($order->payment_method === 'QRIS')

                    <div class="p-4 rounded text-center"
                         style="background:#211331; border:1px solid #3b2454;">

                        <div class="mb-3"
                             style="font-size:40px;">
                            📱
                        </div>

                        <h5 class="text-white fw-bold">
                            Pembayaran QRIS
                        </h5>

                        <p style="color:#b8a9c9;">
                            Silakan lakukan pembayaran menggunakan QRIS Anireshop.
                        </p>

                        {{-- QRIS IMAGE --}}
                        <div class="my-4">
                        <img
                            src="{{ asset('images/qris-anireshop.jpeg') }}"
                            alt="QRIS Anireshop"
                            class="img-fluid rounded"
                            style="max-width: 300px;"
                        >
                        </div>

                    </div>

                    @elseif($order->payment_method === 'BANK_TRANSFER')

                        <div class="p-4 rounded"
                            style="background:#211331; border:1px solid #3b2454;">

                            <h6 class="text-white fw-bold mb-3">
                                Bank Transfer
                            </h6>

                            <p class="mb-1" style="color:#b8a9c9;">
                                Silakan transfer sesuai total pembayaran.
                            </p>


                            <div class="mt-4">

                                {{-- BANK --}}
                                <div style="color:#b8a9c9; font-size:13px;">
                                    Bank
                                </div>

                                <div class="text-white fw-bold mb-3">
                                    {{ config('payment.bank.name') }}
                                </div>


                                {{-- NOMOR REKENING --}}
                                <div style="color:#b8a9c9; font-size:13px;">
                                    Nomor Rekening
                                </div>

                                <div class="text-white fw-bold fs-5 mb-3">
                                    {{ config('payment.bank.account_number') }}
                                </div>


                                {{-- NAMA PEMILIK --}}
                                <div style="color:#b8a9c9; font-size:13px;">
                                    Atas Nama
                                </div>

                                <div class="text-white fw-bold">
                                    {{ config('payment.bank.account_name') }}
                                </div>

                            </div>

                        </div>

                @endif

            </div>

            {{-- UBAH METODE PEMBAYARAN --}}
            @if (in_array($order->payment_status, ['PENDING', 'REJECTED']))

                <div class="ani-card p-4 mb-4">

                    <h5 class="text-white fw-bold mb-3">
                        Ubah Metode Pembayaran
                    </h5>

                    <p style="color:#b8a9c9;">
                        Ingin menggunakan metode pembayaran lain?
                        Silakan pilih metode pembayaran di bawah.
                    </p>

                    <form
                        action="{{ route('payments.method.update', $order) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <select
                                name="payment_method"
                                class="form-select"
                                required
                            >
                                <option value="QRIS"
                                    {{ $order->payment_method === 'QRIS' ? 'selected' : '' }}>
                                    📱 QRIS
                                </option>

                                <option value="BANK_TRANSFER"
                                    {{ $order->payment_method === 'BANK_TRANSFER' ? 'selected' : '' }}>
                                    🏦 Bank Transfer - BRI
                                </option>
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-ani w-100"
                        >
                            Ubah Metode Pembayaran
                        </button>

                    </form>

                </div>

            @endif

            {{-- UPLOAD PAYMENT PROOF --}}
            @if($order->payment_status === 'PENDING')

                <div class="ani-card p-4 mb-4">

                    <h5 class="text-white fw-bold mb-2">
                        Upload Bukti Pembayaran
                    </h5>

                    <p style="color:#b8a9c9;">
                        Upload screenshot atau foto bukti pembayaran.
                        Format JPG, JPEG, atau PNG, maksimal 2 MB.
                    </p>

                    <form action="{{ route('payments.store', $order) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label for="payment_proof"
                                   class="form-label text-white fw-semibold">
                                Bukti Pembayaran
                            </label>

                            <input type="file"
                                   name="payment_proof"
                                   id="payment_proof"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png"
                                   required>

                            @error('payment_proof')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button type="submit"
                                class="btn btn-ani">
                            📤 Kirim Bukti Pembayaran
                        </button>

                    </form>

                </div>

            @elseif($order->payment_status === 'WAITING_VERIFICATION')

                <div class="ani-card p-4 mb-4 text-center">

                    <div style="font-size:45px;">
                        ⏳
                    </div>

                    <h5 class="text-white fw-bold mt-3">
                        Menunggu Verifikasi Admin
                    </h5>

                    <p style="color:#b8a9c9;">
                        Bukti pembayaran sudah dikirim.
                        Silakan tunggu admin melakukan verifikasi.
                    </p>

                    @if($order->payment_submitted_at)
                        <small style="color:#a99ab5;">
                            Dikirim:
                            {{ $order->payment_submitted_at->format('d M Y H:i') }}
                        </small>
                    @endif

                </div>

            @elseif($order->payment_status === 'PAID')

                <div class="ani-card p-4 mb-4 text-center">

                    <div style="font-size:45px;">
                        ✅
                    </div>

                    <h5 class="text-white fw-bold mt-3">
                        Pembayaran Terverifikasi
                    </h5>

                    <p style="color:#b8a9c9;">
                        Pembayaran telah disetujui oleh admin.
                    </p>

                </div>

            @elseif($order->payment_status === 'REJECTED')

                <div class="ani-card p-4 mb-4">

                    <div class="text-center mb-4">

                        <div style="font-size:45px;">
                            ❌
                        </div>

                        <h5 class="text-white fw-bold mt-3">
                            Pembayaran Ditolak
                        </h5>

                        <p style="color:#b8a9c9;">
                            Bukti pembayaran sebelumnya ditolak oleh admin.
                        </p>

                    </div>

                    <div class="alert alert-warning">
                        Silakan upload kembali bukti pembayaran yang benar.
                    </div>

                    <form action="{{ route('payments.store', $order) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label for="payment_proof"
                                   class="form-label text-white fw-semibold">
                                Bukti Pembayaran Baru
                            </label>

                            <input type="file"
                                   name="payment_proof"
                                   id="payment_proof"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png"
                                   required>

                            @error('payment_proof')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button type="submit"
                                class="btn btn-ani">
                            🔄 Upload Ulang
                        </button>

                    </form>

                </div>

            @endif


            {{-- BACK --}}
            <div class="d-flex gap-2">

                <a href="{{ route('orders.show', $order) }}"
                   class="btn btn-secondary">
                    ← Kembali ke Detail Pesanan
                </a>

                <a href="{{ url('/') }}"
                   class="btn btn-secondary">
                    Kembali Belanja
                </a>

            </div>

        </div>
    </div>

</div>

@endsection