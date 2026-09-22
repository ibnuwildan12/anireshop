@extends('layouts.app')

@section('title', 'Keranjang - Anireshop')

@section('content')

<div class="ani-cart-page">

    <div class="container py-5">

        {{-- Header --}}
        <div class="ani-cart-header">
            <div>
                <span class="ani-cart-eyebrow">YOUR SHOPPING CART</span>
                <h1>Keranjang Saya <span>🛒</span></h1>
                <p>Periksa kembali merchandise pilihanmu sebelum checkout.</p>
            </div>

            <a href="{{ route('products.index') }}" class="ani-cart-continue">
                ← Lanjut Belanja
            </a>
        </div>


        {{-- Flash Message --}}
        @if (session('success'))
            <div class="ani-cart-alert success">
                <span>✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif


        {{-- Validation Error --}}
        @if ($errors->any())
            <div class="ani-cart-alert error">
                <span>!</span>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif


        @if ($products->isEmpty())

            {{-- Empty Cart --}}
            <div class="ani-cart-empty">

                <div class="ani-cart-empty-icon">
                    🛒
                </div>

                <h2>Keranjang masih kosong</h2>

                <p>
                    Belum ada merchandise yang kamu pilih.
                    Yuk cari koleksi favoritmu!
                </p>

                <a href="{{ route('products.index') }}" class="ani-cart-primary-btn">
                    Mulai Belanja
                </a>

            </div>

        @else

            <div class="row g-4 align-items-start">

                {{-- PRODUCT LIST --}}
                <div class="col-lg-8">

                    <div class="ani-cart-list">

                        @foreach ($products as $product)

                            @php
                                $quantity = $cart[$product->id]['quantity'];
                                $variation = $cart[$product->id]['variation_note'] ?? null;
                                $subtotal = $product->price * $quantity;
                            @endphp

                            <div class="ani-cart-item">

                                {{-- Product Image --}}
                                <div class="ani-cart-image-wrap">

                                    @if ($product->images->first())

                                        <img
                                            src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                            class="ani-cart-image"
                                            alt="{{ $product->name }}"
                                        >

                                    @else

                                        <div class="ani-cart-no-image">
                                            No Image
                                        </div>

                                    @endif

                                </div>


                                {{-- Product Information --}}
                                <div class="ani-cart-product">

                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        class="ani-cart-product-name"
                                    >
                                        {{ $product->name }}
                                    </a>

                                    <div class="ani-cart-category">
                                        {{ $product->category->name }}
                                    </div>

                                    @if ($variation)

                                        <div class="ani-cart-variation">
                                            <span>Catatan:</span>
                                            {{ $variation }}
                                        </div>

                                    @endif

                                    <div class="ani-cart-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>

                                </div>


                                {{-- Quantity --}}
                                <div class="ani-cart-quantity">

                                    <span class="ani-cart-label">
                                        Jumlah
                                    </span>

                                    <form
                                        method="POST"
                                        action="{{ route('cart.update', $product) }}"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <div class="ani-quantity-control">

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $quantity }}"
                                                min="1"
                                                max="{{ $product->available_stock }}"
                                                aria-label="Jumlah {{ $product->name }}"
                                            >

                                        </div>

                                        <input
                                            type="hidden"
                                            name="variation_note"
                                            value="{{ $variation }}"
                                        >

                                        <button
                                            type="submit"
                                            class="ani-cart-update"
                                        >
                                            Update
                                        </button>

                                    </form>

                                </div>


                                {{-- Subtotal + Remove --}}
                                <div class="ani-cart-item-right">

                                    <div class="ani-cart-subtotal-label">
                                        Subtotal
                                    </div>

                                    <div class="ani-cart-subtotal">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>

                                    <form
                                        method="POST"
                                        action="{{ route('cart.remove', $product) }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="ani-cart-remove"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- ORDER SUMMARY --}}
                <div class="col-lg-4">

                    <div class="ani-cart-summary">

                        <div class="ani-summary-heading">
                            <span>ORDER SUMMARY</span>
                            <h2>Ringkasan Pesanan</h2>
                        </div>

                        <div class="ani-summary-line">
                            <span>Subtotal</span>

                            <strong>
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </strong>
                        </div>

                        <div class="ani-summary-line muted">
                            <span>Ongkir</span>

                            <span>
                                Dihitung saat checkout
                            </span>
                        </div>

                        <div class="ani-summary-divider"></div>

                        <div class="ani-summary-total">
                            <span>Total sementara</span>

                            <strong>
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </strong>
                        </div>


                        @auth

                            <a
                                href="{{ route('checkout.index') }}"
                                class="ani-checkout-btn"
                            >
                                Lanjut Checkout
                                <span>→</span>
                            </a>

                        @else

                            <a
                                href="{{ route('login') }}"
                                class="ani-checkout-btn"
                            >
                                Login untuk Checkout
                                <span>→</span>
                            </a>

                        @endauth


                        <div class="ani-summary-note">
                            🔒 Checkout aman dan stok akan diproses sesuai pesanan.
                        </div>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection