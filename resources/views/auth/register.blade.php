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
                                Welcome To CTG Coaching
                            </p>
                        </div>
                        <div class="row mt-3">                    
                            <div class="col-12 logo-container d-flex justify-content-center">
                    <div class="svg">
                        <img src="{{ asset('images/svg/signup.svg') }}" alt="login svg">
                    </div>
                                
                            </div>
                        </div>
                    </div>
                </section>
            
       
            <section class="col-md-6" id="panel-right">
                <div class="container">
                    <div class="row mb-5 mt-4">
                        <h2 class="col-12 text-center">Registration here</h2>
                    </div>
                    <div class="row">                    
                        <form method="POST" action="{{ route('register') }}" class="col-12 col-md-8 offset-md-2">
                        @csrf


                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"  autocomplete="new-password">
                                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                              
                            </div>

                            <div class="form-group text-center pt-2">
                                <input type="submit" class="btn signupSigninButton" value="Register">
                                
                            </div>

                        </form>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 links text-center">
                            @if (Route::has('register'))
                                    <p class="dark">If you have account <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('Login') }}
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
