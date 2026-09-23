@extends('layouts.app')

@section('title', 'Edit Kategori - Admin Anireshop')

@section('content')

<div class="ani-admin-category-form-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-category-form-header">

            <div>
                <span class="ani-admin-eyebrow">
                    CATEGORY MANAGEMENT
                </span>

                <h1>Edit Kategori</h1>

                <p>
                    Ubah informasi kategori produk Anireshop.
                </p>
            </div>

            <a href="{{ route('admin.categories.index') }}"
               class="ani-admin-back-btn">
                ← Kembali ke Categories
            </a>

        </div>


        {{-- VALIDATION --}}
        @if ($errors->any())

            <div class="ani-admin-category-form-alert">

                <div class="ani-admin-category-form-alert-icon">
                    !
                </div>

                <div>
                    <strong>
                        Periksa kembali data kategori
                    </strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        @endif


        <div class="row g-4">

            {{-- FORM --}}
            <div class="col-lg-7">

                <div class="ani-admin-category-form-card">

                    <div class="ani-admin-category-form-card-header">

                        <div class="ani-admin-form-number">
                            02
                        </div>

                        <div>
                            <span>CATEGORY INFORMATION</span>

                            <h2>{{ $category->name }}</h2>
                        </div>

                    </div>


                    <form action="{{ route('admin.categories.update', $category) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="ani-admin-category-form-body">

                            {{-- NAME --}}
                            <div class="ani-admin-category-field">

                                <label for="name">
                                    Nama Kategori
                                    <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $category->name) }}"
                                    class="@error('name') is-invalid @enderror"
                                    autocomplete="off"
                                    required
                                >

                                <div class="ani-admin-category-field-help">
                                    Nama kategori dapat diubah dan slug akan
                                    diperbarui otomatis berdasarkan nama baru.
                                </div>

                                @error('name')
                                    <div class="ani-admin-category-field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SLUG --}}
                            <div class="ani-admin-category-field">

                                <label for="slug">
                                    Slug
                                </label>

                                <input
                                    type="text"
                                    id="slug"
                                    value="{{ $category->slug }}"
                                    disabled
                                >

                                <div class="ani-admin-category-field-help">
                                    Slug hanya sebagai informasi dan akan
                                    diperbarui otomatis oleh sistem.
                                </div>

                            </div>

                        </div>


                        {{-- FOOTER --}}
                        <div class="ani-admin-category-form-footer">

                            <div class="ani-admin-category-required-info">
                                <span>*</span>
                                Field wajib diisi
                            </div>

                            <div class="ani-admin-category-form-actions">

                                <a href="{{ route('admin.categories.index') }}"
                                   class="ani-admin-category-cancel-btn">
                                    Batal
                                </a>

                                <button type="submit"
                                        class="ani-admin-category-save-btn">
                                    ✓ Simpan Perubahan
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- CURRENT CATEGORY INFO --}}
            <div class="col-lg-5">

                <div class="ani-admin-category-info-card">

                    <div class="ani-admin-category-info-icon">
                        📁
                    </div>

                    <span class="ani-admin-card-eyebrow">
                        CURRENT CATEGORY
                    </span>

                    <h2>
                        {{ $category->name }}
                    </h2>

                    <div class="ani-admin-category-current-info">

                        <div class="ani-admin-category-current-item">

                            <span>Nama</span>

                            <strong>
                                {{ $category->name }}
                            </strong>

                        </div>


                        <div class="ani-admin-category-current-item">

                            <span>Slug</span>

                            <strong class="slug">
                                {{ $category->slug }}
                            </strong>

                        </div>


                        <div class="ani-admin-category-current-item">

                            <span>Jumlah Produk</span>

                            <strong>
                                {{ $category->products()->count() }} produk
                            </strong>

                        </div>

                    </div>

                    <div class="ani-admin-category-info-divider"></div>

                    <div class="ani-admin-category-info-note">

                        <span>i</span>

                        <p>
                            Perubahan nama kategori tidak mengubah
                            produk yang sudah berada di dalam kategori ini.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection