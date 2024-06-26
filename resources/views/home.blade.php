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
            <div class="row">
                <div class="col-lg-10 col-md-9">
                    <h3>EXECUTIVE LEADERS RISE</h3>
                    <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
                <div class="col-lg-2 col-md-3 d-none d-md-block">
                    <img src="images/onebig.png" class="img-fluid" alt="Executive Leaders Rise">
                </div>
            </div>
        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 order-lg-1 d-none d-md-block">
                    <img src="images/twobig.png" class="img-fluid" alt="Entrepreneurs Rise">
                </div>
                <div class="col-lg-10 col-md-9 order-lg-2">
                    <h3>ENTREPRENEURS RISE</h3>
                    <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <!-- fun facts area end -->
    @include('students-feedback.index')
<<<<<<< HEAD
>>>>>>> aff562b (students feedback CRUD and dynamic content rendering)
=======
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-9">
                    <h3>EXECUTIVE LEADERS RISE</h3>
                    <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
                <div class="col-lg-2 col-md-3 d-none d-md-block">
                    <img src="images/onebig.png" class="img-fluid" alt="Executive Leaders Rise">
                </div>
            </div>
        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 order-lg-1 d-none d-md-block">
                    <img src="images/twobig.png" class="img-fluid" alt="Entrepreneurs Rise">
                </div>
                <div class="col-lg-10 col-md-9 order-lg-2">
                    <h3>ENTREPRENEURS RISE</h3>
                    <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-9">
                    <h3>EXECUTIVE LEADERS RISE</h3>
                    <p>Executive Leaders Rise is a hands-on interactive course for anyone looking to enhance their skills and adapt their mindset to succeed in today’s fast-paced technologically driven business world. Seasoned executives and leadership experts provide a comprehensive guide to the best practice in C-Suite leadership presence, including how to execute strategies and build strong teams leading with authenticity and empathy.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
                <div class="col-lg-2 col-md-3 d-none d-md-block">
                    <img src="images/onebig.png" class="img-fluid" alt="Executive Leaders Rise">
                </div>
            </div>
        </div>
    </div>
    <div class="about-area-start rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 order-lg-1 d-none d-md-block">
                    <img src="images/twobig.png" class="img-fluid" alt="Entrepreneurs Rise">
                </div>
                <div class="col-lg-10 col-md-9 order-lg-2">
                    <h3>ENTREPRENEURS RISE</h3>
                    <p>Entrepreneurs Rise is the ultimate course for anyone looking to start or grow a successful business. Developed by entrepreneurs and business experts, you are provided with a comprehensive roadmap for building a business from the ground up, including how to identify and validate your idea, create a solid business plan, attract customers and investors, and navigate the challenges of scaling and growth.</p>
                    <a href="#" class="mt--10 rts-btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- about area end -->
    <!-- feedback area start -->
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

                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img src="site-assets/images/students-feedback/01.jpg" alt="feedback">
                                        </div>
                                        <div class="right-content">
                                            <img src="site-assets/images/students-feedback/01.png" alt="feedback">
                                            <p class="disc">
                                                I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary adventure. The combination of exceptional.
                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Emma Elizabeth</h5>
                                                <span>Assistant Teacher</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img src="site-assets/images/students-feedback/02.jpg" alt="feedback">
                                        </div>
                                        <div class="right-content">
                                            <img src="site-assets/images/students-feedback/01.png" alt="feedback">
                                            <p class="disc">
                                                I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary adventure. The combination of exceptional.
                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Emma Elizabeth</h5>
                                                <span>Assistant Teacher</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- single testimonials0area -->
                                    <div class="single-students-feedback">
                                        <div class="left-image">
                                            <img src="site-assets/images/students-feedback/01.jpg" alt="feedback">
                                        </div>
                                        <div class="right-content">
                                            <img src="site-assets/images/students-feedback/01.png" alt="feedback">
                                            <p class="disc">
                                                I can't recommend The Gourmet Haven enough. It's a place for special occasions, date nights, or whenever you're in the mood for a culinary adventure. The combination of exceptional.
                                            </p>
                                            <!-- author area -->
                                            <div class="author-area">
                                                <ul class="stars">
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                                <h5 class="title">Emma Elizabeth</h5>
                                                <span>Assistant Teacher</span>
                                            </div>
                                            <!-- author area end -->
                                        </div>
                                    </div>
                                    <!-- single testimonials0area end -->
                                </div>

                            </div>
                            <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="shape-image">
                            <div class="shape one" data-speed="0.04" data-revert="true"><img src="site-assets/images/banner/18.png" alt=""></div>
                            <div class="shape three" data-speed="0.04"><img src="site-assets/images/banner/17.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
>>>>>>> 463b789528935f92f45191018383c6a6e89ed8e8
=======
>>>>>>> aff562b06a29a2a401e43ee65653846a34d8ae8c
@endsection
