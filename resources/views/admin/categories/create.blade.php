@extends('layouts.app')

@section('title', 'Tambah Kategori - Admin Anireshop')

@section('content')

<div class="ani-admin-category-form-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-category-form-header">

            <div>
                <span class="ani-admin-eyebrow">
                    CATEGORY MANAGEMENT
                </span>

                <h1>Tambah Kategori</h1>

                <p>
                    Tambahkan kategori baru untuk produk Anireshop.
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
                            01
                        </div>

                        <div>
                            <span>CATEGORY INFORMATION</span>

                            <h2>Data Kategori</h2>
                        </div>

                    </div>


                    <form action="{{ route('admin.categories.store') }}"
                          method="POST">

                        @csrf

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
                                    value="{{ old('name') }}"
                                    class="@error('name') is-invalid @enderror"
                                    placeholder="Contoh: Acrylic Stand"
                                    autocomplete="off"
                                    required
                                >

                                <div class="ani-admin-category-field-help">
                                    Gunakan nama kategori yang singkat dan mudah
                                    dikenali oleh pelanggan.
                                </div>

                                @error('name')
                                    <div class="ani-admin-category-field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                                    ✓ Simpan Kategori
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- INFORMATION --}}
            <div class="col-lg-5">

                <div class="ani-admin-category-info-card">

                    <div class="ani-admin-category-info-icon">
                        📁
                    </div>

                    <span class="ani-admin-card-eyebrow">
                        CATEGORY GUIDE
                    </span>

                    <h2>
                        Informasi Kategori
                    </h2>

                    <p>
                        Nama kategori akan digunakan sebagai kategori
                        produk di Anireshop.
                    </p>

                    <div class="ani-admin-category-info-divider"></div>

                    <div class="ani-admin-category-info-item">
                        <span>01</span>
                        <div>
                            <strong>Nama Kategori</strong>
                            <p>
                                Gunakan nama yang jelas dan mudah dipahami.
                            </p>
                        </div>
                    </div>

                    <div class="ani-admin-category-info-item">
                        <span>02</span>
                        <div>
                            <strong>Slug Otomatis</strong>
                            <p>
                                Slug akan dibuat otomatis berdasarkan
                                nama kategori.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection