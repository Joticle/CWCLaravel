@extends('backoffice.layouts.app')

@section('title', $singular_name)

@section('page-level-style')

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4> Update {{ $singular_name }}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @foreach ($breadcrumb as $title => $link)
                    <li class="breadcrumb-item {{ empty($link) ? 'active' : '' }}"><a
                            href="{{ !empty($link) ? $link : 'javascript:void(0)' }}">{{ $title }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <div class="card h-auto">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation"><a href="#update-profile" data-toggle="tab"
                                        class="nav-link show active" aria-selected="true" role="tab">Profile</a>
                                </li>
                                <li class="nav-item" role="presentation"><a href="#update-password" data-toggle="tab"
                                        class="nav-link" aria-selected="false" role="tab" tabindex="-1">Update
                                        Password</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="update-profile" class="tab-pane fade active show" role="tabpanel">
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-3">
                                            <form autocomplete="off" method="POST"
                                                action="{{ route('admin.profile.post') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="text-label">Name<span
                                                                            class="text-danger">*</span></label>
                                                                    <input name="name" id="name"
                                                                        placeholder="Enter Course Name" class="form-control"
                                                                        value="{{ old('name', $user->name) }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="text-label">Email<span
                                                                            class="text-danger"></span></label>
                                                                    <input class="form-control" value="{{ $user->email }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xl-3 border-left">
                                                        <strong>Role</strong>: {{ $user->role }}
                                                        <div id="avatar_image">
                                                            <img id="thumbnailImg" alt="image"
                                                                style="max-width:100px; height:auto;"
                                                                src="{{ $user->getThumbnail() }}">
                                                        </div>
                                                        <div class="m-b-10"></div>
                                                        <div class="form-group">
                                                            <label>Profile Image</label>
                                                            <input type="file" name="thumbnail"
                                                                class="form-control previewInput"
                                                                data-target="#thumbnailImg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="update-password" class="tab-pane fade" role="tabpanel">
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-3">
                                            <form autocomplete="off" method="POST"
                                                action="{{ route('admin.profile.updatePassword') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="text-label">Old Password<span
                                                                            class="text-danger">*</span></label>
                                                                    <input name="old_password" id="old_password"
                                                                        type="password" placeholder="Enter Old Password"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="text-label">New Password<span
                                                                            class="text-danger">*</span></label>
                                                                    <input name="new_password" id="new_password"
                                                                        type="password" placeholder="Enter New Password"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="text-label">Confirm New Password<span
                                                                            class="text-danger">*</span></label>
                                                                    <input name="new_password_confirmation"
                                                                        id="new_password_confirmation" type="password"
                                                                        placeholder="Confirm New Password"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>





@endsection

@section('page-level-script')
@endsection
