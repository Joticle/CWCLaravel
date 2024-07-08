@extends('common.dashboard')
@section('title', $title)
@section('sub-content')
    <div class="exrolled-course-wrapper-dashed">
        <h5 class="title">Wishlist</h5>
        @if ($courses->isEmpty())
            <p>No course in your wishlist.</p>
        @else
            <div class="row g-5">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        @include('includes.course-card', [
                            'course' => $course,
                            'dashboard' => true,
                        ])
                    </div>
                @endforeach
            </div>
            <div class="row mt--30">
                <div class="col-lg-12">
                    <!-- rts-pagination-area -->
                    <div class="rts-pagination-area-2">
                        {{ $courses->links() }}
                        @include('includes.paginator-counter', ['data' => $courses])
                    </div>
                    <!-- rts-pagination-area end -->
                </div>
            </div>
        @endif
    </div>
@endsection
