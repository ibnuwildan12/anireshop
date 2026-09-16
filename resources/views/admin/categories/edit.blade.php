@extends('layouts.app')

@section('title', 'Edit Kategori - Admin Anireshop')

@section('content')

<div class="admin-page">

    <div class="container py-5">

        <div class="mb-4">

            <div class="admin-label">
                ADMIN PANEL
            </div>

            <h1 class="fw-bold text-white mb-1">
                Edit Kategori
            </h1>

            <p style="color:#aaa;">
                Ubah informasi kategori produk Anireshop.
            </p>

        </div>


        <div class="row">

            <div class="col-lg-7">

                <div class="ani-card p-4">

                    <form
                        action="{{ route('admin.categories.update', $category) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


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
                                value="{{ old('name', $category->name) }}"
                                required
                            >

                            @error('name')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Slug
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $category->slug }}"
                                disabled
                            >

                            <small style="color:#888;">
                                Slug akan diperbarui otomatis berdasarkan nama kategori.
                            </small>

                        </div>


                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-ani"
                            >
                                Simpan Perubahan
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


            <div class="col-lg-5 mt-4 mt-lg-0">

                <div class="ani-card p-4">

                    <h5 class="text-white fw-bold mb-3">
                        Kategori Saat Ini
                    </h5>

                    <p style="color:#aaa;" class="mb-2">
                        Nama:
                    </p>

                    <p class="text-white fw-bold">
                        {{ $category->name }}
                    </p>

                    <p style="color:#aaa;" class="mb-2">
                        Jumlah Produk:
                    </p>

                    <p class="text-white fw-bold mb-0">
                        {{ $category->products()->count() }} produk
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection