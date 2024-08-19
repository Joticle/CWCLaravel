<!-- footer call to action area start -->
<div class="footer-callto-action-area bg-light-1">
    <div class="container">
        <div class="row  ptb--100">
            <div class="col-lg-12">
                <!-- footer main wrapper -->
                <div class="footer-one-main-wrapper">
                    <!-- single sized  footer  -->
                    <div class="footer-singl-wized left-logo">
                        <div class="head">
                            <a href="{{url('/')}}">
                                <img src="{{asset('images/logo-transparent.png')}}" alt="logo" loading="lazy">
                            </a>
                        </div>
                        <div class="body">
                            <p class="dsic">
                                We are passionate education dedicated to providing high-quality resources learners
                                all backgrounds.
                            </p>
                            {{--<ul class="wrapper-list">
                                <li><i class="fa-regular fa-location-dot"></i>Yarra Park, Melbourne, Australia </li>
                                <li><i class="fa-regular fa-phone"></i><a href="tel:+4733378901">+(61) 485-826-710</a></li>
                            </ul>--}}
                        </div>
                    </div>
                    <!-- single sized  footer end -->
                    <!-- single sized  footer  -->
                    <div class="footer-singl-wized">
                        <div class="head">
                            <h6 class="title">Quick Links</h6>
                        </div>
                        <div class="body">
                            <ul class="menu">
                                @foreach ($pages as $page)
                                    <li><a
                                            href="{{ route('cms-page', ['slug' => $page->slug]) }}">{{ $page->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- single sized  footer end -->
                    <!-- single sized  footer  -->
                    <div class="footer-singl-wized">
                        <div class="head">
                            <h6 class="title">Explore</h6>
                        </div>
                        <div class="body">
                            <ul class="menu">
                                @foreach ($connections as $connection)
                                    @if ($connection->button->url)
                                        <li><a
                                            href="{{ $connection->button->url }}" @if ($connection->button->target_blank) target="_blank" @endif>{{ $connection->button->text }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- single sized  footer end -->
                    <!-- single sized  footer  -->
                    <div class="footer-singl-wized input-area">
                        <div class="head">
                            <h6 class="title">Newsletter</h6>
                        </div>
                        <div class="body">
                            <p class="disc">Subscribe Our newsletter get update our new course</p>
                            <form action="#">
                                <div class="input-area-fill">
                                    <input type="email" placeholder="Enter Your Email" required>
                                    <button> Subscribe</button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" id="exampleCheck1">
                                    <label for="exampleCheck1">I agree to the terms of use and privacy policy.</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- single sized  footer end -->
                </div>
                <!-- footer main wrapper end -->
            </div>
        </div>
    </div>
    <div class="copyright-area-one-border">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-one">
                        <p>Copyright © All Rights Reserved. Powered By Joticle, Inc.</p>
                        <div class="social-copyright">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer call to action area end -->

<!-- rts backto top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>
<!-- rts backto top end -->
