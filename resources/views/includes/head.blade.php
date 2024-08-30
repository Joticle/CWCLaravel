<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title','College For World Connections - CWC')</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ optional($setting)->getFavicon() ?: asset('site-assets/images/fav.png')}}">
<!-- fontawesome 6.4.2 -->
<link rel="stylesheet" href="{{asset('site-assets/css/plugins/fontawesome-6.css?v='.env('APP_VERSION'))}}">
<!-- swiper Css 10.2.0 -->
<link rel="stylesheet" href="{{asset('site-assets/css/plugins/swiper.min.css?v='.env('APP_VERSION'))}}">
<!-- magnific popup css -->
<link rel="stylesheet" href="{{asset('site-assets/css/vendor/magnific-popup.css?v='.env('APP_VERSION'))}}">
<!-- Bootstrap 5.0.2 -->
<link rel="stylesheet" href="{{asset('site-assets/css/vendor/bootstrap.min.css?v='.env('APP_VERSION'))}}">
<!-- jquery ui css -->
<link rel="stylesheet" href="{{asset('site-assets/css/vendor/jquery-ui.css?v='.env('APP_VERSION'))}}">
<!-- metismenu scss -->
<link rel="stylesheet" href="{{asset('site-assets/css/vendor/metismenu.css?v='.env('APP_VERSION'))}}">
<!-- custom style css -->
<link rel="stylesheet" href="{{asset('site-assets/css/style.css?v='.env('APP_VERSION'))}}">
<link rel="stylesheet" href="{!! asset('admin-assets/vendor/toastr/css/toastr.min.css') !!}">

<meta name="description" content="College For World Connections" />
<meta name="keywords" content="Education, Consulting, Eduction Consullting" />
<meta name="csrf-token" content="{{csrf_token()}}" />
