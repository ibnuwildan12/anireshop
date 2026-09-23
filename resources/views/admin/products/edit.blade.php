@extends('layouts.app')

@section('title', 'Edit Produk - Anireshop')

@section('content')

<div class="ani-admin-product-form-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-form-header">

            <div>
                <span class="ani-admin-eyebrow">
                    PRODUCT MANAGEMENT
                </span>

                <h1>
                    Edit Produk
                </h1>

                <p>
                    Perbarui informasi produk Anireshop.
                </p>
            </div>

            <a
                href="{{ route('admin.products.index') }}"
                class="ani-admin-back-btn"
            >
                ← Kembali ke Produk
            </a>

        </div>


        {{-- VALIDATION --}}
        @if ($errors->any())

            <div class="ani-admin-form-alert">

                <div class="ani-admin-form-alert-icon">
                    !
                </div>

                <div>

                    <strong>
                        Periksa kembali data produk
                    </strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            </div>

        @endif


        {{-- FORM CARD --}}
        <div class="ani-admin-form-card">

            <div class="ani-admin-form-card-header">

                <div class="ani-admin-form-number">
                    02
                </div>

                <div>

                    <span>
                        PRODUCT INFORMATION
                    </span>

                    <h2>
                        {{ $product->name }}
                    </h2>

                </div>

            </div>


            <form
                action="{{ route('admin.products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="ani-admin-form-body">


                    {{-- PRODUCT NAME --}}
                    <div class="ani-admin-field">

                        <label for="name">
                            Nama Produk
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $product->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            required
                        >

                        @error('name')
                            <div class="ani-admin-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CATEGORY --}}
                    <div class="ani-admin-field">

                        <label for="category_id">
                            Kategori
                            <span>*</span>
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required
                        >

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="ani-admin-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="ani-admin-field">

                        <label for="description">
                            Deskripsi
                            <span>*</span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                            required
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <div class="ani-admin-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PRICE + STOCK --}}
                    <div class="row g-4">

                        {{-- PRICE --}}
                        <div class="col-md-6">

                            <div class="ani-admin-field">

                                <label for="price">
                                    Harga
                                    <span>*</span>
                                </label>

                                <div class="ani-admin-input-prefix">

                                    <span>
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        min="1"
                                        class="form-control @error('price') is-invalid @enderror"
                                        required
                                    >

                                </div>

                                @error('price')
                                    <div class="ani-admin-field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- STOCK --}}
                        <div class="col-md-6">

                            <div class="ani-admin-field">

                                <label for="stock">
                                    Stock
                                    <span>*</span>
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    min="{{ $product->reserved_stock }}"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    required
                                >

                                <div class="ani-admin-field-help">
                                    Stock tidak boleh lebih kecil dari
                                    stock yang sedang reserved.
                                </div>

                                @error('stock')
                                    <div class="ani-admin-field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- RESERVED STOCK --}}
                    <div class="ani-admin-field">

                        <label>
                            Stock Reserved
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $product->reserved_stock }}"
                            disabled
                        >

                        <div class="ani-admin-field-help">
                            Stock reserved sedang digunakan untuk
                            pesanan yang belum selesai.
                        </div>

                    </div>


                    {{-- CURRENT IMAGES --}}
                    <div class="ani-admin-current-images-section">

                        <div class="ani-admin-images-heading">

                            <div>

                                <span>
                                    MEDIA
                                </span>

                                <h3>
                                    Gambar Saat Ini
                                </h3>

                            </div>

                            <small>
                                {{ $product->images->count() }}
                                gambar
                            </small>

                        </div>


                        @if($product->images->count())

                            <div class="ani-admin-current-images">

                                @foreach($product->images as $image)

                                    <div class="ani-admin-image-card">

                                        <div class="ani-admin-image-preview">

                                            <img
                                                src="{{ asset('images/' . $image->image_path) }}"
                                                alt="{{ $product->name }}"
                                            >

                                        </div>


                                        <div class="ani-admin-image-footer">

                                            <span>
                                                Gambar {{ $loop->iteration }}
                                            </span>


                                            <button
                                                type="button"
                                                class="ani-admin-image-delete"
                                                onclick="deleteProductImage('{{ route('admin.products.images.destroy', [$product, $image]) }}')"
                                            >
                                                Hapus
                                            </button>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="ani-admin-no-images">
                                Produk belum memiliki gambar.
                            </div>

                        @endif

                    </div>


                    {{-- ADD IMAGES --}}
                    <div class="ani-admin-field mt-4">

                        <label for="images">
                            Tambah Gambar Produk
                        </label>

                        <div class="ani-admin-upload-box">

                            <div class="ani-admin-upload-icon">
                                ↑
                            </div>

                            <div class="ani-admin-upload-content">

                                <strong>
                                    Upload gambar tambahan
                                </strong>

                                <span>
                                    Bisa memilih beberapa gambar sekaligus.
                                </span>

                                <small>
                                    JPG, JPEG, PNG · Maksimal 2 MB per gambar
                                </small>

                            </div>

                            <input
                                type="file"
                                id="images"
                                name="images[]"
                                class="ani-admin-file-input @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png"
                                multiple
                            >

                        </div>


                        @error('images')
                            <div class="ani-admin-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                        @error('images.*')
                            <div class="ani-admin-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>


                {{-- FOOTER --}}
                <div class="ani-admin-form-footer">

                    <div class="ani-admin-required-info">
                        <span>*</span>
                        Field wajib diisi
                    </div>


                    <div class="ani-admin-form-actions">

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="ani-admin-cancel-btn"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="ani-admin-save-btn"
                        >
                            ✓ Simpan Perubahan
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- DELETE IMAGE --}}
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