@extends('layouts.app')

@section('title', 'Produk - Anireshop')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="mb-4">
        <div class="text-uppercase fw-bold"
             style="color:#ec4899; letter-spacing:2px; font-size:13px;">
            PRODUK
        </div>

        <h1 class="fw-bold text-white">
            Koleksi Anireshop
        </h1>

        <p style="color:#b8a9c9;">
            Temukan merchandise anime, K-Pop, dan accessories favoritmu.
        </p>
    </div>


    {{-- CATEGORY FILTER --}}
    <div class="mb-4">

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('products.index') }}"
               class="btn {{ !request('category') ? 'btn-ani' : 'btn-outline-light' }}">
                Semua
            </a>

            @foreach($categories as $category)

                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="btn {{ request('category') === $category->slug ? 'btn-ani' : 'btn-outline-light' }}">
                    {{ $category->name }}
                </a>

            @endforeach

        </div>

    </div>


    {{-- PRODUCT GRID --}}
    <div class="row g-4">

        @forelse($products as $product)

            <div class="col-6 col-md-4 col-lg-3">

                <a href="{{ route('products.show', $product->slug) }}"
                   class="text-decoration-none">

                    <div class="ani-card h-100 overflow-hidden">

                        {{-- IMAGE --}}
                        <div style="height:220px;">

                            @if($product->images->count())

                                <img
                                    src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="w-100 h-100"
                                    style="object-fit:cover;"
                                >

                            @else

                                <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background:#211331; color:#b8a9c9;">
                                    No Image
                                </div>

                            @endif

                        </div>


                        {{-- INFO --}}
                        <div class="p-3">

                            <small style="color:#c4b5fd;">
                                {{ $product->category->name }}
                            </small>

                            <h5 class="text-white fw-bold mt-1 mb-2">
                                {{ $product->name }}
                            </h5>

                            <div style="color:#ec4899; font-weight:800;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <small style="color:#b8a9c9;">
                                Stok: {{ $product->available_stock }}
                            </small>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <div class="col-12">

                <div class="ani-card p-5 text-center">

                    <h4 class="text-white">
                        Produk tidak ditemukan
                    </h4>

                    <p style="color:#b8a9c9;">
                        Belum ada produk dalam kategori ini.
                    </p>

                    <a href="{{ route('products.index') }}"
                       class="btn btn-ani">
                        Lihat Semua Produk
                    </a>

                </div>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>

@endsection