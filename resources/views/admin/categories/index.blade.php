@extends('layouts.app')

@section('title', 'Categories - Admin Anireshop')

@section('content')

<div class="admin-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <div class="admin-label">
                    ADMIN PANEL
                </div>

                <h1 class="fw-bold text-white mb-1">
                    Categories
                </h1>

                <p style="color:#aaa;">
                    Kelola kategori produk Anireshop.
                </p>
            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="btn btn-ani"
            >
                + Tambah Kategori
            </a>

        </div>


        {{-- CATEGORY TABLE --}}
        <div class="ani-card overflow-hidden">

            <div class="table-responsive">

                <table class="table ani-admin-table align-middle mb-0">

                    <thead>

                        <tr>
                            <th width="70">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Jumlah Produk</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                <td>
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $category->name }}
                                    </strong>
                                </td>

                                <td>
                                    <span style="color:#aaa;">
                                        {{ $category->slug }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge"
                                          style="background:#7c3aed;">
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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

                                <td colspan="5"
                                    class="text-center py-5">

                                    <div style="font-size:40px;">
                                        📂
                                    </div>

                                    <h5 class="text-white mt-3">
                                        Belum Ada Kategori
                                    </h5>

                                    <p style="color:#aaa;">
                                        Belum ada kategori produk.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINATION --}}
        @if($categories->hasPages())

            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>

        @endif

    </div>

</div>

@endsection