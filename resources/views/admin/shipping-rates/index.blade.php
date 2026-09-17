@extends('layouts.app')

@section('title', 'Shipping Rates - Anireshop')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Shipping Rates</h2>
            <p class="text-secondary mb-0">
                Kelola tarif pengiriman Anireshop
            </p>
        </div>

        <a href="{{ route('admin.shipping-rates.create') }}"
           class="btn btn-ani">
            + Tambah Tarif
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card bg-dark border-secondary shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Courier</th>
                            <th>Kabupaten/Kota</th>
                            <th>Biaya</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($shippingRates as $rate)
                            <tr>
                                <td>
                                    {{ $shippingRates->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $rate->courier }}
                                    </span>
                                </td>

                                <td>
                                    {{ $rate->city }}
                                </td>

                                <td>
                                    Rp {{ number_format($rate->cost, 0, ',', '.') }}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('admin.shipping-rates.edit', $rate) }}"
                                           class="btn btn-sm btn-outline-light">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.shipping-rates.destroy', $rate) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus tarif ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center text-secondary py-4">
                                    Belum ada data shipping rate.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if($shippingRates->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    <nav>
                        <ul class="pagination pagination-sm mb-0">

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
                                    <a class="page-link" href="{{ $url }}">
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