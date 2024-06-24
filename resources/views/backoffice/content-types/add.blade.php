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
                    <h4 class="card-title">Add {{$singular_name}}</h4>
                </div>
                <div class="card-body">
                    {{Form::open(['url'=>route('admin.content-type.add'),'method'=>'post','autocomplete'=>'off','files'=>true])}}
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Name<span class="text-danger">*</span></label>
                                {{Form::text('name', '',['class' => 'form-control','required'=>'true','id'=>'name','placeholder'=>'Enter Content Name'])}}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Type</label>
                                {{ Form::select('type', getContentList(), '',['class' => 'form-control', 'placeholder' => 'Select Content Type','required'=>'true']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save {{$singular_name}}</button>
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
