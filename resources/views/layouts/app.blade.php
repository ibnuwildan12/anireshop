<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Anireshop')
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/anireshop.css') }}" >

    <link rel="stylesheet" href="{{ asset('css/anireshop-navbar-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-catalog-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-product-v2.css') }}" >

    <link rel="stylesheet" href="{{ asset('css/anireshop-home-search.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-cart-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-checkout-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-order-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-payment-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-global-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-products-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-product-form-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-categories-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-orders-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-order-detail-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-shipping-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-payments-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-admin-payment-detail-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-auth-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-wishlist-v2.css') }}">

    <link rel="stylesheet" href="{{ asset('css/anireshop-review-v2.css') }}">

    @stack('styles')

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg ani-navbar">

        <div class="container">

            <a
                class="navbar-brand ani-brand"
                href="{{ route('home') }}"
            >
                Ani<span>re</span>shop
            </a>

            

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#aniNavbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="aniNavbar"
            >


                <ul class="navbar-nav ms-auto align-items-lg-center">

                    {{-- SEARCH --}}
                    <li class="nav-item ani-search-item">

                        <form
                            action="{{ route('products.index') }}"
                            method="GET"
                            class="ani-navbar-search"
                        >

                            <span class="ani-search-icon">
                                🔎
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari merchandise..."
                                autocomplete="off"
                            >

                            <button
                                type="submit"
                                class="ani-search-button"
                                title="Cari produk"
                            >
                                🔍
                            </button>

                        </form>

                    </li>
                    {{-- HOME --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    @guest

                        {{-- GUEST --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                Cart
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a href="{{ route('register') }}" class="btn btn-sm btn-ani">
                                Register
                            </a>
                        </li>

                    @else

                        {{-- CUSTOMER --}}
                        @if(auth()->user()->role !== 'admin')

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    Cart
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wishlist.index') }}">
                                    Wishlist
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    My Orders
                                </a>
                            </li>

                        @endif

                        {{-- NAMA USER --}}
                        <li class="nav-item">
                            <span class="nav-link">
                                Hi, {{ auth()->user()->name }}
                            </span>
                        </li>

                        {{-- ADMIN --}}
                        @if(auth()->user()->role === 'admin')

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    Admin
                                </a>
                            </li>

                        @endif

                        {{-- LOGOUT --}}
                        <li class="nav-item ms-lg-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-sm btn-ani-pink">
                                    Logout
                                </button>
                            </form>
                        </li>

                    @endguest

                </ul>

            </div>

        </div>

    </nav>


    {{-- FLASH MESSAGE --}}

    <div class="container mt-3">

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

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

    </div>


    {{-- CONTENT --}}

    <main>

        @yield('content')

    </main>


    {{-- FOOTER --}}

    <footer class="ani-footer">

    <div class="container text-center">

        <div class="ani-footer-brand">

            <h5>
                Anireshop
            </h5>

            <p>
                Merchandise Anime, K-Pop & Cute Accessories.
            </p>

        </div>


        <div class="ani-footer-links">

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('cart.index') }}">
                Cart
            </a>

            <a href="{{ route('products.index') }}">
                Produk
            </a>

        </div>


        <div class="ani-footer-divider"></div>


        <div class="ani-footer-copyright">
            © {{ date('Y') }} Anireshop. All rights reserved.
        </div>

    </div>

</footer>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')

</body>

</html>