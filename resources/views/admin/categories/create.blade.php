@extends('layouts.app')

@section('title', 'Tambah Kategori - Admin Anireshop')

@section('content')

<div class="admin-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="mb-4">

            <div class="admin-label">
                ADMIN PANEL
            </div>

            <h1 class="fw-bold text-white mb-1">
                Tambah Kategori
            </h1>

            <p style="color:#aaa;">
                Tambahkan kategori baru untuk produk Anireshop.
            </p>

        </div>


        {{-- FORM --}}
        <div class="row">

            <div class="col-lg-7">

                <div class="ani-card p-4">

                    <form
                        action="{{ route('admin.categories.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- NAME --}}
                        <div class="mb-4">

                            <label
                                for="name"
                                class="form-label"
                            >
                                Nama Kategori
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Acrylic Stand"
                                required
                            >

                            @error('name')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-ani"
                            >
                                Simpan Kategori
                            </button>

                            <a
                                href="{{ route('admin.categories.index') }}"
                                class="btn btn-secondary"
                            >
                                Batal
                            </a>

                        </div>

                    </form>

                </div>

            </div>


            {{-- INFO --}}
            <div class="col-lg-5 mt-4 mt-lg-0">

                <div class="ani-card p-4">

                    <h5 class="text-white fw-bold mb-3">
                        Informasi
                    </h5>

                    <p style="color:#aaa;">
                        Nama kategori akan digunakan sebagai kategori
                        produk di Anireshop.
                    </p>

                    <p style="color:#aaa;" class="mb-0">
                        Slug akan dibuat otomatis berdasarkan nama kategori.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection