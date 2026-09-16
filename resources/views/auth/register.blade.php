@extends('layouts.app')

@section('title', 'Register - Anireshop')

@section('content')

<div class="auth-page">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-5">

                <div class="auth-card">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">

                        <div class="auth-brand">
                            Ani<span>re</span>shop
                        </div>

                        <h2 class="fw-bold mt-3">
                            Daftar Anireshop
                        </h2>

                        <p class="auth-subtitle">
                            Buat akun untuk mulai belanja di Anireshop.
                        </p>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form
                        method="POST"
                        action="{{ route('register') }}"
                    >

                        @csrf


                        {{-- NAMA --}}
                        <div class="mb-3">

                            <label
                                for="name"
                                class="form-label"
                            >
                                Nama
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama kamu"
                                required
                            >

                        </div>


                        {{-- WHATSAPP --}}
                        <div class="mb-3">

                            <label
                                for="whatsapp"
                                class="form-label"
                            >
                                WhatsApp
                            </label>

                            <input
                                type="text"
                                id="whatsapp"
                                name="whatsapp"
                                class="form-control"
                                value="{{ old('whatsapp') }}"
                                placeholder="081234567890"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required
                            >

                        </div>


                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 8 karakter"
                                required
                            >

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password"
                                required
                            >

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="btn btn-ani w-100"
                        >
                            Daftar
                        </button>

                    </form>


                    {{-- LOGIN --}}
                    <div class="text-center mt-4">

                        <span style="color:#999;">
                            Sudah punya akun?
                        </span>

                        <a
                            href="{{ route('login') }}"
                            style="color:#ec4899; font-weight:700;"
                        >
                            Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection