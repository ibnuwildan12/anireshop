@extends('layouts.app')

@section('title', $product->name . ' - Anireshop')

@section('content')

<div class="ani-product-detail">

    <div class="container py-5">

        {{-- BREADCRUMB --}}
        <div class="product-breadcrumb mb-4">

            <a href="{{ route('home') }}">
                Home
            </a>

            <span>/</span>

            <a href="{{ route('products.index') }}">
                Produk
            </a>

            <span>/</span>

            <span>
                {{ $product->name }}
            </span>

        </div>


        <div class="row g-4 g-lg-5">


            {{-- =====================================================
                 PRODUCT IMAGE
            ====================================================== --}}

            <div class="col-lg-6">

                <div class="product-gallery">

                    @if($product->images->count())

                        {{-- MAIN IMAGE --}}

                        <div class="product-main-image">

                            <img
                                id="mainImage"
                                src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->name }}"
                            >

                        </div>


                        {{-- THUMBNAILS --}}

                        @if($product->images->count() > 1)

                            <div class="product-thumbnails">

                                @foreach($product->images as $image)

                                    <button
                                        type="button"
                                        class="product-thumbnail {{ $loop->first ? 'active' : '' }}"
                                        onclick="changeImage(
                                            '{{ asset('images/' . $image->image_path) }}',
                                            this
                                        )"
                                    >

                                        <img
                                            src="{{ asset('images/' . $image->image_path) }}"
                                            alt="{{ $product->name }}"
                                        >

                                    </button>

                                @endforeach

                            </div>

                        @endif

                    @else

                        <div class="product-main-image no-image">

                            <span>
                                No Image Available
                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 PRODUCT INFORMATION
            ====================================================== --}}

            <div class="col-lg-6">

                <div class="product-detail-info">


                    {{-- CATEGORY --}}

                    <a
                        href="{{ route('products.index', [
                            'category' => $product->category->slug
                        ]) }}"
                        class="product-detail-category"
                    >
                        {{ $product->category->name }}
                    </a>


                    {{-- NAME --}}

                    <h1 class="product-detail-title">
                        {{ $product->name }}
                    </h1>


                    {{-- PRICE --}}

                    <div class="product-detail-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>


                    {{-- STOCK --}}

                    @if($product->available_stock > 5)

                        <div class="product-stock available">
                            <span></span>
                            Stok tersedia: {{ $product->available_stock }}
                        </div>

                    @elseif($product->available_stock > 0)

                        <div class="product-stock low">
                            <span></span>
                            Stok terbatas: {{ $product->available_stock }}
                        </div>

                    @else

                        <div class="product-stock sold">
                            <span></span>
                            Produk sedang habis
                        </div>

                    @endif


                    <div class="product-detail-divider"></div>


                    {{-- DESCRIPTION --}}

                    <div class="product-description-section">

                        <h5>
                            Deskripsi Produk
                        </h5>

                        <p>
                            {{ $product->description ?? 'Tidak ada deskripsi produk.' }}
                        </p>

                    </div>


                    {{-- ADD TO CART --}}

                    @if($product->available_stock > 0)

                        <form
                            method="POST"
                            action="{{ route('cart.add', $product) }}"
                            class="product-cart-form"
                        >

                            @csrf


                            {{-- VARIATION --}}

                            <div class="product-form-group">

                                <label for="variation_note">
                                    Variasi / Catatan Produk
                                </label>

                                <textarea
                                    id="variation_note"
                                    name="variation_note"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Contoh: Pilih karakter Levi / warna hitam"
                                ></textarea>

                                <small>
                                    Maksimal 500 karakter.
                                </small>

                            </div>


                            {{-- QUANTITY --}}

                            <div class="product-form-group">

                                <label for="quantity">
                                    Jumlah
                                </label>

                                <div class="quantity-wrapper">

                                    <button
                                        type="button"
                                        onclick="decreaseQuantity()"
                                    >
                                        −
                                    </button>

                                    <input
                                        id="quantity"
                                        type="number"
                                        name="quantity"
                                        value="1"
                                        min="1"
                                        max="{{ $product->available_stock }}"
                                        required
                                    >

                                    <button
                                        type="button"
                                        onclick="increaseQuantity()"
                                    >
                                        +
                                    </button>

                                </div>

                            </div>


                            {{-- ADD CART BUTTON --}}

                            <button
                                type="submit"
                                class="product-add-cart"
                            >
                                <span>🛒</span>
                                Tambah ke Keranjang
                            </button>

                        </form>

                    @else

                        <button
                            type="button"
                            class="product-add-cart disabled"
                            disabled
                        >
                            Stok Habis
                        </button>

                    @endif


                    {{-- BACK TO PRODUCTS --}}

                    <a
                        href="{{ route('products.index') }}"
                        class="product-back-link"
                    >
                        ← Kembali ke Produk
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('css/anireshop-product-v2.css') }}"
>

@endpush


@push('scripts')

<script>

function changeImage(image, button) {

    const mainImage = document.getElementById('mainImage');

    if (mainImage) {
        mainImage.src = image;
    }

    document
        .querySelectorAll('.product-thumbnail')
        .forEach(function (item) {
            item.classList.remove('active');
        });

    button.classList.add('active');
}


function decreaseQuantity() {

    const input = document.getElementById('quantity');

    if (!input) return;

    const current = parseInt(input.value) || 1;

    if (current > 1) {
        input.value = current - 1;
    }
}


function increaseQuantity() {

    const input = document.getElementById('quantity');

    if (!input) return;

    const current = parseInt(input.value) || 1;
    const maximum = parseInt(input.max);

    if (current < maximum) {
        input.value = current + 1;
    }
}

</script>

@endpush