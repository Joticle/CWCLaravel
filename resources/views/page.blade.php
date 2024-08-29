@extends('layouts.app')
@section('title', $row->name)

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="title">{{ $row->name }}</h1>
        </div>
        <div class="pb--50">
            {!! $row->content !!}
        </div>
    </div>
@endsection
