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
                    {{ Form::open(['url' => route('admin.trust.edit', $row->id), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                    <div class="row mb-2">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-label">Image</label>
                                {{ Form::file('image', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <img style="width: 80px;height: 50px;" src="{{ $row->getImage() }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-label">URL</label>
                                {{ Form::text('button[url]', optional($row->button)->url, ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Enter Button Url']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-label">Open in new tab?</label>
                                <br>
                                {{ Form::radio('button[target_blank]', '1', optional($row->button)->target_blank == '1' ? true : false, ['id' => 'target_yes']) }}
                                <label for="target_yes">Yes</label>
                                {{ Form::radio('button[target_blank]', '0', optional($row->button)->target_blank == '0' ? true : false, ['id' => 'target_no']) }}
                                <label for="target_no">No</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Status</label>
                                <br>
                                {{ Form::radio('status', '1', $row->status == '1' ? true : false, ['id' => 'status_active']) }}
                                <label for="status_active">Active</label>
                                {{ Form::radio('status', '0', $row->status == '0' ? true : false, ['id' => 'status_inactive']) }}
                                <label for="status_inactive">Inactive</label>
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
