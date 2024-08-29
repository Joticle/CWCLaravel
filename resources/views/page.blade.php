@extends('layouts.app')
@section('title', $row->name)

@section('content')

    <!-- course details breadcrumb -->
    <div class="bg_image rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-course-left-align-wrapper">
                        <div class="meta-area">
                            @foreach ($breadcrumb as $bTile => $bLink)
                                <a href="{{ !empty($bLink) ? $bLink : '#' }}"
                                   class="{{ !empty($bLink) ? '' : 'active' }}">{{ $bTile }}</a>
                                @if (!empty($bLink))
                                    <i class="fa-regular fa-chevron-right"></i>
                                @endif
                            @endforeach
                        </div>
                        <h1 class="title">
                            {{ $row->name??'' }}
                        </h1>
                    </div>
                    <p>
                        {{ $row->description??'' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- course details breadcrumb end -->

    <div class="rts-course-area pt-5">
        <div class="container">
            <div class="pb--50">
                {!! $row->content !!}
            </div>
        </div>
    </div>
@endsection
