@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="right-sidebar-dashboard">
        <div class="row g-5">
            <div class="col-lg-12">
                <!-- in progress course area -->
                <div class="in-progress-course-wrapper  title-between-dashboard mb--10">
                    <h5 class="title">Enrolled Courses</h5>
                </div>
                <!-- in progress course area end -->

                <!-- my course enroll wrapper -->
                <div class="my-course-enroll">
                    <div class="row g-5 mt--10">
                        @foreach($courseEnrolled as $course)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                @include('includes.course-card',['course'=>$course->course,'dashboard'=>true])
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt--30">
                        <div class="col-lg-12">
                            <!-- rts-pagination-area -->
                            <div class="rts-pagination-area-2">
                                {{$courseEnrolled->links()}}
                                @include('includes.paginator-counter',['data'=>$courseEnrolled])
                            </div>
                            <!-- rts-pagination-area end -->
                        </div>
                    </div>
                </div>
                <!-- my course enroll wrapper end -->
            </div>
        </div>
    </div>
@endsection
