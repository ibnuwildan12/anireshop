@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                My Wishlist
            </h1>

            <p class="text-muted mb-0">
                Produk yang kamu simpan untuk nanti.
            </p>
        </div>

        <a
            href="{{ route('products.index') }}"
            class="ani-btn-secondary"
        >
            ← Continue Shopping
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>

    @endif


    {{-- EMPTY WISHLIST --}}
    @if($wishlists->isEmpty())

        <div class="ani-wishlist-empty text-center">

            <div class="ani-wishlist-heart">
                ♡
            </div>

            <h3 class="fw-bold mt-3">
                Wishlist masih kosong
            </h3>

            <p class="text-muted mb-4">
                Simpan produk favoritmu supaya mudah ditemukan lagi.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="ani-btn-pink"
            >
                Explore Products
            </a>

        </div>

    @else

        {{-- WISHLIST PRODUCTS --}}
        <div class="row g-4">

            @foreach($wishlists as $wishlist)

                @php
                    $product = $wishlist->product;
                @endphp

                @if($product)

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="ani-wishlist-card h-100">

                            {{-- IMAGE --}}
                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="ani-wishlist-image"
                                >

                            @else

                                <div class="ani-wishlist-no-image">
                                    No Image
                                </div>

                            @endif


                            {{-- CONTENT --}}
                            <div class="ani-wishlist-content">

                                <h5 class="ani-wishlist-name">
                                    {{ $product->name }}
                                </h5>

                                <div class="ani-wishlist-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>


                                <div class="ani-wishlist-actions">

                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        class="ani-btn-pink flex-grow-1"
                                    >
                                        View Product
                                    </a>


                                    <form
                                        action="{{ route('wishlist.destroy', $product) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="ani-wishlist-remove"
                                            title="Remove from wishlist"
                                        >
                                            ♥
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    @endif

</div>

@endsection