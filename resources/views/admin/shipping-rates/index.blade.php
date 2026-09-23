@extends('layouts.app')

@section('title', 'Shipping Rates - Admin Anireshop')

@section('content')

<div class="ani-admin-shipping-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-shipping-header">

            <div>
                <span class="ani-admin-eyebrow">
                    SHIPPING MANAGEMENT
                </span>

                <h1>Shipping Rates</h1>

                <p>
                    Kelola tarif pengiriman Anireshop.
                </p>
            </div>

            <a href="{{ route('admin.shipping-rates.create') }}"
               class="ani-admin-primary-btn">
                <span>+</span>
                Tambah Tarif
            </a>

        </div>


        {{-- ALERT --}}
        @if(session('success'))

            <div class="ani-admin-shipping-alert success">

                <div class="ani-admin-shipping-alert-icon">
                    ✓
                </div>

                <div>
                    <strong>Berhasil</strong>
                    <p>{{ session('success') }}</p>
                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="ani-admin-shipping-alert error">

                <div class="ani-admin-shipping-alert-icon">
                    !
                </div>

                <div>
                    <strong>Terjadi Kesalahan</strong>
                    <p>{{ session('error') }}</p>
                </div>

            </div>

        @endif


        {{-- MAIN CARD --}}
        <div class="ani-admin-shipping-card">

            <div class="ani-admin-shipping-card-header">

                <div>
                    <span class="ani-admin-card-eyebrow">
                        SHIPPING RATE LIST
                    </span>

                    <h2>Daftar Tarif Pengiriman</h2>
                </div>

                <div class="ani-admin-shipping-count">
                    {{ $shippingRates->total() }} Tarif
                </div>

            </div>


            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="ani-admin-shipping-table">

                    <thead>

                        <tr>
                            <th class="col-number">#</th>
                            <th>Courier</th>
                            <th>Kabupaten / Kota</th>
                            <th>Biaya</th>
                            <th class="col-action">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($shippingRates as $rate)

                            <tr>

                                {{-- NUMBER --}}
                                <td class="shipping-number">
                                    {{ $shippingRates->firstItem() + $loop->index }}
                                </td>


                                {{-- COURIER --}}
                                <td>

                                    <span class="ani-admin-courier-badge">
                                        🚚 {{ $rate->courier }}
                                    </span>

                                </td>


                                {{-- CITY --}}
                                <td>

                                    <div class="ani-admin-shipping-city">

                                        <div class="ani-admin-city-icon">
                                            📍
                                        </div>

                                        <strong>
                                            {{ $rate->city }}
                                        </strong>

                                    </div>

                                </td>


                                {{-- COST --}}
                                <td>

                                    <span class="ani-admin-shipping-cost">
                                        Rp {{ number_format($rate->cost, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="ani-admin-shipping-actions">

                                        <a href="{{ route('admin.shipping-rates.edit', $rate) }}"
                                           class="ani-admin-edit-btn">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.shipping-rates.destroy', $rate) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus tarif ini?');">

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

                                    <div class="ani-admin-shipping-empty">

                                        <div class="ani-admin-shipping-empty-icon">
                                            🚚
                                        </div>

                                        <strong>
                                            Belum Ada Shipping Rate
                                        </strong>

                                        <p>
                                            Belum ada data tarif pengiriman
                                            yang tersedia.
                                        </p>

                                        <a href="{{ route('admin.shipping-rates.create') }}"
                                           class="ani-admin-empty-btn">
                                            + Tambah Tarif
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($shippingRates->hasPages())

                <div class="ani-admin-shipping-footer">

                    <div class="ani-admin-pagination-info">
                        Menampilkan
                        <strong>{{ $shippingRates->firstItem() }}</strong>
                        –
                        <strong>{{ $shippingRates->lastItem() }}</strong>
                        dari
                        <strong>{{ $shippingRates->total() }}</strong>
                        tarif
                    </div>

                    <nav>

                        <ul class="pagination mb-0">

                            @if ($shippingRates->onFirstPage())

                                <li class="page-item disabled">
                                    <span class="page-link">‹</span>
                                </li>

                            @else

                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ $shippingRates->previousPageUrl() }}">
                                        ‹
                                    </a>
                                </li>

                            @endif


                            @foreach ($shippingRates->getUrlRange(1, $shippingRates->lastPage()) as $page => $url)

                                <li class="page-item {{ $page == $shippingRates->currentPage() ? 'active' : '' }}">

                                    <a class="page-link"
                                       href="{{ $url }}">
                                        {{ $page }}
                                    </a>

                                </li>

                            @endforeach


                            @if ($shippingRates->hasMorePages())

                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ $shippingRates->nextPageUrl() }}">
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