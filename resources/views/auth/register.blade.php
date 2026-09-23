@extends('layouts.app')

@section('title', 'Register - Anireshop')

@section('content')

<div class="ani-auth-page">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-5">

                <div class="ani-auth-card">

                    {{-- BRAND --}}
                    <div class="ani-auth-header">

                        <div class="ani-auth-brand">
                            Ani<span>re</span>shop
                        </div>

                        <span class="ani-auth-eyebrow">
                            CREATE ACCOUNT
                        </span>

                        <h1>
                            Daftar di Anireshop
                        </h1>

                        <p>
                            Buat akun untuk mulai belanja
                            merchandise favoritmu.
                        </p>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="ani-auth-alert">

                            <div class="ani-auth-alert-icon">
                                !
                            </div>

                            <div>

                                <strong>
                                    Periksa kembali data kamu
                                </strong>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form
                        method="POST"
                        action="{{ route('register') }}"
                        class="ani-auth-form"
                    >

                        @csrf


                        {{-- NAMA --}}
                        <div class="ani-auth-field">

                            <label for="name">
                                Nama
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama kamu"
                                autocomplete="name"
                                required
                            >

                        </div>


                        {{-- WHATSAPP --}}
                        <div class="ani-auth-field">

                            <label for="whatsapp">
                                WhatsApp
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="whatsapp"
                                name="whatsapp"
                                value="{{ old('whatsapp') }}"
                                placeholder="081234567890"
                                autocomplete="tel"
                                required
                            >

                            <small>
                                Gunakan nomor WhatsApp yang aktif.
                            </small>

                        </div>


                        {{-- EMAIL --}}
                        <div class="ani-auth-field">

                            <label for="email">
                                Email
                                <span>*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                autocomplete="email"
                                required
                            >

                        </div>


                        {{-- PASSWORD --}}
                        <div class="ani-auth-field">

                            <label for="password">
                                Password
                                <span>*</span>
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        {{-- CONFIRM PASSWORD --}}
                        <div class="ani-auth-field last">

                            <label for="password_confirmation">
                                Konfirmasi Password
                                <span>*</span>
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="ani-auth-submit"
                        >
                            <span>
                                Buat Akun
                            </span>

                            <strong>
                                →
                            </strong>
                        </button>

                    </form>


                    {{-- LOGIN --}}
                    <div class="ani-auth-login">

                        <span>
                            Sudah punya akun?
                        </span>

                        <a href="{{ route('login') }}">
                            Login
                        </a>

                    </div>


                    {{-- FOOTNOTE --}}
                    <div class="ani-auth-footnote">
                        Dengan membuat akun, kamu dapat
                        melanjutkan proses checkout dan melihat
                        pesanan Anireshop.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection