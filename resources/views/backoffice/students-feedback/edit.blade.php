@extends('backoffice.layouts.app')

@section('title', array_key_last($breadcrumb))

@section('page-level-style')

@endsection

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                @foreach($breadcrumb as $title=>$link)
                    <li class="breadcrumb-item {{empty($link)?'active':''}}"><a href="{{!empty($link)?$link:'javascript:void(0)'}}">{{$title}}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit {{$singular_name}} </h4>
                </div>
                <div class="card-body">
                    {{Form::open(['url'=>route('admin.student-feedback.edit',$row->id),'method'=>'post','autocomplete'=>'off','files'=>true])}}
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Name<span class="text-danger">*</span></label>
                                {{Form::text('name', $row->name,['class' => 'form-control','required'=>'true','id'=>'name','placeholder'=>'Enter Name'])}}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Designation<span class="text-danger">*</span></label>
                                {{Form::text('designation', $row->designation,['class' => 'form-control','required'=>'true','id'=>'designation','placeholder'=>'Enter Designation'])}}
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="text-label">Image</label>
                                {{ Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <img style="width: 80px;height: 50px;" src="{{$row->getImage()}}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Text<span class="text-danger">*</span></label>
                                {{ Form::textarea('text', $row->text,['class' => 'form-control', 'id' => 'text']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Rating</label>
                                {{ Form::select('rating', $ratings, $row->rating,['class' => 'form-control', 'placeholder' => 'Select Rating','required'=>'true']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Status</label>
                                <br>
                                {{ Form::radio('status', '1', $row->status=='1'?true:false, ['id' => 'status_active']) }}
                                <label for="status_active">Active</label>
                                {{ Form::radio('status', '0', $row->status=='0'?true:false, ['id' => 'status_inactive']) }}
                                <label for="status_inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Update {{$singular_name}}</button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
@endsection
