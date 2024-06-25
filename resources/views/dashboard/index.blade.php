@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="right-sidebar-dashboard">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-sharp fa-light fa-book-open-cover"></i>
                    </div>
                    <h5 class="title"><span class="counter">{{ $courseEnrolled->count() }}</span></h5>
                    <p>Enrolled {{ Str::plural('Course', $courseEnrolled->count()) }}</p>
                </div>
                <!-- single dashboard-card end -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-sharp fa-light fa-bookmark"></i>
                    </div>
                    <h5 class="title"><span class="counter">0</span></h5>
                    <p>Wishlist</p>
                </div>
                <!-- single dashboard-card end -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-sharp fa-light fa-bag-shopping"></i>
                    </div>
                    <h5 class="title"><span class="counter">{{ $user->courseOrders->count() }}</span></h5>
                    <p>Total Orders</p>
                </div>
                <!-- single dashboard-card end -->
            </div>
        </div>
    </div>
@endsection
