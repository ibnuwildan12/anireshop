@extends('layouts.app')

@section('title', 'Admin Dashboard - Anireshop')

@section('content')

<div class="admin-page">

    {{-- HEADER --}}

    <div class="container">

        <div class="admin-header">

            <div>

                <div class="admin-label">
                    ADMIN PANEL
                </div>

                <h1>
                    Dashboard
                </h1>

                <p>
                    Selamat datang, {{ auth()->user()->name }}
                </p>

            </div>

            <div>

                <span class="admin-badge">
                    Administrator
                </span>

            </div>

        </div>


        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- MENU --}}

        <div class="row g-4 mt-2">


            {{-- PRODUCTS --}}

            <div class="col-md-6 col-lg-3">

                <a
                    href="#"
                    class="admin-menu-card"
                >

                    <div class="admin-icon purple">
                        ◈
                    </div>

                    <h4>
                        Products
                    </h4>

                    <p>
                        Kelola produk Anireshop
                    </p>

                    <span class="admin-card-link">
                        Kelola Produk →
                    </span>

                </a>

            </div>


            {{-- CATEGORIES --}}

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="admin-menu-card"
                >

                    <div class="admin-icon pink">
                        ◇
                    </div>

                    <h4>
                        Categories
                    </h4>

                    <p>
                        Kelola kategori produk
                    </p>

                    <span class="admin-card-link">
                        Kelola Kategori →
                    </span>

                </a>

            </div>


            {{-- ORDERS --}}

            <div class="col-md-6 col-lg-3">

                <a
                    href="#"
                    class="admin-menu-card"
                >

                    <div class="admin-icon purple">
                        ◎
                    </div>

                    <h4>
                        Orders
                    </h4>

                    <p>
                        Kelola pesanan customer
                    </p>

                    <span class="admin-card-link">
                        Kelola Pesanan →
                    </span>

                </a>

            </div>


            {{-- SHIPPING --}}

            <div class="col-md-6 col-lg-3">

                <a
                    href="#"
                    class="admin-menu-card"
                >

                    <div class="admin-icon pink">
                        ✦
                    </div>

                    <h4>
                        Shipping
                    </h4>

                    <p>
                        Kelola tarif pengiriman
                    </p>

                    <span class="admin-card-link">
                        Kelola Ongkir →
                    </span>

                </a>

            </div>


            {{-- PAYMENT --}}

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('admin.payments.index') }}"
                    class="admin-menu-card"
                >

                    <div class="admin-icon pink">
                        ✓
                    </div>

                    <h4>
                        Payments
                    </h4>

                    <p>
                        Verifikasi pembayaran customer
                    </p>

                    <span class="admin-card-link">
                        Verifikasi →
                    </span>

                </a>

            </div>

        </div>


        {{-- LOGOUT --}}

        <div class="admin-bottom">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-outline-danger"
                >
                    Logout Admin
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
