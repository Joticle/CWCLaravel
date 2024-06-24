<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @include('backoffice.includes.head')
    @yield('page-level-style')

</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<div id="main-wrapper">
@include('backoffice.includes.header')

@include('backoffice.includes.sidebar')
    <div class="content-body">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    @include('backoffice.includes.footer')
</div>
<!-- Scripts -->
@include('backoffice.includes.scripts')
@yield('page-level-script')

</body>
</html>
