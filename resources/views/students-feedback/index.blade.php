<!-- feedback area start -->
@php
    $studentsFeedback = App\Models\StudentsFeedback::active()->get();
@endphp

@if (!empty($studentsFeedback))
    <div class="rts-feedback-area rts-section-gap bg-light-1 shape-move">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-center-style">
                        <div class="pre-title">
                            <img src="site-assets/images/banner/bulb.png" alt="icon">
                            <span>Student Review</span>
                        </div>
                        <h2 class="title">Our Students Feedback</h2>
                        <p class="post-title">You'll find something to spark your curiosity and enhance</p>
                    </div>
                </div>
            </div>
            <div class="row mt--50">
                <div class="col-lg-12">
                    <div class="students-feedback-wrapper-1 bg_image">
                        <div class="swiper mySwiper-testimonials-1">
                            <div class="swiper-wrapper">
                                @foreach ($studentsFeedback as $feedback)
                                    <div class="swiper-slide">
                                        <!-- single testimonials0area -->
                                        <div class="single-students-feedback">
                                            <div class="left-image">
                                                <img src="{{ $feedback->getImage() }}" alt="feedback">
                                            </div>
                                            <div class="right-content">
                                                <img src="site-assets/images/students-feedback/01.png" alt="feedback">
                                                <p class="disc">
                                                    {{ $feedback->text }}
                                                </p>
                                                <!-- author area -->
                                                <div class="author-area">
                                                    {!! $feedback->ratingHtml !!}
                                                    <h5 class="title">{{ $feedback->name }}</h5>
                                                    <span>{{ $feedback->designation }}</span>
                                                </div>
                                                <!-- author area end -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="shape-image">
                            <div class="shape one" data-speed="0.04" data-revert="true"><img
                                    src="site-assets/images/banner/18.png" alt=""></div>
                            <div class="shape three" data-speed="0.04"><img src="site-assets/images/banner/17.png"
                                    alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
