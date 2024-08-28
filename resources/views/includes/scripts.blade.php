<!-- all scripts -->
<!-- jquery min js -->
<script src="{{asset('site-assets/js/vendor/jquery.min.js?v='.env('APP_VERSION'))}}"></script>
<!-- jquery ui js -->
<script src="{{asset('site-assets/js/vendor/jquery-ui.js?v='.env('APP_VERSION'))}}"></script>
<!-- metismenu js -->
<script src="{{asset('site-assets/js/vendor/metismenu.js?v='.env('APP_VERSION'))}}"></script>
<!-- magnific popup js-->
<script src="{{asset('site-assets/js/vendor/magnifying-popup.js?v='.env('APP_VERSION'))}}"></script>
<!-- swiper JS 10.2.0 -->
<script src="{{asset('site-assets/js/plugins/swiper.js?v='.env('APP_VERSION'))}}"></script>
<!-- counterup js -->
<script src="{{asset('site-assets/js/plugins/counterup.js?v='.env('APP_VERSION'))}}"></script>
<!-- waypoint js -->
<script src="{{asset('site-assets/js/vendor/waypoint.js?v='.env('APP_VERSION'))}}"></script>
<!-- wow js -->
<script src="{{asset('site-assets/js/vendor/waw.js?v='.env('APP_VERSION'))}}"></script>
<!-- isotop mesonary -->
<script src="{{asset('site-assets/js/plugins/isotop.js?v='.env('APP_VERSION'))}}"></script>
<!-- jquery imageloaded -->
<script src="{{asset('site-assets/js/plugins/imagesloaded.pkgd.min.js?v='.env('APP_VERSION'))}}"></script>
<!-- resize sensor js -->
<script src="{{asset('site-assets/js/plugins/resizer-sensor.js?v='.env('APP_VERSION'))}}"></script>
<!-- sticky sidebar -->
<script src="{{asset('site-assets/js/plugins/sticky-sidebar.js?v='.env('APP_VERSION'))}}"></script>
<!-- gsap twinmax js -->
<script src="{{asset('site-assets/js/plugins/twinmax.js?v='.env('APP_VERSION'))}}"></script>
<!-- chroma js -->
<script src="{{asset('site-assets/js/vendor/chroma.min.js?v='.env('APP_VERSION'))}}"></script>
<!-- bootstrap 5.0.2 -->
<script src="{{asset('site-assets/js/plugins/bootstrap.min.js?v='.env('APP_VERSION'))}}"></script>
<!-- dymanic Contact Form -->
<script src="{{asset('site-assets/js/plugins/contact.form.js?v='.env('APP_VERSION'))}}"></script>
<!-- calender js -->
<script src="{{asset('site-assets/js/plugins/calender.js?v='.env('APP_VERSION'))}}"></script>
<!-- main Js -->
<script src="{{asset('site-assets/js/main.js?v='.env('APP_VERSION'))}}"></script>
<script src="{!! asset('admin-assets/vendor/toastr/js/toastr.min.js') !!}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    @if(isset($errors))
    @foreach ($errors->all() as $error)
        errorMsg('{{$error}}');
    @endforeach
    @endif
    @if(session()->has('success'))
        successMsg('{{ session()->get('success') }}')
    @endif
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // show success msg
    function successMsg(msg){
        toastr.success(msg);
    }

    // show error msg
    function errorMsg(msg){
        window.toastr.error(msg);
    }

    function showLoader(){
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                color: '#fff',
            },
            baseZ: 2000,
        });
    }
    function hideLoader(){
        $.unblockUI();
    }

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    /*delete cookies*/
    function eraseCookie(name) {
        createCookie(name,"",-1);
    }
    function debounce(func, delay) {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }
</script>
