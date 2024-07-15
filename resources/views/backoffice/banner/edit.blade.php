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
                    <h4 class="card-title">Edit {{ $singular_name }} </h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('admin.banner.edit', $row->id), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Pre Title<span class="text-danger">*</span></label>
                                {{ Form::text('pre_title', $row->pre_title, ['class' => 'form-control', 'required' => 'true', 'id' => 'pre_title', 'placeholder' => 'Enter Pre Title']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Title<span class="text-danger">*</span></label>
                                {{ Form::text('title', $row->title, ['class' => 'form-control', 'required' => 'true', 'id' => 'title', 'placeholder' => 'Enter Title']) }}
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="text-label">Image<span class="text-danger">*</span></label>
                                {{ Form::file('image', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <img style="width: 80px;height: 50px;" src="{{ $row->getImage() }}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Description<span class="text-danger">*</span></label>
                                {{ Form::textarea('description', $row->description, ['class' => 'form-control', 'id' => 'description']) }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Status</label>
                                <br>
                                {{ Form::radio('status', '1', $row->status == '1' ? true : false, ['id' => 'status_active']) }}
                                <label for="status_active">Active</label>
                                {{ Form::radio('status', '0', $row->status == '0' ? true : false, ['id' => 'status_inactive']) }}
                                <label for="status_inactive">Inactive</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="align-items-center mb-3">
                                <div class="align-items-center d-flex flex-row justify-content-between section-header">
                                    <h3 class="section-title mb-0">Button</h3>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="text-label">Text</label>
                                        {{ Form::text('button[text]', optional($row->button)->text, ['class' => 'form-control', 'id' => 'text', 'placeholder' => 'Enter Button Text']) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="text-label">URL</label>
                                        {{ Form::text('button[url]', optional($row->button)->url, ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Enter Button Url']) }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0">
                                        <label class="text-label">Open in new tab?</label>
                                        <br>
                                        {{ Form::radio('button[target_blank]', '1', optional($row->button)->target_blank == '1' ? true : false, ['id' => 'status_active']) }}
                                        <label for="status_active">Yes</label>
                                        {{ Form::radio('button[target_blank]', '0', optional($row->button)->target_blank == '0' ? true : false, ['id' => 'status_inactive']) }}
                                        <label for="status_inactive">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Update {{ $singular_name }}</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
@endsection
