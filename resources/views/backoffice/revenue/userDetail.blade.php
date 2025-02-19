@extends('backoffice.layouts.app')

@section('title', array_key_last($data['breadcrumb']))

@section('content')
    @foreach ($data['user'] as $course)
        <h1>{{ $course->user->name ?? 'N/A' }}</h1>
    @endforeach

@endsection
