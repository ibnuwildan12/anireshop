@extends('layouts.app')

@section('title', 'Produk - Anireshop')

@section('content')

<div class="ani-catalog-page">

    <div class="container py-5">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="catalog-header mb-4">

            <div class="catalog-label">
                PRODUK ANIRESHOP
            </div>

            <h1 class="catalog-title">
                Koleksi <span>Anireshop</span>
            </h1>

            <p class="catalog-subtitle">
                Temukan merchandise anime, K-Pop, dan accessories favoritmu.
            </p>

        </div>


        {{-- =====================================================
             SEARCH
        ====================================================== --}}

        <form
            action="{{ route('products.index') }}"
            method="GET"
            class="catalog-search-form mb-4"
        >

            @if(request('category'))
                <input
                    type="hidden"
                    name="category"
                    value="{{ request('category') }}"
                >
            @endif

            <div class="catalog-search">

                <span class="catalog-search-icon">
                    🔎
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari merchandise..."
                    autocomplete="off"
                >

                @if(request('search'))

                    <a
                        href="{{ request('category')
                            ? route('products.index', ['category' => request('category')])
                            : route('products.index') }}"
                        class="catalog-search-clear"
                        title="Hapus pencarian"
                    >
                        ×
                    </a>

                @endif

                <button type="submit">
                    Cari
                </button>

            </div>

        </form>


        {{-- =====================================================
             CATEGORY FILTER
        ====================================================== --}}

        <div class="catalog-filter mb-5">

            <div class="catalog-filter-title">
                Kategori
            </div>

            <div class="catalog-category-list">

                <a
                    href="{{ route('products.index', request('search')
                        ? ['search' => request('search')]
                        : []) }}"
                    class="catalog-category
                        {{ !request('category') ? 'active' : '' }}"
                >
                    Semua
                </a>

                @foreach($categories as $category)

                    <a
                        href="{{ route('products.index', array_filter([
                            'category' => $category->slug,
                            'search' => request('search')
                        ])) }}"
                        class="catalog-category
                            {{ request('category') === $category->slug ? 'active' : '' }}"
                    >
                        {{ $category->name }}
                    </a>

                @endforeach

            </div>

        </div>


        {{-- =====================================================
             RESULT INFO
        ====================================================== --}}

        <div class="catalog-result-bar mb-3">

            <div>

                @if(request('search'))

                    Hasil pencarian untuk
                    <strong>"{{ request('search') }}"</strong>

                @elseif(request('category'))

                    Kategori:
                    <strong>
                        {{ $categories->firstWhere('slug', request('category'))?->name }}
                    </strong>

                @else

                    Semua Produk

                @endif

            </div>

            <div>
                {{ $products->total() }} produk
            </div>

        </div>


        {{-- =====================================================
             PRODUCT GRID
        ====================================================== --}}

        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-6 col-md-4 col-lg-3">

                    <a
                        href="{{ route('products.show', $product->slug) }}"
                        class="catalog-product-link"
                    >

                        <div class="catalog-product-card">

                            {{-- IMAGE --}}

                            <div class="catalog-product-image">

                                @if($product->images->count())

                                    <img
                                        src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                        decoding="async"
                                    >

                                @else

                                    <div class="catalog-no-image">
                                        No Image
                                    </div>

                                @endif


                                {{-- STOCK BADGE --}}

                                @if($product->available_stock <= 0)

                                    <span class="catalog-stock-badge sold">
                                        Habis
                                    </span>

                                @elseif($product->available_stock <= 5)

                                    <span class="catalog-stock-badge low">
                                        Sisa {{ $product->available_stock }}
                                    </span>

                                @else

                                    <span class="catalog-stock-badge available">
                                        Tersedia
                                    </span>

                                @endif

                            </div>


                            {{-- PRODUCT INFO --}}

                            <div class="catalog-product-info">

                                <div class="catalog-product-category">
                                    {{ $product->category->name }}
                                </div>

                                <h5 class="catalog-product-name">
                                    {{ $product->name }}
                                </h5>

                                <div class="catalog-product-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="catalog-empty">

                        <div class="catalog-empty-icon">
                            🔎
                        </div>

                        <h4>
                            Produk tidak ditemukan
                        </h4>

                        <p>
                            Coba gunakan kata pencarian atau kategori yang berbeda.
                        </p>

                        <a
                            href="{{ route('products.index') }}"
                            class="btn btn-ani"
                        >
                            Lihat Semua Produk
                        </a>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($products->hasPages())

            <div class="catalog-pagination mt-5">

                {{ $products->links() }}

            </div>

        @endif

    </div>

</div>

@endsection