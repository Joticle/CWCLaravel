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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add {{ $singular_name }}</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('admin.trust.add'), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-label">Image<span class="text-danger">*</span></label>
                                {{ Form::file('image', ['class' => 'form-control', 'required' => 'true', 'id' => 'image', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-label">URL</label>
                                {{ Form::text('button[url]', '', ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Enter Url']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-label">Open in new tab?</label>
                                <br>
                                {{ Form::radio('button[target_blank]', '1', '1', ['id' => 'target_yes']) }}
                                <label for="target_yes">Yes</label>
                                {{ Form::radio('button[target_blank]', '0', '', ['id' => 'target_no']) }}
                                <label for="target_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save {{ $singular_name }}</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
@endsection
