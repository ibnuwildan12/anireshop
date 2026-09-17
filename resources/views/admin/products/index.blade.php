@extends('layouts.app')

@section('title', 'Products - Anireshop')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Products</h2>
            <p class="text-secondary mb-0">
                Kelola produk Anireshop
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-ani">
            + Tambah Produk
        </a>
    </div>

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

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Reserved</th>
                            <th>Available</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $product->name }}</strong>
                                </td>

                                <td>
                                    {{ $product->category->name ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $product->stock }}
                                </td>

                                <td>
                                    {{ $product->reserved_stock }}
                                </td>

                                <td>
                                    {{ $product->available_stock }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    Belum ada produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if($products->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    <nav>
                        <ul class="pagination pagination-sm mb-0">

                            {{-- Previous --}}
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">‹</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link"
                                    href="{{ $products->previousPageUrl() }}">
                                        ‹
                                    </a>
                                </li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            {{-- Next --}}
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                    href="{{ $products->nextPageUrl() }}">
                                        ›
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">›</span>
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