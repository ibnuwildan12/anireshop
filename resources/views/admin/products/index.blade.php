@extends('layouts.app')

@section('title', 'Products - Anireshop')

@section('content')

<div class="ani-admin-products-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-products-header">

            <div>
                <span class="ani-admin-eyebrow">
                    PRODUCT MANAGEMENT
                </span>

                <h1>
                    Products
                </h1>

                <p>
                    Kelola produk, harga, gambar, dan persediaan Anireshop.
                </p>
            </div>

            <a
                href="{{ route('admin.products.create') }}"
                class="ani-admin-primary-btn"
            >
                <span>＋</span>
                Tambah Produk
            </a>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))

            <div class="ani-admin-products-alert success">
                <span>✓</span>
                <div>{{ session('success') }}</div>
            </div>

        @endif


        @if(session('error'))

            <div class="ani-admin-products-alert error">
                <span>!</span>
                <div>{{ session('error') }}</div>
            </div>

        @endif


        {{-- PRODUCT TABLE --}}
        <div class="ani-admin-products-card">

            <div class="ani-admin-products-card-header">

                <div>
                    <span class="ani-admin-card-eyebrow">
                        INVENTORY
                    </span>

                    <h2>
                        Daftar Produk
                    </h2>
                </div>

                <div class="ani-admin-product-count">
                    {{ $products->total() }} Produk
                </div>

            </div>


            <div class="table-responsive">

                <table class="ani-admin-products-table">

                    <thead>
                        <tr>

                            <th class="col-number">
                                #
                            </th>

                            <th>
                                Produk
                            </th>

                            <th>
                                Kategori
                            </th>

                            <th>
                                Harga
                            </th>

                            <th class="text-center">
                                Stock
                            </th>

                            <th class="text-center">
                                Reserved
                            </th>

                            <th class="text-center">
                                Available
                            </th>

                            <th class="text-end">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    <tbody>

                        @forelse($products as $product)

                            <tr>

                                {{-- NUMBER --}}
                                <td class="product-number">

                                    {{ $products->firstItem() + $loop->index }}

                                </td>


                                {{-- PRODUCT --}}
                                <td>

                                    <div class="ani-admin-product-info">

                                        <div class="ani-admin-product-image">

                                            @if($product->images->first())

                                                <img
                                                    src="{{ asset('images/' . $product->images->first()->image_path) }}"
                                                    alt="{{ $product->name }}"
                                                >

                                            @else

                                                <span>
                                                    —
                                                </span>

                                            @endif

                                        </div>


                                        <div class="ani-admin-product-name">

                                            <strong>
                                                {{ $product->name }}
                                            </strong>

                                            <small>
                                                ID #{{ $product->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- CATEGORY --}}
                                <td>

                                    <span class="ani-admin-category-badge">
                                        {{ $product->category->name ?? '-' }}
                                    </span>

                                </td>


                                {{-- PRICE --}}
                                <td>

                                    <strong class="ani-admin-product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </strong>

                                </td>


                                {{-- STOCK --}}
                                <td class="text-center">

                                    <span class="ani-stock-number">
                                        {{ $product->stock }}
                                    </span>

                                </td>


                                {{-- RESERVED --}}
                                <td class="text-center">

                                    @if($product->reserved_stock > 0)

                                        <span class="ani-stock-badge reserved">
                                            {{ $product->reserved_stock }}
                                        </span>

                                    @else

                                        <span class="ani-stock-badge neutral">
                                            0
                                        </span>

                                    @endif

                                </td>


                                {{-- AVAILABLE --}}
                                <td class="text-center">

                                    @if($product->available_stock > 5)

                                        <span class="ani-stock-badge available">
                                            {{ $product->available_stock }}
                                        </span>

                                    @elseif($product->available_stock > 0)

                                        <span class="ani-stock-badge low">
                                            {{ $product->available_stock }}
                                        </span>

                                    @else

                                        <span class="ani-stock-badge sold">
                                            Habis
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="ani-admin-product-actions">

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="ani-admin-edit-btn"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="ani-admin-delete-btn"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="ani-admin-empty"
                                >

                                    <div class="ani-admin-empty-icon">
                                        ◈
                                    </div>

                                    <strong>
                                        Belum ada produk
                                    </strong>

                                    <span>
                                        Tambahkan produk pertama Anireshop.
                                    </span>

                                    <a
                                        href="{{ route('admin.products.create') }}"
                                        class="ani-admin-empty-btn"
                                    >
                                        ＋ Tambah Produk
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($products->hasPages())

                <div class="ani-admin-products-pagination">

                    <div class="ani-pagination-info">

                        Menampilkan
                        <strong>{{ $products->firstItem() }}</strong>
                        –
                        <strong>{{ $products->lastItem() }}</strong>
                        dari
                        <strong>{{ $products->total() }}</strong>
                        produk

                    </div>


                    <nav>

                        <ul class="pagination mb-0">

                            {{-- PREVIOUS --}}
                            @if($products->onFirstPage())

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        ‹
                                    </span>

                                </li>

                            @else

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $products->previousPageUrl() }}"
                                    >
                                        ‹
                                    </a>

                                </li>

                            @endif


                            {{-- PAGES --}}
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)

                                <li
                                    class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}"
                                >

                                    <a
                                        class="page-link"
                                        href="{{ $url }}"
                                    >
                                        {{ $page }}
                                    </a>

                                </li>

                            @endforeach


                            {{-- NEXT --}}
                            @if($products->hasMorePages())

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $products->nextPageUrl() }}"
                                    >
                                        ›
                                    </a>

                                </li>

                            @else

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        ›
                                    </span>

                                </li>

                            @endif

                        </ul>

                    </nav>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection