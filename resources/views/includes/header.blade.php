<!-- header style one -->
<header class="header-one header--sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-one-wrapper">
                    <div class="left-side-header">
                        <a href="{{url('/')}}" class="logo-area">
                            <img src="{{asset('images/logo-transparent.png')}}" style="width: 300px;" alt="logo">
                        </a>
                    </div>
                    <!--<div class="main-nav-one">
                        <nav>
                            <ul>
                                <li style="position: static;">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li style="position: static;">
                                    <a class="nav-link" href="#">Courses</a>
                                </li>
                            </ul>
                        </nav>
                    </div>-->


                    <div class="main-nav-one">
                    </div>
                    <div class="header-right-area-one">
                        <div class="buttons-area">
                            @if(auth()->check())
                                <div class="main-nav-one">
                                    <nav>
                                        <ul>
                                            <li class="has-dropdown">
                                                <a class="rts-btn btn-transparent nav-link" href="#">
                                                    <span>Hello, <strong>{{Auth::user()->name}}</strong></span>
                                                    <img class="auth-user-avatar" src="{{auth()->user()->getThumbnail()}}">
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="#"><i class="fa fa-user text-primary"></i> Profile</a></li>
                                                    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard text-primary"></i> Dashboard</a></li>
                                                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out text-primary"></i> Logout</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @else
                                <a href="{{route('login')}}" class="rts-btn btn-border">Log In</a>
                                <a href="{{route('register')}}" class="rts-btn btn-primary">Sign Up</a>
                            @endif

                        </div>
                        <div class="menu-btn" id="menu-btn">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                <rect width="20" height="2" fill="#1F1F25"></rect>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header style end -->


<!-- header style Mobile -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
    <!--<nav class="nav-main mainmenu-nav mt&#45;&#45;30">
                <ul class="mainmenu metismenu" id="mobile-menu-active">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                </ul>
            </nav>-->
        @if(auth()->check())
            <img class="auth-user-avatar" src="{{auth()->user()->getThumbnail()}}">
            <span>Hello, <strong>{{Auth::user()->name}}</strong></span>
            <ul class="list-unstyled">
                <li><a href="#"><i class="fa fa-user text-primary"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-dashboard text-primary"></i> Dashboard</a></li>
                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out text-primary"></i> Logout</a></li>
            </ul>
        @else
            <div class="buttons-area">
                <a href="#" class="rts-btn btn-border">Log In</a>
                <a href="#" class="rts-btn btn-primary">Sign Up</a>
            </div>
        @endif
        <div class="rts-social-style-one pl--20 mt--50">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- header style Mobile End -->
