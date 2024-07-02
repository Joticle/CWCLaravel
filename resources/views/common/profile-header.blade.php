<div class="dashboard-banner-area-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-banner-area-start bg_image"
                    style="background-image:{{ asset('site-assets/images/dashboard/01.jpg') }}">
                    <div class="author-profile-image-and-name">
                        <div class="profile-pic">
                            <img style="height: 200px;" src="{{ auth()->user()->getThumbnail() }}" id="profileImage"
                                alt="dashboard">
                            <input name="image" type="file" class="d-none" id="fileInput">
                        </div>
                        <div class="name-desig">
                            <h1 class="title">{{ Auth::user()->name }}</h1>
                            <div class="course-vedio">
                                <div class="single">
                                    <i class="fa-thin fa-book"></i>
                                    <span>{{ Auth::user()->courseEnrolled->count() . ' ' . Str::plural('Course', Auth::user()->courseEnrolled->count()) }}
                                        Enrolled</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('profileImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var formData = new FormData();
            formData.append('thumbnail', file);

            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.update.thumbnail') }}',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
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
                    errorMsg('Error: ' + error);
                }
            });
        }
    });
</script>
