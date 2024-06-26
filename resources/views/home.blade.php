@extends('layouts.app')

@section('content')
    <!-- banner area start -->
    <div class="banner-area-one shape-move">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-xl-1 order-lg-1 order-sm-2 order-2">
                    <div class="banner-content-one">
                        <div class="inner">
                            <div class="pre-title-banner">
                                <img src="site-assets/images/banner/bulb.png" width="22" alt="icon">
                                <span>Gateway to Lifelong Learning</span>
                            </div>
                            <h1 class="title-banner">
                                Unlock Your Potential <br>
                                with <span>Online Learning</span>
                                <img src="site-assets/images/banner/02.png" alt="banner">
                            </h1>
                            <p class="disc">Discover a world of knowledge and opportunities with our online
                                education platform pursue a new career.</p>
                            <div class="banner-btn-author-wrapper">
                                <a href="{{route('courses')}}" class="rts-btn btn-primary with-arrow">View All Course <i class="fa-regular fa-arrow-right"></i></a>
                                <div class="sm-image-wrapper">
                                    <div class="images-wrap">
                                        <img src="site-assets/images/banner/shape/06.png" alt="banner">
                                        <img class="two" src="site-assets/images/banner/shape/07.png" alt="banner">
                                        <img class="three" src="site-assets/images/banner/shape/08.png" alt="banner">
                                    </div>
                                    <div class="info">
                                        <h6 class="title">2k students</h6>
                                        <span>Joint our online Class</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order--xl-2 order-lg-2 order-sm-1 order-1">
                    <div class="banner-right-img">
                        <img src="site-assets/images/banner/01.png" alt="banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="review-thumb">
            <!-- single review -->
            <div class="review-single">
                <img src="site-assets/images/banner/03.png" alt="banner">
                <div class="info-right">
                    <h6 class="title">4.5</h6>
                    <span>(2.4k Review)</span>
                </div>
            </div>
            <!-- single review end -->
            <!-- single review -->
            <div class="review-single two">
                <img src="site-assets/images/banner/04.png" alt="banner">
                <div class="info-right">
                    <h6 class="title">100+
                    </h6>
                    <span>Online Course</span>
                </div>
            </div>
            <!-- single review end -->
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img src="site-assets/images/banner/shape/banner-shape01.svg" alt="shape_image"></div>
            <div class="shape two" data-speed="0.04"><img src="site-assets/images/banner/shape/banner-shape02.svg" alt="shape_image"></div>
            <div class="shape three" data-speed="0.04"><img src="site-assets/images/banner/shape/banner-shape03.svg" alt="shape_image"></div>
        </div>
    </div>
    <!-- banner area end -->

    <!-- brand area start -->
    <div class="brand-area-one ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-style-one ">
                        <div class="left-title">
                            <h6 class="title">Trusted by:</h6>
                        </div>
                        <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
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
    <!-- brand area end -->

    <!-- about area start -->
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <h3>What is College For World Connections?</h3>
            <p class="paragraph">College for World Connections Center for Innovation & Learning is a full-service Educator Ecosystem for teaching and empowering adults, professionals, and teams in Leadership Principles. In partnership with Joticle, Inc., our academic instructors dedicate their knowledge and expertise to improving the lives of others through leadership instruction, creative and critical thinking development, and world schooling. Leaders RISE and become empowered in a learner friendly, educator respected, and educationally elevated platform. </p>
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <!-- about-one-imagearea -->
                    <div class="about-one-left-image">
                        <div class="first-order">
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/one.png" alt="brand">
                                </div>
                                <h5 class="title">LEADERS</h5>
                            </a>
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/two.png" alt="brand">
                                </div>
                                <h5 class="title">ENTREPRENEURS</h5>
                            </a>
                        </div>
                        <div class="first-order">
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/three.png" alt="brand">
                                </div>
                                <h5 class="title">FAITH-BASED</h5>
                                <!--<span>130+ Courses</span>-->
                            </a>
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/four.png" alt="brand">
                                </div>
                                <h5 class="title">EDUCATORS</h5>
                                <!--<span>130+ Courses</span>-->
                            </a>
                        </div>
                        <div class="first-order">
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/five.png" alt="brand">
                                </div>
                                <h5 class="title">DOCTORAL LEARNERS</h5>
                            </a>
                            <a href="#" class="category-style-one">
                                <div class="icon">
                                    <img src="images/six.png" alt="brand">
                                </div>
                                <h5 class="title">NON-PROFITS</h5>
                            </a>
                        </div>

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
                        <p class="post-title">College for World Connections Center for Innovation & Learning is a full-service Educator Ecosystem for teaching and empowering adults, professionals, and teams in Leadership Principles. In partnership with Joticle, Inc., our academic instructors dedicate their knowledge and expertise to improving the lives of others through leadership instruction, creative and critical thinking development, and world schooling. Leaders RISE and become empowered in a learner friendly, educator respected, and educationally elevated platform. </p>
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
        </div>
    </div>
    <!-- about area end -->

    <!-- about area start -->
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="paragraph w-75 d-inline-block">
                <h3>EXECUTIVE LEADERS RISE</h3>
                <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 float-end d-inline-block">
                <img src="images/onebig.png" class="img-responsive">
            </div>

        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="float-end paragraph w-75 d-inline-block">
                <h3>ENTREPRENEURS RISE</h3>
                <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth. </p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 d-inline-block">
                <img src="images/twobig.png">
            </div>

        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="paragraph w-75 d-inline-block">
                <h3>EXECUTIVE LEADERS RISE</h3>
                <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 float-end d-inline-block">
                <img src="images/onebig.png" class="img-responsive">
            </div>

        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="float-end paragraph w-75 d-inline-block">
                <h3>ENTREPRENEURS RISE</h3>
                <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth. </p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 d-inline-block">
                <img src="images/twobig.png">
            </div>

        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="paragraph w-75 d-inline-block">
                <h3>EXECUTIVE LEADERS RISE</h3>
                <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 float-end d-inline-block">
                <img src="images/onebig.png" class="img-responsive">
            </div>

        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="float-end paragraph w-75 d-inline-block">
                <h3>ENTREPRENEURS RISE</h3>
                <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth. </p>
                <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
            </div>
            <div class="w-20 d-inline-block">
                <img src="images/twobig.png">
            </div>

        </div>
    </div>
    <!-- about area end -->

    <!-- fun facts area start -->
    <div class="fun-facts-area-1 shape-move bg_image ptb--50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fun-facts-main-wrapper-1">
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="site-assets/images/fun-facts/01.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">65,972</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="site-assets/images/fun-facts/02.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">5,321</span></h5>
                            <span class="enr">Completed Course</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="site-assets/images/fun-facts/03.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">44,239</span></h5>
                            <span class="enr">Students Learner</span>
                        </div>
                        <!-- single end -->
                        <!-- single  -->
                        <div class="single-fun-facts">
                            <div class="icon">
                                <img src="site-assets/images/fun-facts/04.svg" alt="icon">
                            </div>
                            <h5 class="title"><span class="counter">75,992</span></h5>
                            <span class="enr">Students Enrolled</span>
                        </div>
                        <!-- single end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-image">
            <div class="shape one" data-speed="0.04" data-revert="true"><img src="site-assets/images/banner/15.png" alt=""></div>
            <div class="shape three" data-speed="0.04"><img src="site-assets/images/banner/16.png" alt=""></div>
        </div>
    </div>
    <!-- fun facts area end -->
    @include('students-feedback.index')
@endsection
