@extends('layouts.app')

@php
    $isWishlisted = auth()->check()
        && auth()->user()
            ->wishlists()
            ->where('product_id', $product->id)
            ->exists();
@endphp

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

                    <div class="product-action-area">

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


                            {{-- ACTION BUTTONS --}}

                            <div class="product-action-row">

                                <button
                                    type="submit"
                                    class="product-add-cart"
                                >
                                    <span>🛒</span>
                                    ADD TO CART
                                </button>

                            </div>

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
                            
                    {{-- ADD TO WISHLIST --}}

                    <div class="product-wishlist-wrapper">

                    @if(auth()->check())

                        @if($isWishlisted)

                            <form
                                action="{{ route('wishlist.destroy', $product) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="ani-product-wishlist active"
                                    title="Remove from wishlist"
                                >
                                    ♥
                                </button>
                            </form>

                        @else

                            <form
                                action="{{ route('wishlist.store', $product) }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="ani-product-wishlist"
                                    title="Add to wishlist"
                                >
                                    ♡
                                </button>
                            </form>

                        @endif

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="ani-product-wishlist"
                            title="Login to add wishlist"
                        >
                            ♡
                        </a>

                    @endif

                    </div>
                    </div>
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

{{-- Review & Rating --}}
<section class="product-reviews-section">
    <div class="container">

        <div class="product-reviews-header">
            <h2>Review & Rating</h2>
            <p>Bagikan pengalamanmu setelah membeli produk ini.</p>
        </div>

        @auth
            <div class="review-form-card">
                <h4>Tulis Review</h4>

                <form action="{{ route('reviews.store', $product) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="rating" class="form-label">
                            Rating
                        </label>

                        <select
                            name="rating"
                            id="rating"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih rating</option>
                            <option value="5">★★★★★ — Sangat Bagus</option>
                            <option value="4">★★★★☆ — Bagus</option>
                            <option value="3">★★★☆☆ — Cukup</option>
                            <option value="2">★★☆☆☆ — Kurang</option>
                            <option value="1">★☆☆☆☆ — Sangat Kurang</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">
                            Komentar
                        </label>

                        <textarea
                            name="comment"
                            id="comment"
                            class="form-control"
                            rows="4"
                            maxlength="1000"
                            placeholder="Ceritakan pengalamanmu dengan produk ini..."
                        >{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-ani-pink">
                        Kirim Review
                    </button>
                </form>
            </div>
        @else
            <div class="review-login-card">
                <p>Silakan login terlebih dahulu untuk memberikan review.</p>

                <a href="{{ route('login') }}" class="btn btn-ani-pink">
                    Login
                </a>
            </div>
        @endauth

        {{-- Daftar Review --}}
        <div class="review-list">

            @forelse($product->reviews()->with('user')->latest()->get() as $review)

                <div class="review-card">

                    <div class="review-card-header">
                        <div>
                            <strong>{{ $review->user->name }}</strong>

                            <div class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <small>
                            {{ $review->created_at->format('d M Y') }}
                        </small>
                    </div>

                    @if($review->comment)
                        <p class="review-comment">
                            {{ $review->comment }}
                        </p>
                    @endif

                    @if(auth()->check() && auth()->id() === $review->user_id)
                    <div class="review-actions">

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#editReviewModal{{ $review->id }}"
                        >
                            Edit
                        </button>

                        <form
                            action="{{ route('reviews.destroy', $product) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus review ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                Hapus
                            </button>
                        </form>

                    </div>
                @endif

                @if(auth()->check() && auth()->id() === $review->user_id)
                <div
                    class="modal fade"
                    id="editReviewModal{{ $review->id }}"
                    tabindex="-1"
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content review-modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Edit Review
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>

                            <form
                                action="{{ route('reviews.update', $product) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PUT')

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label
                                            for="edit_rating_{{ $review->id }}"
                                            class="form-label"
                                        >
                                            Rating
                                        </label>

                                        <select
                                            name="rating"
                                            id="edit_rating_{{ $review->id }}"
                                            class="form-select"
                                            required
                                        >
                                            @for($i = 5; $i >= 1; $i--)
                                                <option
                                                    value="{{ $i }}"
                                                    @selected($review->rating == $i)
                                                >
                                                    {{ str_repeat('★', $i) }}
                                                    {{ $i }}/5
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label
                                            for="edit_comment_{{ $review->id }}"
                                            class="form-label"
                                        >
                                            Komentar
                                        </label>

                                        <textarea
                                            name="comment"
                                            id="edit_comment_{{ $review->id }}"
                                            class="form-control"
                                            rows="4"
                                            maxlength="1000"
                                        >{{ $review->comment }}</textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Batal
                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-ani-pink"
                                    >
                                        Simpan Perubahan
                                    </button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            @endif

                </div>

            @empty

                <div class="review-empty">
                    <div class="review-empty-icon">⭐</div>

                    <h4>Belum ada review</h4>

                    <p>
                        Jadilah orang pertama yang memberikan review untuk produk ini.
                    </p>
                </div>

            @endforelse

        </div>

    </div>
</section>

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