@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-md-6">
                <div class="login-page-form-area">
                    <h4 class="title">Login to Your Account👋</h4>
                    <form method="POST" action="{{ route('login') }}" onsubmit="showLoader()">
                        @csrf
                        <div class="single-input-wrapper">
                            <label for="email">Your Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required autocomplete="email" autofocus>
                            @error('email')
                              <span class="invalid-field" role="alert"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="single-input-wrapper">
                            <label for="password">Your Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                              <span class="invalid-field" role="alert"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="single-checkbox-filter">
                            <div class="check-box">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember Me</label><br>
                            </div>
                        </div>
                        <button type="submit" class="rts-btn btn-primary">Login</button>
                        {{--<div class="google-apple-wrapper">
                            <div class="google">
                                <img src="{{asset('site-assets/images/contact/06.png')}}" alt="contact">
                            </div>
                            <div class="google">
                                <img src="{{asset('site-assets/images/contact/07.png')}}" alt="contact">
                            </div>
                        </div>--}}
                        <p>Don't Have an account? <a href="{{route("register")}}">Registration</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-level-script')
@endsection
