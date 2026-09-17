<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $product->name }} - Anireshop</title>

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

        .nav-link {
            color: #ffffff !important;
        }

        .product-main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 18px;
            background: #1c1c24;
        }

        .product-info {
            padding: 20px;
        }

        .product-price {
            color: #ff4fd8;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stock {
            color: #8be28b;
        }

        .description {
            color: #b5b5bd;
            line-height: 1.8;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            border-color: #ff4fd8;
        }

        footer {
            background: #111116;
            margin-top: 80px;
            padding: 40px 0;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a
            class="navbar-brand"
            href="{{ route('home') }}"
        >
            Anireshop
        </a>

        <div class="ms-auto">

            @auth

                <span class="text-light me-3">
                    Hi, {{ auth()->user()->name }}
                </span>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="d-inline"
                >
                    @csrf

                    <button
                        class="btn btn-sm btn-outline-light"
                    >
                        Logout
                    </button>

                </form>

            @else

                <a
                    href="{{ route('login') }}"
                    class="btn btn-sm btn-outline-light"
                >
                    Login
                </a>

            @endauth

        </div>

    </div>

</nav>


<div class="container py-5">

    {{-- BACK TO HOME --}}
    <div class="mb-4">

        <a
            href="{{ route('home') }}"
            class="text-decoration-none text-light"
        >
            ← Kembali ke Home
        </a>

    </div>


    <div class="row g-5">

        {{-- IMAGE --}}
        <div class="col-lg-6">

            @if ($product->images->first())

                <img
                    id="mainImage"
                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                    alt="{{ $product->name }}"
                    class="product-main-image"
                >

                <div class="d-flex gap-2 mt-3 flex-wrap">

                    @foreach ($product->images as $image)

                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            class="thumbnail"
                            onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')"
                            alt="{{ $product->name }}"
                        >

                    @endforeach

                </div>

            @else

                <div
                    class="product-main-image d-flex align-items-center justify-content-center"
                >

                    <span class="text-secondary">
                        No Image Available
                    </span>

                </div>

            @endif

        </div>


        {{-- INFORMATION --}}
        <div class="col-lg-6">

            <div class="product-info">

                {{-- CATEGORY --}}
                <span class="badge text-bg-secondary mb-3">
                    {{ $product->category->name }}
                </span>


                {{-- PRODUCT NAME --}}
                <h1 class="fw-bold">
                    {{ $product->name }}
                </h1>


                {{-- PRICE --}}
                <div class="product-price my-3">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>


                {{-- STOCK --}}
                <p class="stock">
                    Stok tersedia:
                    {{ $product->available_stock }}
                </p>

                <hr>


                {{-- DESCRIPTION --}}
                <h5>
                    Deskripsi
                </h5>

                <p class="description">
                    {{ $product->description ?? 'Tidak ada deskripsi produk.' }}
                </p>


                {{-- ADD TO CART FORM --}}
                <form
                    method="POST"
                    action="{{ route('cart.add', $product) }}"
                >

                    @csrf


                    {{-- VARIATION --}}
                    <div class="mt-4">

                        <label class="form-label">
                            Variasi / Catatan Produk
                        </label>

                        <textarea
                            name="variation_note"
                            class="form-control bg-dark text-light border-secondary"
                            rows="3"
                            maxlength="500"
                            placeholder="Contoh: Pilih karakter Levi / warna hitam"
                        ></textarea>

                        <small class="text-secondary">
                            Maksimal 500 karakter.
                        </small>

                    </div>


                    {{-- QUANTITY --}}
                    <div class="mt-4">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="form-control bg-dark text-light border-secondary"
                            value="1"
                            min="1"
                            max="{{ $product->available_stock }}"
                            required
                        >

                    </div>


                    {{-- ADD TO CART --}}
                    <button
                        type="submit"
                        class="btn btn-light btn-lg w-100 mt-4"
                        {{ $product->available_stock <= 0 ? 'disabled' : '' }}
                    >
                        Tambah ke Keranjang
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


<footer>

    <div class="container text-center">

        <h4>
            Anireshop
        </h4>

        <p class="text-secondary mb-0">
            Anime • K-Pop • Cute Accessories
        </p>

    </div>

</footer>


<script>

function changeImage(image) {

    document.getElementById('mainImage').src = image;

}

</script>

</body>

</html>