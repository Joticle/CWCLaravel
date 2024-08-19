@extends('layouts.app')
@section('title', $page->name)

@section('content')
    <div class="container pb--100 pt--100">
        {!! $page->content !!}
    </div>
@endsection
