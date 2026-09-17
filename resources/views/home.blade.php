@extends('layouts.app')

@section('title', 'Anireshop - Anime & K-Pop Merchandise')

@section('content')

{{-- HERO --}}
<section class="container ani-hero-wrapper">

    <div class="ani-hero">

        {{-- BACKGROUND IMAGE --}}
        <div class="hero-bg">
            <img
                src="{{ asset('images/hero-anime.png') }}"
                alt="Anireshop"
            >
        </div>

        {{-- OVERLAY --}}
        <div class="hero-overlay"></div>

        {{-- HERO CONTENT --}}
        <div class="ani-hero-content">

            <div class="hero-content-inner">

                <div class="hero-label">
                    <span></span>
                    WELCOME TO ANIRESHOP
                </div>

                <h1 class="ani-hero-title">

                    Temukan Merchandise

                    <span>
                        Anime & K-Pop
                    </span>

                    Favoritmu

                </h1>

                <p class="ani-hero-description">
                    Koleksi merchandise anime, K-Pop,
                    dan cute accessories untuk kamu.
                </p>

                <a
                    href="#products"
                    class="hero-button"
                >
                    🛒 &nbsp; Belanja Sekarang
                    <span>→</span>
                </a>


                {{-- BENEFITS --}}
                <div class="hero-benefits">

                    <div class="hero-benefit">

                        <div class="benefit-icon">
                            ◈
                        </div>

                        <div>
                            <strong>Produk Original</strong>

                            <small>
                                Kualitas terbaik
                            </small>
                        </div>

                    </div>


                    <div class="hero-divider"></div>


                    <div class="hero-benefit">

                        <div class="benefit-icon">
                            ♧
                        </div>

                        <div>
                            <strong>Pengiriman Aman</strong>

                            <small>
                                Sampai tujuan
                            </small>
                        </div>

                    </div>


                    <div class="hero-divider"></div>


                    <div class="hero-benefit">

                        <div class="benefit-icon">
                            ♡
                        </div>

                        <div>
                            <strong>Untuk Semua Fans</strong>

                            <small>
                                Anime & K-Pop
                            </small>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

{{-- CATEGORY --}}
<section class="container ani-section">

    <h2 class="ani-section-title">
        Kategori
    </h2>

    <p class="ani-section-subtitle mb-4">
        Temukan merchandise berdasarkan kategori favoritmu.
    </p>

    <div class="row g-3">

        @foreach ($categories as $category)

            <div class="col-6 col-md-4 col-lg-3">

                <div class="category-card">

                    <h5 class="mb-0">
                        {{ $category->name }}
                    </h5>

                </div>

            </div>

        @endforeach

    </div>

</section>


{{-- PRODUCTS --}}
<section class="container ani-section" id="products">

    <h2 class="ani-section-title">
        Produk <span>Terbaru</span>
    </h2>

    <p class="ani-section-subtitle mb-4">
        Koleksi terbaru Anireshop untuk melengkapi koleksimu.
    </p>

    <div class="row g-4">

        @forelse ($products as $product)

            <div class="col-6 col-md-4 col-lg-3">

                <a
                    href="{{ route('products.show', $product->slug) }}"
                    class="product-link"
                >

                    <div class="product-card">

                    @if ($product->images->count())
                        <div
                            id="productCarousel{{ $product->id }}"
                            class="carousel slide product-image"
                            data-bs-ride="carousel"
                            data-bs-interval="3000"
                        >

                            <div class="carousel-inner h-100">

                                @foreach ($product->images as $image)

                                    <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">

                                    <img
                                        src="{{ asset('storage/' . $image->image_path) }}"
                                        class="d-block w-100 h-100"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                        decoding="async"
                                    >

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        @else

                        <div class="product-image d-flex align-items-center justify-content-center">
                            <span class="text-muted">
                                No Image
                            </span>
                        </div>

                        @endif

                        <div class="product-body">

                            <h5 class="product-name">
                                {{ $product->name }}
                            </h5>

                            <p class="product-category mb-2">
                                {{ $product->category->name }}
                            </p>

                            <div class="price">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-12">

                <p class="text-muted">
                    Belum ada produk.
                </p>

            </div>

        @endforelse

    </div>

</section>


{{-- ABOUT --}}
<section class="container ani-section">

    <div class="row">

        <div class="col-lg-8">

            <h2 class="ani-section-title">
                Tentang <span>Anireshop</span>
            </h2>

            <p class="about-text">
                Anireshop adalah toko merchandise yang menyediakan
                berbagai koleksi anime, K-Pop, dan accessories
                untuk para penggemar.
            </p>

        </div>

    </div>

</section>

@endsection