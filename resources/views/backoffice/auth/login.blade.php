@extends('backoffice.layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="authincation h-100 mt-3">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <span class="deznav-scroll"></span>
                    <h1 class="mb-3 text-center"><img src="{!! asset('/images/sidelogo.png') !!}" alt="logo"></h1>
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">

                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form method="POST" action="{{ route('login') }}" onsubmit="showLoader()">
                                        <input type="hidden" name="role" value="admin">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>{{ __('Email Address') }}</strong></label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-field" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-field" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox ml-1">
                                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backoffice.includes.scripts')
@endsection

@section('page-level-script')
@endsection
