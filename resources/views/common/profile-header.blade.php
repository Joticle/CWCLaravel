<div class="dashboard-banner-area-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard-banner-area-start bg_image" style="background-image:{{asset('site-assets/images/dashboard/01.jpg')}}">
                    <div class="author-profile-image-and-name">
                        <div class="profile-pic">
                            <img style="height: 200px;" src="{{ auth()->user()->getThumbnail() }}" alt="dashboard">
                        </div>
                        <div class="name-desig">
                            <h1 class="title">{{ Auth::user()->name }}</h1>
                            <div class="course-vedio">
                                <div class="single">
                                    <i class="fa-thin fa-book"></i>
                                    <span>{{ Auth::user()->courseEnrolled->count() .' ' . Str::plural('Course', Auth::user()->courseEnrolled->count()) }} Enrolled</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
