@extends('layouts.app')

@section('content')
    @include('common.profile-header')

    <div class="dashboard--area-main pt--100">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3">
                    <div class="left-sindebar-dashboard">
                        <div class="dashboard-left-single-wrapper">

                            <a href="{{ route('dashboard.index') }}"
                                class="single-item @if (request()->route()->getName() == 'dashboard.index') active @endif">
                                <i class="fa-light fa-house"></i>
                                <p>Dashboard</p>
                            </a>

                            <a href="{{ route('dashboard.profile') }}" class="single-item @if (request()->route()->getName() == 'dashboard.profile') active @endif">
                                <i class="fa-regular fa-user"></i>
                                <p>My Profile</p>
                            </a>

                            <a href="{{ route('dashboard.enrolled-course') }}" class="single-item @if (request()->route()->getName() == 'dashboard.enrolled-course') active @endif">
                                <i class="fa-light fa-graduation-cap"></i>
                                <p>Enrolled Courses</p>
                            </a>

                            <a href="{{ route('dashboard.profile') }}" class="single-item @if (request()->route()->getName() == 'dashboard.profile') active @endif">
                                <i class="fa-sharp fa-light fa-bookmark"></i>
                                <p>Wishlist</p>
                            </a>


                            <a href="{{ route('dashboard.profile') }}" class="single-item @if (request()->route()->getName() == 'dashboard.profile') active @endif">
                                <i class="fa-sharp fa-light fa-bag-shopping"></i>
                                <p>Order History</p>
                            </a>

                        </div>
                        <div class="dashboard-left-single-wrapper bbnone mt--40">
                            <h4 class="title mb--5">User</h4>

                            <a href="{{ route('dashboard.profile') }}" class="single-item @if (request()->route()->getName() == 'dashboard.profile') active @endif">
                                <i class="fa-sharp fa-regular fa-gear"></i>
                                <p>Settings</p>
                            </a>

                            <a href="{{ route('logout') }}" class="single-item">
                                <i class="fa-light fa-right-from-bracket"></i>
                                <p>Logout</p>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    @yield('sub-content')
                </div>
            </div>
        </div>
    </div>
    <div class="rts-section-gap">
    @endsection
