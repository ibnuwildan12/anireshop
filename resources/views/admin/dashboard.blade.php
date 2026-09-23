@extends('layouts.app')

@section('title', 'Admin Dashboard - Anireshop')

@section('content')

<div class="ani-admin-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="ani-admin-header">

            <div>

                <span class="ani-admin-eyebrow">
                    ADMIN PANEL
                </span>

                <h1>
                    Dashboard
                </h1>

                <p>
                    Selamat datang kembali,
                    <strong>{{ auth()->user()->name }}</strong>
                </p>

            </div>


            <div class="ani-admin-role">
                <span class="ani-admin-role-icon">
                    ✓
                </span>

                <div>
                    <small>
                        ACCESS LEVEL
                    </small>

                    <strong>
                        Administrator
                    </strong>
                </div>
            </div>

        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="ani-admin-alert">
                <span>✓</span>

                <div>
                    {{ session('success') }}
                </div>
            </div>

        @endif


        {{-- MENU --}}
        <div class="ani-admin-section-heading">

            <div>
                <span>
                    MANAGEMENT
                </span>

                <h2>
                    Kelola Anireshop
                </h2>
            </div>

            <p>
                Pilih menu untuk mengelola sistem toko.
            </p>

        </div>


        <div class="row g-4">


            {{-- PRODUCTS --}}
            <div class="col-md-6 col-lg-4">

                <a
                    href="{{ route('admin.products.index') }}"
                    class="ani-admin-menu-card"
                >

                    <div class="ani-admin-card-top">

                        <div class="ani-admin-icon purple">
                            ◈
                        </div>

                        <span class="ani-admin-arrow">
                            →
                        </span>

                    </div>


                    <div class="ani-admin-card-content">

                        <h3>
                            Products
                        </h3>

                        <p>
                            Kelola produk Anireshop,
                            stok, harga, gambar, dan informasi produk.
                        </p>

                    </div>


                    <div class="ani-admin-card-link">
                        Kelola Produk
                        <span>→</span>
                    </div>

                </a>

            </div>


            {{-- CATEGORIES --}}
            <div class="col-md-6 col-lg-4">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="ani-admin-menu-card"
                >

                    <div class="ani-admin-card-top">

                        <div class="ani-admin-icon pink">
                            ◇
                        </div>

                        <span class="ani-admin-arrow">
                            →
                        </span>

                    </div>


                    <div class="ani-admin-card-content">

                        <h3>
                            Categories
                        </h3>

                        <p>
                            Kelola kategori dan pengelompokan
                            produk Anireshop.
                        </p>

                    </div>


                    <div class="ani-admin-card-link">
                        Kelola Kategori
                        <span>→</span>
                    </div>

                </a>

            </div>


            {{-- ORDERS --}}
            <div class="col-md-6 col-lg-4">

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="ani-admin-menu-card"
                >

                    <div class="ani-admin-card-top">

                        <div class="ani-admin-icon purple">
                            ◎
                        </div>

                        <span class="ani-admin-arrow">
                            →
                        </span>

                    </div>


                    <div class="ani-admin-card-content">

                        <h3>
                            Orders
                        </h3>

                        <p>
                            Kelola pesanan customer,
                            status pesanan, dan pengiriman.
                        </p>

                    </div>


                    <div class="ani-admin-card-link">
                        Kelola Pesanan
                        <span>→</span>
                    </div>

                </a>

            </div>


            {{-- SHIPPING --}}
            <div class="col-md-6 col-lg-4">

                <a
                    href="{{ route('admin.shipping-rates.index') }}"
                    class="ani-admin-menu-card"
                >

                    <div class="ani-admin-card-top">

                        <div class="ani-admin-icon pink">
                            ✦
                        </div>

                        <span class="ani-admin-arrow">
                            →
                        </span>

                    </div>


                    <div class="ani-admin-card-content">

                        <h3>
                            Shipping
                        </h3>

                        <p>
                            Kelola tarif pengiriman
                            berdasarkan wilayah dan kurir.
                        </p>

                    </div>


                    <div class="ani-admin-card-link">
                        Kelola Ongkir
                        <span>→</span>
                    </div>

                </a>

            </div>


            {{-- PAYMENT --}}
            <div class="col-md-6 col-lg-4">

                <a
                    href="{{ route('admin.payments.index') }}"
                    class="ani-admin-menu-card"
                >

                    <div class="ani-admin-card-top">

                        <div class="ani-admin-icon green">
                            ✓
                        </div>

                        <span class="ani-admin-arrow">
                            →
                        </span>

                    </div>


                    <div class="ani-admin-card-content">

                        <h3>
                            Payments
                        </h3>

                        <p>
                            Periksa dan verifikasi
                            pembayaran customer.
                        </p>

                    </div>


                    <div class="ani-admin-card-link">
                        Verifikasi Pembayaran
                        <span>→</span>
                    </div>

                </a>

            </div>

        </div>


        {{-- ADMIN FOOTER --}}
        <div class="ani-admin-bottom">

            <div class="ani-admin-bottom-info">

                <span class="ani-admin-bottom-icon">
                    ⚙
                </span>

                <div>

                    <strong>
                        Anireshop Administration
                    </strong>

                    <small>
                        Gunakan menu di atas untuk mengelola toko.
                    </small>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="ani-admin-logout"
                >
                    Logout Admin
                </button>

            </form>

        </div>

    </div>

</div>

@endsection