@extends('layouts.app')
@section('title',$title)
@section('content')
    {{-- bread crumb area --}}
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Course</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            @foreach($breadcrumb as $bTile=>$bLink)
                                <a href="{{!empty($bLink)?$bLink:'#'}}">{{$bTile}}</a>
                                @if(!empty($bLink))
                                    <i class="fa-regular fa-chevron-right"></i>
                                @endif
                            @endforeach
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- bread crumb area end--}}
    <!-- course area start -->
    <div class="rts-course-default-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3">
                    <!-- course-filter-area start -->
                    <div class="rts-course-filter-area">
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Search</h6>
                            <div class="search-filter filter-body">
                                <div class="input-wrapper">
                                    <input type="text" placeholder="Search Course...">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Type</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="type-1">
                                            <label for="type-1">Course</label><br>
                                        </div>
                                        <span class="number">(20,000)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="type-2">
                                            <label for="type-2">Bundle</label><br>
                                        </div>
                                        <span class="number">(20,000)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Category</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-1">
                                            <label for="category-1">Web Development</label><br>
                                        </div>
                                        <span class="number">(130)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-2">
                                            <label for="category-2">Film & Video</label><br>
                                        </div>
                                        <span class="number">(85)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-3">
                                            <label for="category-3">Illustration</label><br>
                                        </div>
                                        <span class="number">(210)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-4">
                                            <label for="category-4">Music & Art</label><br>
                                        </div>
                                        <span class="number">(45)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-5">
                                            <label for="category-5">Photography</label><br>
                                        </div>
                                        <span class="number">(35)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-6">
                                            <label for="category-6">Business & Marketing</label><br>
                                        </div>
                                        <span class="number">(66)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-7">
                                            <label for="category-7">Design & UI/UX</label><br>
                                        </div>
                                        <span class="number">(95)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="category-8">
                                            <label for="category-8">Web Design</label><br>
                                        </div>
                                        <span class="number">(150)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Level</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="lavel-1">
                                            <label for="lavel-1">All Levels</label><br>
                                        </div>
                                        <span class="number">(130)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="lavel-2">
                                            <label for="lavel-2">Beginner</label><br>
                                        </div>
                                        <span class="number">(85)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="lavel-3">
                                            <label for="lavel-3">Intermediate</label><br>
                                        </div>
                                        <span class="number">(210)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="lavel-4">
                                            <label for="lavel-4">Expert</label><br>
                                        </div>
                                        <span class="number">(45)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Author</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="author-1">
                                            <label for="author-1">Admin</label><br>
                                        </div>
                                        <span class="number">(130)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="author-2">
                                            <label for="author-2">Sean Kaye</label><br>
                                        </div>
                                        <span class="number">(85)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="author-3">
                                            <label for="author-3">David Travis</label><br>
                                        </div>
                                        <span class="number">(210)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="author-4">
                                            <label for="author-4">Dr. Angela Yu</label><br>
                                        </div>
                                        <span class="number">(45)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Tage</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="Tage-1">
                                            <label for="Tage-1">Course</label><br>
                                        </div>
                                        <span class="number">(10)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="Tage-2">
                                            <label for="Tage-2">Education</label><br>
                                        </div>
                                        <span class="number">(85)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="Tage-3">
                                            <label for="Tage-3">LMS</label><br>
                                        </div>
                                        <span class="number">(21)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Price</h6>
                            <div class="checkbox-filter filter-body last">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="price-1">
                                            <label for="price-1">Free</label><br>
                                        </div>
                                        <span class="number">(6)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="price-2">
                                            <label for="price-2">Paid</label><br>
                                        </div>
                                        <span class="number">(80)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <a href="#" class="rts-btn btn-border"><i class="fa-regular fa-x"></i> Clear All Filters</a>
                    </div>
                    <!-- course-filter-area end -->
                </div>
                <div class="col-lg-9">
                    <div class="row g-5 mt--10">
                        @foreach($courses as $course)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="rts-single-course">
                                    <a href="{{$course->getLink()}}" class="thumbnail">
                                        <img src="{{$course->getLogo()}}" alt="course">
                                    </a>
                                    <div class="save-icon">
                                        <i class="fa-sharp fa-light fa-bookmark"></i>
                                    </div>
                                    <div class="tags-area-wrapper">
                                        <div class="single-tag">
                                            <span>{{printPrice($course->price)}}</span>
                                        </div>
                                    </div>
                                    <div class="lesson-studente">
                                        <div class="lesson">
                                            <i class="fa-light fa-calendar-lines-pen"></i>
                                            <span>{{$course->modules_count}} Lessons</span>
                                        </div>
                                        <div class="lesson">
                                            <i class="fa-light fa-user-group"></i>
                                            <span>0 Students</span>
                                        </div>
                                    </div>
                                    <a href="{{$course->getLink()}}">
                                        <h5 class="title">{{$course->name}}</h5>
                                    </a>
                                    {{--<p class="teacher">Dr. Angela Yu</p>--}}
                                    <div class="rating-and-price">
                                        <a href="{{$course->getLink()}}" class="rts-btn btn-border">Detail</a>
                                        <a href="#" class="rts-btn btn-primary">Enroll</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt--30">
                        <div class="col-lg-12">
                            <!-- rts-pagination-area -->
                            <div class="rts-pagination-area-2">
                                {{$courses->links()}}
                                @include('includes.paginator-counter',['data'=>$courses])
                            </div>
                            <!-- rts-pagination-area end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->
@endsection
