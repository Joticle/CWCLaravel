@extends('layouts.app')

@section('content')
    @include('common.profile-header')
    <div class="dashboard--area-main pt--100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3">
                    @include('dashboard.left-menu')
                </div>
                <div class="col-lg-9">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
    <div class="rts-section-gap"></div>
@endsection
