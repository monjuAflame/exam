@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">

        <section class="col-md-6" id="panel-left">
            <div class="container align-self-center">
                <div class="row">
                    <!-- <h1 class="col-12 text-center mt-3">Welcome</h1> -->
                </div>
                <div class="row">
                    <p class="col-12 text-center description mt-5">
                        Welcome To <br /> <b>{{ env('APP_NAME') }}</b>
                    </p>
                </div>
                <div class="row mt-3">
                    <div class="col-12 logo-container d-flex justify-content-center">
                        <div class="svg">
                            <img src="{{ asset(env('LOGO_NAME')) }}" alt="login svg">
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <section class="col-md-6" id="panel-right">
            <div class="container">
                <div class="row mb-5 mt-4">
                    <h2 class="col-12 text-center">Login here</h2>
                </div>
                <div class="row">
                    <form class="col-12 col-md-8 offset-md-2" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center pt-2">
                            <input type="submit" class="btn signupSigninButton" value="Login">

                        </div>

                    </form>
                </div>
                <div class="row mt-2">
                    <div class="col-12 links text-center">
                        {{--@if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif--}}
                        @if (Route::has('login'))
                        <p class="dark">If don't you have account <a class="btn btn-link"
                                href="{{ route('register') }}">
                                {{ __('Registration') }}
                            </a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@endsection