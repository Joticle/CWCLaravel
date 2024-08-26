<!-- Required vendors -->
<script src="{!! asset('admin-assets/vendor/global/global.min.js') !!}"></script>
<script src="{!! asset('admin-assets/js/custom.min.js') !!}"></script>
<script src="{!! asset('admin-assets/js/deznav-init.js') !!}"></script>
<script src="{!! asset('admin-assets/vendor/toastr/js/toastr.min.js') !!}"></script>
<script src="{!! asset('admin-assets/vendor/select2/js/select2.full.min.js') !!}"></script>
<script src="{!! asset('js/jquery.blockUI.js') !!}"></script>
<script src="{!! asset('admin-assets/js/plugins-init/select2-init.js') !!}"></script>

<!-- pickdate -->
<script src="{{ asset('admin-assets/vendor/moment/moment.min.js') }}"></script>
<script
    src="{{ asset('admin-assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
</script>
<!-- sweetalert -->
<script src="{{ asset('admin-assets/vendor/sweetalert2/dist/sweetalert.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="https://cdn.tiny.cloud/1/{{ env('TINY_TOKEN') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin">
</script>
<script>
    tinymceInit();

    function tinymceInit() {
        tinymce.init({
            selector: 'textarea.tiny',
            plugins: [
                'wordcount'
            ],
            toolbar: ''
        });
    }

    function tinymceReInit(_id) {
        tinymce.remove();
        tinymce.init({
            selector: '.' + _id,
            plugins: [
                'wordcount'
            ],
            toolbar: ''
        });
    }
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if (isset($errors))
        @foreach ($errors->all() as $error)
            errorMsg('{{ $error }}');
        @endforeach
    @endif
    @if (session()->has('success'))
        successMsg('{{ session()->get('success') }}')
    @endif



    $(document).ready(function() {

        $("body").on("click", ".deletedBtn", function(e) {
            e.preventDefault();
            let url = $(this).attr('data-href');
            let method = $(this).attr('data-method');
            if (url) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete && typeof method == 'undefined') {
                        window.location.href = url;
                    } else if (willDelete) {

                        $.ajax({
                            type: method,
                            url: url,
                            success: function(result) {
                                try {
                                    result = JSON.parse(result);
                                } catch (e) {}
                                if ($.trim(result.success) == 'true') {
                                    successMsg(result.message);
                                    if (result.reload == true) {
                                        location.reload();
                                    }
                                } else {
                                    var errorsShow = '';
                                    $.each(result.message, function(k, v) {
                                        errorsShow += v + '<br>';
                                    });
                                    errorMsg(errorsShow);
                                }
                            },
                            error: function(request, status, error) {
                                errorMsg(error);
                            }
                        });
                    }
                });
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    // show success msg
    function successMsg(msg) {
        toastr.success(msg);
    }

    // show error msg
    function errorMsg(msg) {
        window.toastr.error(msg);
    }

    function showLoader() {
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

    function hideLoader() {
        $.unblockUI();
    }

    function createCookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    /*delete cookies*/
    function eraseCookie(name) {
        createCookie(name, "", -1);
    }
</script>
