@extends('layouts.app')

@section('title', 'Categories - Admin Anireshop')

@section('content')

<div class="ani-admin-categories-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-categories-header">

            <div>
                <span class="ani-admin-eyebrow">
                    CATEGORY MANAGEMENT
                </span>

                <h1>Categories</h1>

                <p>
                    Kelola kategori produk Anireshop.
                </p>
            </div>

            <a href="{{ route('admin.categories.create') }}"
               class="ani-admin-primary-btn">
                <span>+</span>
                Tambah Kategori
            </a>

        </div>


        {{-- ALERT --}}
        @if(session('success'))
            <div class="ani-admin-category-alert success">
                <div class="ani-admin-category-alert-icon">✓</div>

                <div>
                    <strong>Berhasil</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="ani-admin-category-alert error">
                <div class="ani-admin-category-alert-icon">!</div>

                <div>
                    <strong>Terjadi Kesalahan</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif


        {{-- CATEGORY CARD --}}
        <div class="ani-admin-categories-card">

            <div class="ani-admin-categories-card-header">

                <div>
                    <span class="ani-admin-card-eyebrow">
                        CATEGORY LIST
                    </span>

                    <h2>Daftar Kategori</h2>
                </div>

                <div class="ani-admin-category-count">
                    {{ $categories->total() }} Kategori
                </div>

            </div>


            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="ani-admin-categories-table">

                    <thead>
                        <tr>
                            <th class="col-number">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Produk</th>
                            <th class="col-action">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                {{-- NUMBER --}}
                                <td class="category-number">
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>


                                {{-- NAME --}}
                                <td>
                                    <div class="ani-admin-category-name">

                                        <div class="ani-admin-category-icon">
                                            📁
                                        </div>

                                        <div>
                                            <strong>
                                                {{ $category->name }}
                                            </strong>

                                            <small>
                                                Category #{{ $category->id }}
                                            </small>
                                        </div>

                                    </div>
                                </td>


                                {{-- SLUG --}}
                                <td>
                                    <span class="ani-admin-category-slug">
                                        {{ $category->slug }}
                                    </span>
                                </td>


                                {{-- PRODUCT COUNT --}}
                                <td>
                                    <span class="ani-admin-product-count-badge">
                                        {{ $category->products_count }}
                                        Produk
                                    </span>
                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="ani-admin-category-actions">

                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="ani-admin-edit-btn">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="ani-admin-delete-btn">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5">

                                    <div class="ani-admin-category-empty">

                                        <div class="ani-admin-category-empty-icon">
                                            📂
                                        </div>

                                        <strong>
                                            Belum Ada Kategori
                                        </strong>

                                        <p>
                                            Belum ada kategori produk
                                            yang tersedia.
                                        </p>

                                        <a href="{{ route('admin.categories.create') }}"
                                           class="ani-admin-empty-btn">
                                            + Tambah Kategori
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER / PAGINATION --}}
            @if($categories->hasPages())

                <div class="ani-admin-categories-footer">

                    <div class="ani-admin-pagination-info">
                        Menampilkan
                        <strong>{{ $categories->firstItem() }}</strong>
                        –
                        <strong>{{ $categories->lastItem() }}</strong>
                        dari
                        <strong>{{ $categories->total() }}</strong>
                        kategori
                    </div>

                    <div class="ani-admin-categories-pagination">
                        {{ $categories->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection