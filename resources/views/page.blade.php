@extends('layouts.app')
@section('title', $row->name)

@section('content')

    <!-- course details breadcrumb -->
    <div class="course-details-breadcrumb-1 bg_image rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-course-left-align-wrapper">
                        <div class="meta-area">
                            @foreach ($breadcrumb as $bTile => $bLink)
                                <a href="{{ !empty($bLink) ? $bLink : '#' }}"
                                   class="{{ !empty($bLink) ? '' : 'active' }}">{{ $bTile }}</a>
                                @if (!empty($bLink))
                                    <i class="fa-regular fa-chevron-right"></i>
                                @endif
                            @endforeach
                        </div>
                        <h1 class="title">
                            {{ $course->name }}
                        </h1>
                        <div class="rating-area">
                            {{-- <div class="stars-area">
                                <span>4.5</span>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div> --}}
                            <div class="students">
                                <i class="fa-thin fa-users"></i>
                                <span>{{ $course->modules_count }}
                                    {{ Str::plural('Lesson', $course->modules_count) }}</span>
                            </div>
                            <div class="calender-area-stars">
                                <i class="fa-light fa-calendar-lines-pen"></i>
                                <span>Last updated {{ _date($course->updated_at) }}</span>
                            </div>
                        </div>
                        {{-- <div class="author-area">
                            <div class="author">
                                <img src="assets/images/breadcrumb/01.png" alt="breadcrumb">
                                <h6 class="name"><span>By</span> William U.</h6>
                            </div>
                            <p> <span>Categories: </span> Web Developments</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course details breadcrumb end -->

    <div class="rts-course-area pt-5">


        <div class="container">
            <div class="d-flex justify-content-center">
                <h1 class="title">{{ $row->name }}</h1>
            </div>
            <div class="pb--50">
                {!! $row->content !!}
            </div>
        </div>
    </div>
@endsection
