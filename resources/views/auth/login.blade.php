@extends('layouts.app')

@section('title', 'Login - Anireshop')

@section('content')

<div class="ani-auth-page">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-5">

                <div class="ani-auth-card">

                    {{-- HEADER --}}
                    <div class="ani-auth-header">

                        <div class="ani-auth-brand">
                            Ani<span>re</span>shop
                        </div>

                        <span class="ani-auth-eyebrow">
                            WELCOME BACK
                        </span>

                        <h1>
                            Login ke Anireshop
                        </h1>

                        <p>
                            Login untuk melanjutkan belanja
                            merchandise favoritmu.
                        </p>

                    </div>


                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="ani-auth-success">

                            <div class="ani-auth-success-icon">
                                ✓
                            </div>

                            <div>
                                <strong>Berhasil</strong>

                                <p>
                                    {{ session('success') }}
                                </p>
                            </div>

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if($errors->any())

                        <div class="ani-auth-alert">

                            <div class="ani-auth-alert-icon">
                                !
                            </div>

                            <div>

                                <strong>
                                    Login gagal
                                </strong>

                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="ani-auth-form"
                    >

                        @csrf

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
                                autofocus
                            >

                        </div>


                        {{-- PASSWORD --}}
                        <div class="ani-auth-field last">

                            <label for="password">
                                Password
                                <span>*</span>
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                autocomplete="current-password"
                                required
                            >

                        </div>


                        {{-- LOGIN BUTTON --}}
                        <button
                            type="submit"
                            class="ani-auth-submit"
                        >

                            <span>
                                Login
                            </span>

                            <strong>
                                →
                            </strong>

                        </button>

                    </form>


                    {{-- REGISTER --}}
                    <div class="ani-auth-login">

                        <span>
                            Belum punya akun?
                        </span>

                        <a href="{{ route('register') }}">
                            Daftar
                        </a>

                    </div>


                    {{-- FOOTNOTE --}}
                    <div class="ani-auth-footnote">
                        Login untuk mengakses akun,
                        checkout, dan melihat pesanan Anireshop.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection