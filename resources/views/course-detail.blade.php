@extends('layouts.app')
@section('title', $title)
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


    <!-- course details area start -->
    <div class="rts-course-area pt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8 order-cl-1 order-lg-1 order-md-2 order-sm-2 order-2">
                    <div class="course-details-btn-wrapper pb--50">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#course-details" type="button" role="tab"
                                        aria-controls="course-details" aria-selected="true">Course Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="course-content-tab" data-bs-toggle="tab"
                                        data-bs-target="#course-content" type="button" role="tab"
                                        aria-controls="course-content" aria-selected="false">Course Content</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                        type="button" role="tab" aria-controls="reviews"
                                        aria-selected="false">Review</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content mt--50" id="myTabContent">
                        <div class="tab-pane fade  show active" id="course-details" role="tabpanel"
                             aria-labelledby="course-details-tab">
                            <div class="course-content-wrapper">
                                <div style="max-height: 1000px; overflow-y: scroll;">
                                    {!! $course->description !!}
                                </div>
                                <div class="module-wrapper mb--30">
                                    <h6 class="title">What Will You Learn?</h6>

                                    <div class="row">
                                        @foreach ($course->modules as $course_module)
                                            <div class="col-md-4">
                                                <i class="fa-regular fa-check text-primary"></i> {{ $course_module->name }}
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="course-content" role="tabpanel" aria-labelledby="course-content-tab">
                            <div class="course-content-wrapper-main">
                                <h5 class="title">Course Content</h5>

                                <!-- course content accordion area -->
                                <div class="accordion mt--30" id="accordionExample">
                                    @foreach ($course->modules as $key => $course_module)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseModule-{{ $course_module->id }}"
                                                        aria-expanded="true"
                                                        aria-controls="collapseModule-{{ $course_module->id }}">
                                                    <span>{{ $course_module->name }}</span>
                                                    <span>{{ $course_module->contents->count() }}
                                                        {{ Str::plural('Lecture', $course_module->contents->count()) }}</span>
                                                </button>
                                            </h2>
                                            <div id="collapseModule-{{ $course_module->id }}"
                                                 class="accordion-collapse collapse {{ !$key ? 'show' : '' }}"
                                                 aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <!-- play single area start -->
                                                    <div class="p-3">
                                                        {!! $course_module->description !!}
                                                    </div>
                                                    @foreach ($course_module->contents as $key_content => $course_content)
                                                        @php
                                                            $content_list = App\Models\ContentType::CONTENTLIST;
                                                            $content_icon =
                                                                $content_list[
                                                                    $contentTypes[$course_content->content_type_id]
                                                                ]['icon'] ?? '';
                                                            // dd($course_content->contentType);
                                                        @endphp

                                                        <div class="play-vedio-wrapper">
                                                            <div class="left">
                                                                <i class="fa-light {{ $content_icon }}"></i>
                                                                <span>{{ $course_content->name }}</span>
                                                            </div>
                                                            <div class="right">
                                                                @if ($course->is_enrolled)
                                                                    <a href="{{ $course_content->preview_link }}"
                                                                       @if (in_array($course_content->contentType->type, ['link', 'file', 'image'])) target="_blank" @endif
                                                                       @if (in_array($course_content->contentType->type, ['paragraph', 'embedded-video'])) data-content-id="{{ $course_content->id }}" data-bs-toggle="modal" data-bs-target="#contentModal" @endif>
                                                                        Preview
                                                                    </a>
                                                                @else
                                                                    <i class="fa-regular fa-lock"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                @endforeach
                                                <!-- play single area end -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- {{dd($course->modules[1]->contents)}} --}}
                                </div>
                                <!-- course content accordion area end -->
                            </div>
                        </div>
                        <div class="tab-pane fade " id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="rating-main-wrapper">
                                <!-- single-top-rating -->
                                <div class="rating-top-main-wrapper">
                                    Coming Soon!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-cl-2 order-lg-2 order-md-1 order-sm-1 order-1  {{-- rts-sticky-column-item --}}">
                    <!-- right- sticky bar area -->
                    <div class="right-course-details">
                        <!-- single course-sidebar -->
                        <div class="course-side-bar">
                            <div class="thumbnail text-center">
                                <img src="{{ $course->getLogo() }}" alt="">
                            </div>

                            {{-- <div class="clock-area">
                                <i class="fa-light fa-clock"></i>
                                <span>2 Day left at this price!</span>
                            </div> --}}
                            @if ($course->is_enrolled)
                                <a href="javascript:void(0)" class="rts-btn btn-success text-white"><i
                                            class="fa fa-check"></i>
                                    Enrolled</a>
                            @else
                                <div class="price-area">
                                    <h3 class="title">{{ printPrice($course->price) }}</h3>
                                    @if (empty($course->price))
                                        <span class="discount">100%</span>
                                    @endif
                                </div>
                                <a href="{{ route('course.enroll', $course->slug) }}" class="rts-btn btn-primary">Enroll
                                    Now</a>
                            @endif

                            <div class="what-includes">
                                @if (!$course->is_enrolled && !empty($course->price))
                                    <span class="m">Money-Back Guarantee</span>
                                @endif
                                {{-- <h5 class="title">This course includes: </h5> --}}
                                <div class="single-include">
                                    <div class="left">
                                        <i class="fa-light fa-chart-bar"></i>
                                        <span>Levels</span>
                                    </div>
                                    <div class="right">
                                        <span>Beginner</span>
                                    </div>
                                </div>
                                <div class="single-include">
                                    <div class="left">
                                        <i class="fa-light fa-timer"></i>
                                        <span>Duration</span>
                                    </div>
                                    <div class="right">
                                        <span>{{ $course->duration }}</span>
                                    </div>
                                </div>
                                <div class="single-include">
                                    <div class="left">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>Created</span>
                                    </div>
                                    <div class="right">
                                        <span>{{ _date($course->created_at) }}</span>
                                    </div>
                                </div>
                                <div class="single-include">
                                    <div class="left">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span>Update</span>
                                    </div>
                                    <div class="right">
                                        <span>{{ _date($course->updated_at) }}</span>
                                    </div>
                                </div>
                                @if ($course->certificate_issued)
                                    <div class="single-include">
                                        <div class="left">
                                            <i class="fa-sharp fa-light fa-file-certificate"></i>
                                            <span>Certificate</span>
                                        </div>
                                        <div class="right">
                                            <span>Certificate of completion</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- single course-sidebar end -->
                    </div>
                    <!-- right- sticky bar area end -->
                    <!-- right- sticky bar area -->
                    <div class="right-course-details mt--30 mb--30">
                        <!-- single course-sidebar -->
                        <div class="course-side-bar">
                            <!-- course single sidebar -->
                        {{-- <div class="course-single-information">
                            <h5 class="title">Material Includes</h5>
                            <div class="body">
                                <!-- ingle check -->
                                <div class="single-check">
                                    <i class="fa-light fa-circle-check"></i>
                                    Flexible Deadlines
                                </div>
                                <!-- ingle check end -->
                                <!-- ingle check -->
                                <div class="single-check">
                                    <i class="fa-light fa-circle-check"></i>
                                    Hours of live- demo
                                </div>
                                <!-- ingle check end -->
                                <!-- ingle check -->
                                <div class="single-check">
                                    <i class="fa-light fa-circle-check"></i>
                                    Hours of live- demo
                                </div>
                                <!-- ingle check end -->
                                <!-- ingle check -->
                                <div class="single-check">
                                    <i class="fa-light fa-circle-check"></i>
                                    200+ downloadable resoursces
                                </div>
                                <!-- ingle check end -->
                            </div>
                        </div> --}}
                        <!-- course single sidebar end-->
                            <!-- course single sidebar -->
                            @if (Count($course->requirements) > 0)
                                <div class="course-single-information">
                                    <h5 class="title">Requirements</h5>
                                    <div class="body">
                                        <!-- ingle check -->
                                        @foreach ($course->requirements as $requirement)
                                            <div class="single-check">
                                                <i class="fa-light fa-circle-check"></i>
                                                {{ $requirement->text }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        <!-- course single sidebar end-->
                            <!-- course single sidebar -->
                            @if ($course->formatTags)
                                <div class="course-single-information">
                                    <h5 class="title">Tags</h5>
                                    <div class="body">
                                        <div class="tags-wrapper">
                                            @foreach ($course->formatTags as $tag)
                                                <span>{{ ucFirst($tag) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        @endif
                        <!-- course single sidebar end-->
                            <!-- course single sidebar -->
                            <div class="course-single-information">
                                <h5 class="title">Share</h5>
                                <div class="body">
                                    <!-- social-share-course-sidebar -->
                                    <div class="social-share-course-side-bar">
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- social-share-course-sidebar end -->
                                </div>
                            </div>
                            <!-- course single sidebar end-->

                            <!-- course single sidebar -->
                            <div class="course-single-information last">
                                <h5 class="title">Audience</h5>
                                <div class="body">
                                    <!-- ingle check -->
                                    <div class="single-check">
                                        <i class="fa-light fa-circle-check"></i>
                                        {{ $course->audience }}
                                    </div>
                                    <!-- ingle check end -->
                                </div>
                            </div>
                            <!-- course single sidebar end-->
                        </div>
                        <!-- single course-sidebar end -->
                    </div>
                    <!-- right- sticky bar area end -->
                </div>
            </div>
        </div>
    </div>

    {{-- Content Preview Modal --}}
    <div class="modal fade" id="contentModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="edit-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Content Preview</h5>
                    <button type="button" class="btn-close bg-transparent border-0" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="spinner-grow" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course details area end -->
@endsection
@push('js')
<script>
    $('#contentModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var contentId = button.data('content-id');

        $.ajax({
            url: '{{route('course.content')}}/' + contentId,
            success: function(data) {
                if(data.success == true) {
                    $('#contentModal .modal-body').html(data.html);
                }
            }
        });
    });
</script>
@endpush
