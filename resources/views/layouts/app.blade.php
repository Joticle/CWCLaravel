<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
    @yield('page-level-style')
</head>
<body>


<div id="main-wrapper">
@include('includes.header')
    @yield('content')
    @include('includes.footer')
</div>
<!-- Scripts -->
@include('includes.scripts')
@yield('page-level-script')

</body>
</html>
