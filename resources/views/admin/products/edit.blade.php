@extends('layouts.app')

@section('title', 'Edit Produk - Anireshop')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Edit Produk</h2>
        <p class="text-secondary mb-0">
            Perbarui informasi produk Anireshop
        </p>
    </div>

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body p-4">

        <form action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama Produk
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $product->name) }}"
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

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                              required>{{ old('description', $product->description) }}</textarea>

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
                               value="{{ old('price', $product->price) }}"
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
                               value="{{ old('stock', $product->stock) }}"
                               min="{{ $product->reserved_stock }}"
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
                    <label class="form-label">
                        Stock Reserved
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $product->reserved_stock }}"
                           disabled>

                    <div class="form-text text-secondary">
                        Stock tidak boleh lebih kecil dari stock yang sedang reserved.
                    </div>
                </div>

                {{-- Gambar Saat Ini --}}
                <div class="mb-4">
                    <label class="form-label">
                        Gambar Saat Ini
                    </label>

                    @if($product->images->count())
                        <div class="row g-3">
                            @foreach($product->images as $image)
                            <div class="col-6 col-md-3">
                                <div class="card bg-dark border-secondary p-2">

                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="img-fluid rounded"
                                        style="width: 100%; height: 160px; object-fit: cover;">

                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                        <span class="text-secondary small">
                                            Gambar {{ $loop->iteration }}
                                        </span>

                                        <button type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="deleteProductImage('{{ route('admin.products.images.destroy', [$product, $image]) }}')">
                                            Hapus
                                        </button>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-secondary">
                            Produk belum memiliki gambar.
                        </p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="images" class="form-label">
                        Tambah Gambar Produk
                    </label>

                    <input type="file"
                        id="images"
                        name="images[]"
                        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png"
                        multiple>

                    <div class="form-text text-secondary">
                        Bisa memilih beberapa gambar. JPG, JPEG, PNG. Maksimal 2 MB per gambar.
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
                        Simpan Perubahan
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

<script>
    function deleteProductImage(url) {
        if (!confirm('Yakin ingin menghapus gambar ini?')) {
            return;
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';

        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';

        form.appendChild(csrf);
        form.appendChild(method);

        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection