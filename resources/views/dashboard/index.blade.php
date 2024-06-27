@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="right-sidebar-dashboard">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-light fa-book-open-cover"></i>
                    </div>
                    <h5 class="title"><span class="counter">{{ $enrolledCount }}</span></h5>
                    <p>Enrolled {{ Str::plural('Course', $enrolledCount) }}</p>
                </div>
                <!-- single dashboard-card end -->
            </div>
            {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-regular fa-graduation-cap"></i>
                    </div>
                    <h5 class="title"><span class="counter">10</span></h5>
                    <p>Active Courses</p>
                </div>
                <!-- single dashboard-card end -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <!-- single dashboard-card -->
                <div class="single-dashboard-card">
                    <div class="icon">
                        <i class="fa-light fa-trophy"></i>
                    </div>
                    <h5 class="title"><span class="counter">36</span></h5>
                    <p>Completed Courses</p>
                </div>
                <!-- single dashboard-card end -->
            </div> --}}

        </div>

    </div>
@endsection
