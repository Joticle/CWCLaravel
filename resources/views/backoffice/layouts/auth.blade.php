<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link href="{!! asset('admin-assets/css/style.css?'.env('APP_VERSION')) !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('admin-assets/css/custom.css?'.env('APP_VERSION')) !!}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('admin-assets/vendor/toastr/css/toastr.min.css') !!}">
	@yield('page-level-style')

</head>
<body>

	@yield('content')

    <!-- Scripts -->
    @yield('page-level-script')
    
</body>
</html>
