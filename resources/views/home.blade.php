<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anireshop - Anime & K-Pop Merchandise</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #0f0f13;
            color: #ffffff;
        }

        .navbar {
            background: #111116;
        }

        .navbar-brand {
            font-weight: 700;
            color: #ff4fd8 !important;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .hero {
            padding: 100px 0;
            background: linear-gradient(135deg, #171020, #24102f);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
        }

        .hero span {
            color: #ff4fd8;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .category-card {
            background: #18181f;
            border: 1px solid #292936;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: 0.3s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            border-color: #ff4fd8;
        }

        .product-card {
            background: #18181f;
            border: 1px solid #292936;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #252530;
        }

        .product-body {
            padding: 18px;
        }

        .price {
            color: #ff4fd8;
            font-weight: 700;
            font-size: 1.1rem;
        }

        footer {
            background: #111116;
            margin-top: 80px;
            padding: 40px 0;
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            Anireshop
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                @auth

                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                Admin
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <span class="nav-link">
                            Hi, {{ auth()->user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-light ms-lg-2"
                            >
                                Logout
                            </button>
                        </form>
                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('register') }}"
                            class="btn btn-sm btn-light ms-lg-2"
                        >
                            Register
                        </a>
                    </li>

                @endauth

            </ul>

        </div>
    </div>
</nav>


{{-- FLASH MESSAGE --}}
@if (session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif


{{-- HERO --}}
<section class="hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <p class="text-uppercase fw-bold">
                    Welcome to Anireshop
                </p>

                <h1>
                    Temukan Merchandise
                    <span>Anime & K-Pop</span>
                    Favoritmu
                </h1>

                <p class="lead text-light opacity-75 mt-3">
                    Koleksi merchandise anime, K-Pop,
                    dan cute accessories untuk kamu.
                </p>

                <a href="#products" class="btn btn-light btn-lg mt-3">
                    Belanja Sekarang
                </a>

            </div>

        </div>

    </div>
</section>


{{-- CATEGORY --}}
<section class="container py-5">

    <h2 class="section-title">
        Kategori
    </h2>

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
<section class="container py-5" id="products">

    <h2 class="section-title">
        Produk Terbaru
    </h2>

    <div class="row g-4">

        @forelse ($products as $product)

            <div class="col-6 col-md-4 col-lg-3">

            <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-light"
>               <div class="product-card">

                    @if ($product->images->first())

                        <img
                            src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                            class="product-image"
                            alt="{{ $product->name }}"
                        >

                    @else

                        <div
                            class="product-image d-flex align-items-center justify-content-center"
                        >
                            <span class="text-muted">
                                No Image
                            </span>
                        </div>

                    @endif

                    <div class="product-body">

                        <h5>
                            {{ $product->name }}
                        </h5>

                        <p class="text-secondary mb-2">
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

            <p>
                Belum ada produk.
            </p>

        @endforelse

    </div>

</section>


{{-- ABOUT --}}
<section class="container py-5">

    <div class="row">

        <div class="col-lg-8">

            <h2 class="section-title">
                Tentang Anireshop
            </h2>

            <p class="text-secondary">
                Anireshop adalah toko merchandise yang menyediakan
                berbagai koleksi anime, K-Pop, dan accessories
                untuk para penggemar.
            </p>

        </div>

    </div>

</section>


{{-- FOOTER --}}
<footer>

    <div class="container text-center">

        <h4>Anireshop</h4>

        <p class="text-secondary mb-0">
            Anime • K-Pop • Cute Accessories
        </p>

        <p class="text-secondary mt-3 mb-0">
            &copy; {{ date('Y') }} Anireshop.
            All rights reserved.
        </p>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>