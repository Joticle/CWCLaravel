@extends('backoffice.layouts.app')

@section('title', array_key_last($breadcrumb))

@section('page-level-style')
@endsection

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @foreach ($breadcrumb as $title => $link)
                    <li class="breadcrumb-item {{ empty($link) ? 'active' : '' }}"><a
                            href="{{ !empty($link) ? $link : 'javascript:void(0)' }}">{{ $title }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <ul class="mb-3 nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#update-profile"
                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#update-social" type="button"
                role="tab" aria-controls="pills-profile" aria-selected="false">Password</button>
        </li>
    </ul>
    <div class="tab-content">
        <div id="update-profile" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setting</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['url' => route('admin.setting'), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title<span class="text-danger">*</span></label>
                                        {!! Form::text('title', optional($setting)->title ?: '', [
                                            'id' => 'name',
                                            'class' => 'form-control',
                                            'required' => 'true',
                                            'placeholder' => 'Name',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-label">Logo</label>
                                        {{ Form::file('logo', ['class' => 'form-control crop-input', 'id' => 'logo', 'accept' => 'image/*', 'data-aspect-ratio' => 100 / 33]) }}
                                        <span class="text-danger">Preferred Size 200 X 65</span>
                                    </div>
                                </div>
                                <div class="col-md-2 align-content-center">
                                    <div class="form-group">
                                        <img style="width: 80px;height: 50px;" src="{{ optional($setting)->getLogo() }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-label">Favicon</label>
                                        {{ Form::file('favicon', ['class' => 'form-control crop-input', 'id' => 'favicon', 'accept' => 'image/*', 'data-aspect-ratio' => 1 / 1]) }}
                                        <span class="text-danger">Preferred Size 125 X 125</span>
                                    </div>
                                </div>
                                <div class="col-md-2 align-content-center">
                                    <div class="form-group">
                                        <img style="width: 80px;height: 50px;" src="{{ optional($setting)->getFavicon() }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-inline-block form-group">
                                        <label>Brand Primary Color<span class="text-danger">*</span></label>
                                        {!! Form::color('primary_color', optional($setting)->primary_color ?: '#074a74', [
                                            'class' => 'form-control',
                                            'id' => 'color',
                                            'title' => 'Choose your primary color',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-inline-block form-group">
                                        <label class="text-label">Brand Secondary Color<span
                                                class="text-danger">*</span></label>
                                        {{ Form::color('secondary_color', optional($setting)->secondary_color ?: '#074a74', ['class' => 'form-control', 'id' => 'color', 'title' => 'Choose your secondary color']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        {!! Form::text('owner_name', optional($setting)->owner_name ?: '', [
                                            'id' => 'owner-name',
                                            'class' => 'form-control',
                                            'placeholder' => 'Website',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-label">Owner Designation</label>
                                        {{ Form::text('owner_designation', optional($setting)->owner_designation ?: '', ['class' => 'form-control', 'id' => 'owner-designation']) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-label">Owner Image</label>
                                        {{ Form::file('owner_image', ['class' => 'form-control crop-input', 'id' => 'owner-image', 'accept' => 'image/*', 'data-aspect-ratio' => 1 / 1]) }}
                                        <span class="text-danger">Preferred Size 50 X 50</span>
                                    </div>
                                </div>
                                <div class="col-md-2 align-content-center">
                                    <div class="form-group">
                                        <img style="width: 80px;height: 50px;" src="{{ optional($setting)->getOwnerImage() }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Short Description<span class="text-danger">*</span></label>
                                        {!! Form::textarea('short_desc', optional($setting)->short_desc ?: '', [
                                            'id' => 'short_desc',
                                            'required' => 'true',
                                            'class' => 'form-control',
                                            'cols' => 50,
                                            'rows' => 4,
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description<span class="text-danger">*</span></label>
                                        {!! Form::textarea('description', optional($setting)->description ?: '', [
                                            'id' => 'description',
                                            'required' => 'true',
                                            'class' => 'form-control tiny',
                                            'cols' => 50,
                                            'rows' => 5,
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="update-social" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="setting-change-password-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Social Profiles</h4>
                            </div>
                            <div class="card-body">
                                {{ Form::open(['url' => route('admin.store-social-profiles'), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-facebook-f"></i>
                                            <label>Facebook</label>
                                            {!! Form::text('facebook', optional($setting)->facebook, [
                                                'id' => 'facebook',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-skype"></i>
                                            <label>Skype</label>
                                            {!! Form::text('skype', optional($setting)->skype, [
                                                'id' => 'skype',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-linkedin"></i>
                                            <label>LinkedIn</label>
                                            {!! Form::text('linkedin', optional($setting)->linkedin, [
                                                'id' => 'linkedin',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-instagram"></i>
                                            <label>Instagram</label>
                                            {!! Form::text('instagram', optional($setting)->instagram, [
                                                'id' => 'instagram',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-pinterest"></i>
                                            <label>Pinterest</label>
                                            {!! Form::text('pinterest', optional($setting)->pinterest, [
                                                'id' => 'pinterest',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-github"></i>
                                            <label>Github</label>
                                            {!! Form::text('github', optional($setting)->github, [
                                                'id' => 'github',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-youtube"></i>
                                            <label>Youtube</label>
                                            {!! Form::text('youtube', optional($setting)->youtube, [
                                                'id' => 'youtube',
                                                'placeholder' => '@username',
                                                'class' => 'form-control'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
    @endsection

    @section('page-level-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var activeTab = "{{ session('activeTab', 'update-profile') }}";

                var tabs = document.querySelectorAll('.nav-pills .nav-link');
                tabs.forEach(function(tab) {
                    if (tab.getAttribute('data-target') === '#' + activeTab) {
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
