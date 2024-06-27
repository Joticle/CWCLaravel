<div class="dashboard-banner-area-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-banner-area-start bg_image" style="background-image:{{asset('site-assets/images/dashboard/01.jpg')}}">
                    <div class="author-profile-image-and-name">
                        <div class="profile-pic">
                            <img style="height: 200px;" src="{{ auth()->user()->getThumbnail() }}" id="profileImage" alt="dashboard">
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
            formData.append('image', file);

            fetch('/api/upload-profile-image', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profileImage').src = data.imagePath;
                    } else {
                        alert('Error uploading image');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading image');
                });
        }
    });
</script>
