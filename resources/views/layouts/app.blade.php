<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Anireshop')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/anireshop.css') }}"
    >

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

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('home') }}"
                        >
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('cart.index') }}"
                        >
                            Cart
                        </a>
                    </li>

                    @auth

                        
                        <li class="nav-item">
                            <span class="nav-link">
                                Hi, {{ auth()->user()->name }}
                            </span>
                        </li>

                        @if(auth()->user()->role === 'admin')

                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('admin.dashboard') }}"
                                >
                                    Admin
                                </a>
                            </li>

                        @endif

                        <li class="nav-item ms-lg-2">

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-ani-pink"
                                >
                                    Logout
                                </button>

                            </form>

                        </li>

                    @else

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('login') }}"
                            >
                                Login
                            </a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a
                                href="{{ route('register') }}"
                                class="btn btn-sm btn-ani"
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

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <h5>Anireshop</h5>

                    <p>
                        Merchandise Anime, K-Pop & Cute Accessories.
                    </p>

                </div>

                <div class="col-md-6">

                    <h5>Quick Links</h5>

                    <a href="{{ route('home') }}" class="d-block">
                        Home
                    </a>

                    <a href="{{ route('cart.index') }}" class="d-block">
                        Cart
                    </a>

                </div>

            </div>

            <hr>

            <div class="text-center small">
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