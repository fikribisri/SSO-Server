@extends('layouts.login')

@section('content')
@php
$app = \App\Models\Settings::first();
@endphp
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-user"></i>
                            </span>
                        </div>
                        <input placeholder="Username / Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4" type="button">{{ __('Login') }}</button>
                        </div>
                        <div class="col-6 text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                </form>

                </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                <div class="card-body text-center">
                    {{-- <div>
                        <h2>{{@$app->name}}</h2>
                        <p>{{@$app->description}}</p>
                    </div> --}}
                    <div class="img-logo">
                        <img src="{{ asset('img/logo.png') }}" height="100px" alt="{{@$app->name}}">
                    </div>
                    <div class="login-title mt-2 mb-2">
                        <b>Single Sign-on Server{{--@$app->name--}}</b>
                    </div>
                    <div class="login-title-desc">Login once for accessing all apps.{{--@$app->description--}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    body.login-container {
        background: url({{ asset('img/bg.jpeg') }}) no-repeat center center fixed #1b1e24;
        background-size: cover;
    }
</style>
@endsection
