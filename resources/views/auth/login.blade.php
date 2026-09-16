@extends('layouts.app')

@section('title', 'Login - Anireshop')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-logo">
            Ani<span>re</span>shop
        </div>

        <h2 class="auth-title">
            Welcome Back!
        </h2>

        <p class="auth-subtitle">
            Login untuk melanjutkan ke Anireshop
        </p>


        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('login') }}"
        >

            @csrf


            <div class="mb-3">

                <label class="auth-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control auth-input"
                    placeholder="Masukkan email"
                    required
                >

            </div>


            <div class="mb-4">

                <label class="auth-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control auth-input"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn auth-button w-100"
            >
                Login
            </button>

        </form>


        <div class="auth-footer">

            Belum punya akun?

            <a href="{{ route('register') }}">
                Register
            </a>

        </div>

    </div>

</div>

@endsection