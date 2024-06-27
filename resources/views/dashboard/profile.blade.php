@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="settings-wrapper-dashed">
        <h5 class="title">{{ $title }}</h5>
        <ul class="nav nav-pills mb-3 tab-buttons" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#update-profile"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#update-password"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Password</button>
            </li>
        </ul>
        <div class="tab-content">
            <div id="update-profile" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="social-profile-link-wrapper">
                    <form id="profile-form" autocomplete="off" method="POST"
                        action="{{ route('dashboard.update.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="single-profile-wrapper">
                            <div class="left">
                                <div class="icon">
                                    <span>Name</span>
                                </div>
                            </div>
                            <div class="right">
                                <input name="name" id="name" placeholder="Enter Course Name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="single-profile-wrapper">
                            <div class="left">
                                <div class="icon">
                                    <span>Email</span>
                                </div>
                            </div>
                            <div class="right">
                                <input value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('profile-form').submit();"
                            class="rts-btn btn-primary">Update Profile</a>
                    </form>
                </div>
            </div>
            <div id="update-password" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="setting-change-password-area">
                    <form class="form-password-area" action="{{ route('dashboard.update.password') }}"
                        method="POST" autocomplete="off">
                        @csrf
                        <div class="single-input">
                            <label for="current">Current Password</label>
                            <input name="old_password" id="current" type="password" placeholder="Current Password" required>
                        </div>
                        <div class="single-input">
                            <label for="new">New Password</label>
                            <input name="new_password" id="new" type="password" placeholder="New Password" required>
                        </div>
                        <div class="single-input">
                            <label for="Current-2">Re-type New Password</label>
                            <input name="new_password_confirmation" id="Current-2" type="password"
                                placeholder="Re-type New Password">
                        </div>
                        <button type="submit" class="rts-btn btn-primary">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var activeTab = "{{ session('activeTab', 'update-profile') }}";

            var tabs = document.querySelectorAll('.nav-pills .nav-link');
            tabs.forEach(function(tab) {
                if (tab.getAttribute('data-bs-target') === '#' + activeTab) {
                    tab.classList.add('active', 'show');
                    tab.setAttribute('aria-selected', 'true');
                } else {
                    tab.classList.remove('active', 'show');
                    tab.setAttribute('aria-selected', 'false');
                }
            });

            var tabContents = document.querySelectorAll('.tab-content .tab-pane');
            tabContents.forEach(function(content) {
                if (content.getAttribute('id') === activeTab) {
                    content.classList.add('active', 'show');
                } else {
                    content.classList.remove('active', 'show');
                }
            });
        });
    </script>

@endsection
