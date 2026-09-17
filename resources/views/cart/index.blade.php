<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Keranjang - Anireshop</title>

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
            color: #ff4fd8 !important;
            font-weight: 700;
        }

        .cart-card {
            background: #18181f;
            border: 1px solid #292936;
            border-radius: 15px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            background: #252530;
        }

        .price {
            color: #ff4fd8;
            font-weight: 700;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">

        <a
            href="{{ route('home') }}"
            class="navbar-brand"
        >
            Anireshop
        </a>

        <a
            href="{{ route('home') }}"
            class="btn btn-outline-light btn-sm"
        >
            ← Belanja Lagi
        </a>

    </div>
</nav>


<div class="container py-5">

    <h1 class="mb-4">
        Keranjang Saya 🛒
    </h1>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>
    @endif


    @if ($products->isEmpty())

        <div class="text-center py-5">

            <h3>
                Keranjang masih kosong
            </h3>

            <p class="text-secondary">
                Yuk cari merchandise favoritmu.
            </p>

            <a
                href="{{ route('home') }}"
                class="btn btn-light"
            >
                Mulai Belanja
            </a>

        </div>

    @else

        <div class="row g-4">

            <div class="col-lg-8">

                @foreach ($products as $product)

                    @php
                        $quantity = $cart[$product->id]['quantity'];
                        $variation = $cart[$product->id]['variation_note'] ?? null;
                        $subtotal = $product->price * $quantity;
                    @endphp

                    <div class="cart-card p-3 mb-3">

                        <div class="row align-items-center g-3">

                            <div class="col-auto">

                                @if ($product->images->first())

                                    <img
                                        src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                        class="product-image"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <div
                                        class="product-image d-flex align-items-center justify-content-center"
                                    >
                                        <span class="text-secondary">
                                            No Image
                                        </span>
                                    </div>

                                @endif

                            </div>


                            <div class="col">

                                <h5>
                                    {{ $product->name }}
                                </h5>

                                <p class="text-secondary mb-1">
                                    {{ $product->category->name }}
                                </p>

                                @if ($variation)

                                    <small class="text-secondary">
                                        Catatan:
                                        {{ $variation }}
                                    </small>

                                @endif

                                <p class="price mb-0 mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                            </div>


                            <div class="col-md-3">

                                <form
                                    method="POST"
                                    action="{{ route('cart.update', $product) }}"
                                >
                                    @csrf
                                    @method('PUT')

                                    <label class="form-label">
                                        Qty
                                    </label>

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $quantity }}"
                                        min="1"
                                        max="{{ $product->available_stock }}"
                                        class="form-control mb-2"
                                    >

                                    <input
                                        type="hidden"
                                        name="variation_note"
                                        value="{{ $variation }}"
                                    >

                                    <button
                                        class="btn btn-sm btn-outline-light w-100"
                                    >
                                        Update
                                    </button>

                                </form>

                            </div>


                            <div class="col-auto">

                                <form
                                    method="POST"
                                    action="{{ route('cart.remove', $product) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                        <div class="text-end mt-3">

                            <strong>
                                Subtotal:
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </strong>

                        </div>

                    </div>

                @endforeach

            </div>


            <div class="col-lg-4">

                <div class="cart-card p-4">

                    <h4>
                        Ringkasan
                    </h4>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </strong>

                    </div>

                    <p class="text-secondary mt-2">
                        Ongkir dihitung saat checkout.
                    </p>

                    @auth

                        <a
                            href="{{ route('checkout.index') }}"
                            class="btn btn-light w-100 mt-3"
                        >
                            Lanjut Checkout
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-light w-100 mt-3"
                        >
                            Login untuk Checkout
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    @endif

</div>

</body>
</html>