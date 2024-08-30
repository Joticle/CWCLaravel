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
                                <img src="{{ optional($setting)->getLogo() ?: asset('images/logo-transparent.png')}}" alt="logo" loading="lazy">
                            </a>
                        </div>
                        <div class="body">
                            <p class="dsic">
                               {{ optional($setting)->short_desc ?: '' }}
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
                                    <li><a href="{{ route('cms-page', ['slug' => $page->slug]) }}">{{ $page->name }}</a></li>
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
                                    {{-- @if ($connection->button->url) --}}
                                        <li><a
                                            href="{{ route('connection-page', ['slug' => $connection->slug]) }}">{{ $connection->name }}</a>
                                        </li>
                                    {{-- @endif --}}
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
                            <form id="subscribe" action="{{ route('subscribe') }}" method="POST">
                                <div class="input-area-fill">
                                    <input type="email" name="email" placeholder="Enter Your Email" required>
                                    <button type="submit"> Subscribe</button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" id="exampleCheck1" required>
                                    <label for="exampleCheck1">I agree to the <a class="text-decoration-underline" href="{{termsAndConditionLink()}}">terms of use</a> and <a class="text-decoration-underline" href="{{privacyPolicyLink()}}">privacy policy</a>.</label>
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
                                @if($setting)
                                    @if ($setting->facebook)
                                        <li><a href="https://www.facebook.com/{{ $setting->facebook }}" target="_blank"><i
                                                    class="fa-brands fa-facebook-f"></i></a></li>
                                    @endif
                                    @if ($setting->skype)
                                        <li><a href="https://www.skype.com/{{ $setting->skype }}" target="_blank"><i
                                                    class="fa-brands fa-skype"></i></a></li>
                                    @endif
                                    @if ($setting->linkedin)
                                        <li><a href="https://www.linkedin.com/{{ $setting->linkedin }}" target="_blank"><i
                                                    class="fa-brands fa-linkedin"></i></a></li>
                                    @endif
                                    @if ($setting->instagram)
                                        <li><a href="https://www.instagram.com/{{ $setting->instagram }}" target="_blank"><i
                                                    class="fa-brands fa-instagram"></i></a></li>
                                    @endif
                                    @if ($setting->pinterest)
                                        <li><a href="https://www.pinterest.com/{{ $setting->pinterest }}" target="_blank"><i
                                                    class="fa-brands fa-pinterest"></i></a></li>
                                    @endif
                                    @if ($setting->github)
                                        <li><a href="https://www.github.com/{{ $setting->github }}" target="_blank"><i
                                                    class="fa-brands fa-github"></i></a></li>
                                    @endif
                                    @if ($setting->youtube)
                                        <li><a href="https://www.youtube.com/{{ $setting->youtube }}" target="_blank"><i
                                                    class="fa-brands fa-youtube"></i></a></li>
                                    @endif
                                @endif
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
@push('js')
    <script>
        $(document).ready(function() {
            $("#subscribe").on("submit", function(e) {
                e.preventDefault();

                let form = $(this);
                let url = form.attr("action");
                let method = form.attr("method");
                let submitButton = form.find('button[type="submit"]');
                let checkBox = form.find('input[type="checkbox"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    type: method,
                    url: url,
                    data: form.serialize(),
                    success: function(result) {

                        if (result.success == true) {
                            successMsg(result.message);
                        } else {
                            errorMsg(result.message);
                        }
                    },
                    error: function(request, status, error) {
                        errorMsg(error);
                    },
                    complete: function() {

                        submitButton.prop('disabled', false);
                        checkBox.prop('checked', false);
                        form.find('input[type="email"]').val('');
                    }
                });
            });
        });
    </script>
@endpush
