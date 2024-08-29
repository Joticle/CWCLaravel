@extends('layouts.app')

@section('content')
    <!-- banner area start -->
    @if ($banners->count() > 0)
        <!-- banner area start -->
        <div class="swiper mySwiper-home-slider-1">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="banner-area-one swiper-slide banner-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 order-xl-1 order-lg-1 order-sm-2 order-2">
                                    <div class="banner-content-one">
                                        <div class="inner">
                                            <h1 class="title-banner">
                                                {{ $banner->title }}
                                                {{-- <img src="site-assets/images/banner/02.png" alt="banner"> --}}
                                            </h1>
                                            <p class="disc">{{ $banner->description }}</p>
                                            @if (optional($banner->button)->url)
                                                <div class="banner-btn-author-wrapper">
                                                    <a href="{{ optional($banner->button)->url }}"
                                                        @if (optional($banner->button)->target_blank) target="_blank" @endif
                                                        class="rts-btn btn-primary with-arrow">{{ optional($banner->button)->text }}
                                                        <i class="fa-regular fa-arrow-right"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 order--xl-2 order-lg-2 order-sm-1 order-1">
                                    <div class="banner-right-img">
                                        <img src="{{ $banner->getImage() }}" alt="banner">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    @endif

    {{-- connection section --}}
    {{-- <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <h3>What is College For World Connections?</h3>
            <p class="paragraph">College for World Connections Center for Innovation & Learning is a full-service Educator
                Ecosystem for teaching and empowering adults, professionals, and teams in Leadership Principles. In
                partnership with Joticle, Inc., our academic instructors dedicate their knowledge and expertise to improving
                the lives of others through leadership instruction, creative and critical thinking development, and world
                schooling. Leaders RISE and become empowered in a learner friendly, educator respected, and educationally
                elevated platform. </p>
            @foreach ($connections as $connection)
                <div class="rts-section-gapBottom">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-12">
                            <!-- about-one-imagearea -->
                            <div class="about-one-left-image">
                                @foreach ($connection->categories as $index => $category)
                                    @if ($index % 2 == 0)
                                        <div class="first-order">
                                    @endif

                                    <a href="#" class="category-style-one">
                                        <div class="icon">
                                            <img src="{{ $connection->getCategoryIcon($category->icon) }}" alt="brand">
                                        </div>
                                        <h5 class="title">{{ $category->name }}</h5>
                                    </a>

                                    @if ($index % 2 == 1 || $loop->last)
                            </div>
            @endif
            @endforeach

        </div>
        <!-- about-one-imagearea end -->
    </div>
    <div class="col-xl-6 col-lg-12 pl--60 pl_lg--15 pl_md--10 pl_sm--10 pt_lg--50 pt_md--50 pt_sm--50">
        <div class="title-area-left-style">
            <div class="pre-title">
                <img src="site-assets/images/banner/bulb.png" alt="icon">
                <span>Gateway to Lifelong Learning</span>
            </div>
            <h2 class="title">What is College For World Connections?</h2>
            <p class="post-title">College for World Connections Center for Innovation & Learning is a full-service Educator
                Ecosystem for teaching and empowering adults, professionals, and teams in Leadership Principles. In
                partnership with Joticle, Inc., our academic instructors dedicate their knowledge and expertise to improving
                the lives of others through leadership instruction, creative and critical thinking development, and world
                schooling. Leaders RISE and become empowered in a learner friendly, educator respected, and educationally
                elevated platform. </p>
        </div>
        <div class="about-inner-right-one">
            <div class="author-area">
                <div class="single-author-and-info">
                    <img src="images/logo.png" style="width: 250px;" alt="about">
                </div>
                <a href="#" class="rts-btn btn-primary">About Us</a>
            </div>
        </div>
    </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-10 col-md-9">
            <h3>{{ Str::upper($connection->name) }}</h3>
            <p>{{ $connection->description }}</p>
            @if ($connection->button)
                <a href="{{ $connection->button->url }}" @if ($connection->button->target_blank) target="_blank" @endif
                    class="mt--10 rts-btn btn-primary">{{ $connection->button->text }}</a>
            @endif
        </div>
        <div class="col-lg-2 col-md-3 d-none d-md-block">
            <img src="{{ $connection->getLogo() }}" class="img-fluid" alt="{{ $connection->name }}">
        </div>
    </div>
    </div>
    @endforeach

    </div>
    </div> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- about area start -->
                <div class="about-area-start ptb--30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    @foreach ($connections as $connection)
                                        <div class="col-md-4 mt-2">
                                            <a href="{{ route('connection-page', ['slug' => $connection->slug]) }}" class="category-style-one">
                                                <div class="icon">
                                                    <img src="{{$connection->getLogo()}}" alt="{{ $connection->name }}">
                                                </div>
                                                <h5 class="title">{{ $connection->name }}</h5>
                                                {{--<span>{{ $connection->name }}</span>--}}
                                            </a>

                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-center">
                                    <div class="col-md-12 pl_lg--15 pl_md--10 pl_sm--10 pt_lg--50 pt_md--50 pt_sm--50">
                                        <div class="title-area-left-style">
                                            <div class="pre-title">
                                                <img src="site-assets/images/banner/bulb.png" alt="icon">
                                                <span>Gateway to Lifelong Learning</span>
                                            </div>
                                            <h2 class="title">What is College For World Connections?</h2>
                                            <p class="post-title">College for World Connections Center for Innovation &amp;
                                                Learning is
                                                a full-service Educator
                                                Ecosystem for teaching and empowering adults, professionals, and teams in
                                                Leadership
                                                Principles. In
                                                partnership with Joticle, Inc., our academic instructors dedicate their
                                                knowledge
                                                and expertise to improving
                                                the lives of others through leadership instruction, creative and critical
                                                thinking
                                                development, and world
                                                schooling. Leaders RISE and become empowered in a learner friendly, educator
                                                respected, and educationally
                                                elevated platform. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- about area end -->
                <div class="about-area-start">
                    <div class="container">
                        @foreach ($connections as $key => $connection)
                            <div class="row mt-5">
                                @if ($key % 2 == 0)
                                    <div class="col-lg-2 col-md-3 order-lg-1 d-none d-md-block">
                                        <img src="{{ $connection->getLogo() }}" class="img-fluid" alt="Entrepreneurs Rise">
                                    </div>
                                @endif

                                <div class="col-lg-10 col-md-9 order-lg-2">
                                    <h3>{{ $connection->name }}</h3>
                                    <p>{!! $connection->description !!}</p>
                                    @if ($connection->button)
                                        <a href="{{ route('connection-page', ['slug' => $connection->slug]) }}"
                                            @if ($connection->button->target_blank) target="_blank" @endif
                                            class="mt--10 rts-btn btn-primary">{{ $connection->button->text }}</a>
                                    @endif
                                </div>

                                @if ($key % 2 == 1)
                                    <div class="col-lg-2 col-md-3 order-lg-2 d-none d-md-block">
                                        <img src="{{ $connection->getLogo() }}" class="img-fluid"
                                            alt="{{ $connection->name }}">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Enterprise section --}}
    {{-- <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 order-lg-1 d-none d-md-block">
                    <img src="images/twobig.png" class="img-fluid" alt="Entrepreneurs Rise">
                </div>
                <div class="col-lg-10 col-md-9 order-lg-2">
                    <h3>ENTREPRENEURS RISE</h3>
                    <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business.
                        Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for
                        building a business from the ground up, including how to identify and validate your idea, create a
                        solid business plan, attract customers and investors, and navigate the challenges of scaling and
                        growth.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- trusties area start -->
    <div class="brand-area-one ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-style-one ">
                        <div class="left-title">
                            <h6 class="title">Trusted by:</h6>
                        </div>
                        <div class="swiper mySwiper-category-1 swiper-data"
                            data-swiper='{
                            "spaceBetween":30,
                            "slidesPerView":6,
                            "loop": true,
                            "speed": 1500,
                            "autoplay":{
                                "delay":"4000"
                            },
                            "breakpoints":{
                            "0":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "320":{
                                "slidesPerView":2,
                                "spaceBetween":30},
                            "480":{
                                "slidesPerView":3,
                                "spaceBetween":30},
                            "640":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "840":{
                                "slidesPerView":4,
                                "spaceBetween":30},
                            "1140":{
                                "slidesPerView":6,
                                "spaceBetween":30}
                            }
                        }'>
                            <div class="swiper-wrapper">
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/08.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/09.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/10.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/11.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/12.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                                <!-- single swiper style -->
                                <div class="swiper-slide">
                                    <div class="brand-area">
                                        <img src="site-assets/images/brand/13.svg" alt="brand">
                                    </div>
                                </div>
                                <!-- single swiper style -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- trusties area end -->
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
@endsection
