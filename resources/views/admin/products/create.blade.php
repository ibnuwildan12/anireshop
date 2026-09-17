@extends('layouts.app')

@section('title', 'Tambah Produk - Anireshop')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Tambah Produk</h2>
        <p class="text-secondary mb-0">
            Tambahkan produk baru ke Anireshop
        </p>
    </div>

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body p-4">

        <form action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama Produk
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           required>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        Kategori
                    </label>

                    <select id="category_id"
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        Deskripsi
                    </label>

                    <textarea id="description"
                              name="description"
                              rows="5"
                              class="form-control @error('description') is-invalid @enderror"
                              required>{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">
                            Harga
                        </label>

                        <input type="number"
                               id="price"
                               name="price"
                               value="{{ old('price') }}"
                               min="1"
                               class="form-control @error('price') is-invalid @enderror"
                               required>

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">
                            Stock
                        </label>

                        <input type="number"
                               id="stock"
                               name="stock"
                               value="{{ old('stock', 0) }}"
                               min="0"
                               class="form-control @error('stock') is-invalid @enderror"
                               required>

                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">
                        Gambar Produk
                    </label>

                    <input type="file"
                        id="images"
                        name="images[]"
                        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png"
                        multiple>

                    <div class="form-text text-secondary">
                        Bisa memilih beberapa gambar. Format JPG, JPEG, PNG. Maksimal 2 MB per gambar.
                    </div>

                    @error('images')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('images.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-ani">
                        Simpan Produk
                    </button>

                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection