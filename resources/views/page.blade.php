@extends('layouts.app')
@section('title', $row->name)

@section('content')
    <div class="container pb--100 pt--100">
        {!! $row->content !!}
    </div>
@endsection
