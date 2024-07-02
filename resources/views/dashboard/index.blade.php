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
        <div class="row mt--40">
            <div class="col-lg-12">
                <!-- in progress course area -->
                <div class="in-progress-course-wrapper  title-between-dashboard mb--10">
                    <h5 class="title">My Courses</h5>
                    <a href="{{route('dashboard.my.courses')}}" class="more">View All</a>
                </div>
                <!-- in progress course area end -->

                <!-- my course enroll wrapper -->
                <div class="my-course-enroll">
                    <div class="row g-5 mt--10">
                        @foreach($courseEnrolled->take(3) as $course)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                @include('includes.course-card',['course'=>$course->course,'dashboard'=>true])
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- my course enroll wrapper end -->
            </div>
        </div>
    </div>
@endsection
