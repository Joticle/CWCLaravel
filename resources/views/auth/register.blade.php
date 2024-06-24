@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-md-6">
                <div class="login-page-form-area">
                    <h4 class="title">Sign Up to Your Account👋</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="single-input-wrapper">
                            <label for="name">Your Name*</label>
                            <input id="name" type="text" placeholder="Enter Your Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                              <span class="invalid-feedback" role="alert"><i>{{ $message }}</i></span>
                            @enderror
                        </div>
                        <div class="single-input-wrapper">
                            <div class="single-input-wrapper">
                                <label for="email">Email*</label>
                                <input id="email" type="email" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                  <span class="invalid-feedback" role="alert"><i>{{ $message }}</i></span>
                                @enderror
                            </div>
                        </div>
                        <div class="single-input-wrapper">
                            <div class="single-input-wrapper">
                                <label for="password">Your Password</label>
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                  <span class="invalid-feedback" role="alert"><i>{{ $message }}</i></span>
                                @enderror
                            </div>
                        </div>
                        <div class="single-input-wrapper">
                            <div class="single-input-wrapper">
                                <label for="passwords">Re Password</label>
                                <input id="password-confirm" type="password" placeholder="Re Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="single-checkbox-filter">
                            <div class="check-box">
                                <input type="checkbox" name="accept_terms" id="accept_terms" required>
                                <label for="accept_terms">Accept the Terms and Privacy Policy</label><br>
                            </div>
                        </div>
                        <button type="submit" class="rts-btn btn-primary">Signup</button>
                        <p>Already Have an account? <a href="{{route('login')}}">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
