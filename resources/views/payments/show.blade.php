@extends('layouts.app')

@section('title', 'Pembayaran - Anireshop')

@section('content')

<div class="ani-payment-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-payment-header">

            <div>
                <span class="ani-payment-eyebrow">
                    PAYMENT
                </span>

                <h1>
                    Pembayaran Pesanan
                </h1>

                <p>
                    {{ $order->order_number }}
                </p>
            </div>

            <a
                href="{{ route('orders.show', $order) }}"
                class="ani-payment-back"
            >
                ← Detail Pesanan
            </a>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))

            <div class="ani-payment-alert success">
                <span>✓</span>
                <div>{{ session('success') }}</div>
            </div>

        @endif


        @if(session('error'))

            <div class="ani-payment-alert error">
                <span>!</span>
                <div>{{ session('error') }}</div>
            </div>

        @endif


        <div class="row g-4 align-items-start">

            {{-- LEFT --}}
            <div class="col-lg-7">


                {{-- ORDER SUMMARY --}}
                <div class="ani-payment-card">

                    <div class="ani-payment-section-heading">

                        <div class="ani-payment-number">
                            01
                        </div>

                        <div>
                            <span>ORDER</span>
                            <h2>Ringkasan Pesanan</h2>
                        </div>

                    </div>


                    <div class="ani-payment-products">

                        @foreach($order->orderItems as $item)

                            <div class="ani-payment-product">

                                <div class="ani-payment-product-icon">
                                    🛍
                                </div>

                                <div class="ani-payment-product-info">

                                    <strong>
                                        {{ $item->product_name }}
                                    </strong>

                                    <span>
                                        {{ $item->quantity }} ×
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>

                                    @if($item->variation_note)

                                        <small>
                                            Pilihan: {{ $item->variation_note }}
                                        </small>

                                    @endif

                                </div>

                                <strong class="ani-payment-product-total">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </strong>

                            </div>

                        @endforeach

                    </div>


                    <div class="ani-payment-divider"></div>


                    <div class="ani-payment-total-line">

                        <span>
                            Ongkir
                        </span>

                        <strong>
                            Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="ani-payment-grand-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>



                {{-- PAYMENT METHOD --}}
                <div class="ani-payment-card">

                    <div class="ani-payment-section-heading">

                        <div class="ani-payment-number">
                            02
                        </div>

                        <div>
                            <span>PAYMENT METHOD</span>
                            <h2>Instruksi Pembayaran</h2>
                        </div>

                    </div>


                    {{-- QRIS --}}
                    @if($order->payment_method === 'QRIS')

                        <div class="ani-payment-method-box qris">

                            <div class="ani-payment-method-icon">
                                QR
                            </div>

                            <div class="ani-payment-method-title">
                                <strong>
                                    QRIS
                                </strong>

                                <span>
                                    Scan QR berikut untuk melakukan pembayaran.
                                </span>
                            </div>


                            <div class="ani-qris-wrapper">

                                <div class="ani-qris-label">
                                    TOTAL PEMBAYARAN
                                </div>

                                <div class="ani-qris-total">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </div>


                                <div class="ani-qris-image">

                                    <img
                                        src="{{ asset('images/qris-anireshop.jpeg') }}"
                                        alt="QRIS Anireshop"
                                    >

                                </div>

                                <p>
                                    Gunakan aplikasi mobile banking atau e-wallet
                                    yang mendukung QRIS.
                                </p>

                            </div>

                        </div>


                    {{-- BANK TRANSFER --}}
                    @elseif($order->payment_method === 'BANK_TRANSFER')

                        <div class="ani-payment-method-box">

                            <div class="ani-payment-method-icon bank">
                                BRI
                            </div>

                            <div class="ani-payment-method-title">
                                <strong>
                                    Bank Transfer
                                </strong>

                                <span>
                                    Transfer sesuai total pembayaran berikut.
                                </span>
                            </div>


                            <div class="ani-bank-detail">

                                <div class="ani-bank-row">

                                    <span>
                                        Bank
                                    </span>

                                    <strong>
                                        {{ config('payment.bank.name') }}
                                    </strong>

                                </div>


                                <div class="ani-bank-row">

                                    <span>
                                        Nomor Rekening
                                    </span>

                                    <strong class="ani-account-number">
                                        {{ config('payment.bank.account_number') }}
                                    </strong>

                                </div>


                                <div class="ani-bank-row">

                                    <span>
                                        Atas Nama
                                    </span>

                                    <strong>
                                        {{ config('payment.bank.account_name') }}
                                    </strong>

                                </div>


                                <div class="ani-transfer-total">

                                    <span>
                                        Jumlah Transfer
                                    </span>

                                    <strong>
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>



                {{-- CHANGE PAYMENT METHOD --}}
                @if (in_array($order->payment_status, ['PENDING', 'REJECTED']))

                    <div class="ani-payment-card">

                        <div class="ani-payment-section-heading">

                            <div class="ani-payment-number">
                                03
                            </div>

                            <div>
                                <span>PAYMENT OPTION</span>
                                <h2>Ubah Metode Pembayaran</h2>
                            </div>

                        </div>


                        <p class="ani-payment-description">
                            Ingin menggunakan metode pembayaran lain?
                            Pilih metode yang tersedia di bawah.
                        </p>


                        <form
                            action="{{ route('payments.method.update', $order) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PUT')

                            <div class="ani-method-select">

                                <select
                                    name="payment_method"
                                    required
                                >

                                    <option
                                        value="QRIS"
                                        {{ $order->payment_method === 'QRIS' ? 'selected' : '' }}
                                    >
                                        📱 QRIS
                                    </option>

                                    <option
                                        value="BANK_TRANSFER"
                                        {{ $order->payment_method === 'BANK_TRANSFER' ? 'selected' : '' }}
                                    >
                                        🏦 Bank Transfer - BRI
                                    </option>

                                </select>

                            </div>


                            <button
                                type="submit"
                                class="ani-payment-outline-btn"
                            >
                                Ubah Metode Pembayaran
                            </button>

                        </form>

                    </div>

                @endif



                {{-- UPLOAD --}}
                @if($order->payment_status === 'PENDING')

                    <div class="ani-payment-card">

                        <div class="ani-payment-section-heading">

                            <div class="ani-payment-number">
                                04
                            </div>

                            <div>
                                <span>PAYMENT PROOF</span>
                                <h2>Upload Bukti Pembayaran</h2>
                            </div>

                        </div>


                        <p class="ani-payment-description">
                            Upload screenshot atau foto bukti pembayaran.
                            Format JPG, JPEG, atau PNG dengan ukuran maksimal 2 MB.
                        </p>


                        <form
                            action="{{ route('payments.store', $order) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf

                            <label
                                for="payment_proof"
                                class="ani-upload-area"
                            >

                                <div class="ani-upload-icon">
                                    📤
                                </div>

                                <strong>
                                    Pilih Bukti Pembayaran
                                </strong>

                                <span>
                                    JPG, JPEG, PNG · Maks. 2 MB
                                </span>

                                <input
                                    type="file"
                                    name="payment_proof"
                                    id="payment_proof"
                                    accept=".jpg,.jpeg,.png"
                                    required
                                >

                            </label>


                            <div
                                id="ani-file-name"
                                class="ani-file-name"
                            ></div>


                            @error('payment_proof')

                                <div class="ani-payment-field-error">
                                    {{ $message }}
                                </div>

                            @enderror


                            <button
                                type="submit"
                                class="ani-payment-submit-btn"
                            >
                                <span>📤</span>
                                Kirim Bukti Pembayaran
                                <b>→</b>
                            </button>

                        </form>

                    </div>


                {{-- WAITING --}}
                @elseif($order->payment_status === 'WAITING_VERIFICATION')

                    <div class="ani-payment-status-card waiting">

                        <div class="ani-payment-status-icon">
                            ⏳
                        </div>

                        <h2>
                            Menunggu Verifikasi Admin
                        </h2>

                        <p>
                            Bukti pembayaran sudah dikirim.
                            Silakan tunggu admin melakukan verifikasi.
                        </p>

                        @if($order->payment_submitted_at)

                            <span>
                                Dikirim:
                                {{ $order->payment_submitted_at->format('d M Y H:i') }}
                            </span>

                        @endif

                    </div>


                {{-- PAID --}}
                @elseif($order->payment_status === 'PAID')

                    <div class="ani-payment-status-card paid">

                        <div class="ani-payment-status-icon">
                            ✓
                        </div>

                        <h2>
                            Pembayaran Terverifikasi
                        </h2>

                        <p>
                            Pembayaran telah disetujui oleh admin.
                            Pesanan akan diproses selanjutnya.
                        </p>

                    </div>


                {{-- REJECTED --}}
                @elseif($order->payment_status === 'REJECTED')

                    <div class="ani-payment-card">

                        <div class="ani-payment-rejected">

                            <div class="ani-payment-status-icon">
                                !
                            </div>

                            <h2>
                                Pembayaran Ditolak
                            </h2>

                            <p>
                                Bukti pembayaran sebelumnya ditolak oleh admin.
                                Silakan upload kembali bukti pembayaran yang benar.
                            </p>

                        </div>


                        <form
                            action="{{ route('payments.store', $order) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf

                            <label
                                for="payment_proof"
                                class="ani-upload-area"
                            >

                                <div class="ani-upload-icon">
                                    🔄
                                </div>

                                <strong>
                                    Upload Bukti Pembayaran Baru
                                </strong>

                                <span>
                                    JPG, JPEG, PNG · Maks. 2 MB
                                </span>

                                <input
                                    type="file"
                                    name="payment_proof"
                                    id="payment_proof"
                                    accept=".jpg,.jpeg,.png"
                                    required
                                >

                            </label>


                            <div
                                id="ani-file-name"
                                class="ani-file-name"
                            ></div>


                            @error('payment_proof')

                                <div class="ani-payment-field-error">
                                    {{ $message }}
                                </div>

                            @enderror


                            <button
                                type="submit"
                                class="ani-payment-submit-btn rejected"
                            >
                                <span>🔄</span>
                                Upload Ulang Bukti
                                <b>→</b>
                            </button>

                        </form>

                    </div>

                @endif


                {{-- FOOTER ACTIONS --}}
                <div class="ani-payment-footer-actions">

                    <a
                        href="{{ route('orders.show', $order) }}"
                        class="ani-payment-secondary-btn"
                    >
                        ← Detail Pesanan
                    </a>

                    <a
                        href="{{ route('products.index') }}"
                        class="ani-payment-secondary-btn"
                    >
                        Kembali Belanja
                    </a>

                </div>

            </div>



            {{-- RIGHT --}}
            <div class="col-lg-5">

                <div class="ani-payment-side">

                    <span class="ani-payment-side-label">
                        PAYMENT STATUS
                    </span>

                    <h2>
                        {{ $order->payment_status }}
                    </h2>


                    {{-- DEADLINE --}}
                    @if($order->payment_status !== 'PAID' && $order->expires_at)

                        <div class="ani-payment-deadline">

                            <span>
                                ⏱ Batas Pembayaran
                            </span>

                            <strong>
                                {{ $order->expires_at->format('d M Y H:i') }}
                            </strong>

                        </div>

                    @endif


                    <div class="ani-payment-side-divider"></div>


                    <div class="ani-payment-side-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="ani-payment-side-info">

                        <div>
                            <span>Metode</span>
                            <strong>
                                {{ $order->payment_method }}
                            </strong>
                        </div>

                        <div>
                            <span>Kurir</span>
                            <strong>
                                {{ $order->courier ?? '-' }}
                            </strong>
                        </div>

                    </div>


                    <div class="ani-payment-side-note">
                        🔒 Jangan membagikan bukti pembayaran kepada pihak yang tidak berkepentingan.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

    const paymentFile =
        document.getElementById('payment_proof');

    const fileName =
        document.getElementById('ani-file-name');

    if (paymentFile && fileName) {

        paymentFile.addEventListener('change', function () {

            if (this.files.length > 0) {

                fileName.textContent =
                    'File dipilih: ' + this.files[0].name;

            } else {

                fileName.textContent = '';

            }

        });

    }

</script>

@endpush