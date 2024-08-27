@extends('layouts.app')
@section('title', $title)
@section('content')
    {{-- bread crumb area --}}
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Course</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            @foreach ($breadcrumb as $bTile => $bLink)
                                <a href="{{ !empty($bLink) ? $bLink : '#' }}">{{ $bTile }}</a>
                                @if (!empty($bLink))
                                    <i class="fa-regular fa-chevron-right"></i>
                                @endif
                            @endforeach
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- bread crumb area end --}}
    <!-- course area start -->
    <div class="rts-course-default-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3">
                    <!-- course-filter-area start -->
                    <div class="rts-course-filter-area">
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Search</h6>
                            <div class="search-filter filter-body">
                                <div class="input-wrapper">
                                    <input type="text" placeholder="Search Course...">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Level</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="checkbox-wrapper">
                                    @foreach ($levels as $index => $level)
                                        <div class="single-checkbox-filter">
                                            <div class="check-box">
                                                <input name="level" type="checkbox" id="lavel-{{ $index }}"
                                                    value="{{ $index }}">
                                                <label for="lavel-{{ $index }}">{{ $level }}</label><br>
                                            </div>
                                            {{-- <span class="number">(130)</span> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Tag</h6>
                            <div class="checkbox-filter filter-body">
                                <div class="search-filter filter-body mb--0">
                                    <div class="input-wrapper">
                                        <input id="tag-search" type="text" placeholder="Search Tag...">
                                        <i class="fa-light fa-magnifying-glass"></i>
                                    </div>
                                </div>
                                <div id="tagList" class="checkbox-wrapper">

                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Price</h6>
                            <div class="checkbox-filter filter-body last">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="price-1">
                                            <label for="price-1">Free</label><br>
                                        </div>
                                        <span class="number">(6)</span>
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input type="checkbox" id="price-2">
                                            <label for="price-2">Paid</label><br>
                                        </div>
                                        <span class="number">(80)</span>
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <a href="#" class="rts-btn btn-border"><i class="fa-regular fa-x"></i> Clear All Filters</a>
                    </div>
                    <!-- course-filter-area end -->
                </div>
                <div class="col-lg-9">
                    <div class="row g-5 mt--10">
                        @foreach ($courses as $course)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                @include('includes.course-card', [
                                    'course' => $course,
                                    'dashboard' => false,
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
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Initial load
            loadTags(); // Load default 10 tags on page load

            // Search functionality
            $('#tag-search').on('input', function() {
                const searchTerm = $(this).val();
                loadTags(searchTerm);
            });
        });

        function loadTags(searchTerm = '') {

            $.ajax({
                url: '{{ route('tags.search') }}', // Replace with your API endpoint
                dataType: 'json',
                data: {
                    q: searchTerm
                },
                success: function(data) {
                    if(data.success == true) {
                        $('#tagList').html(data.html);
                    }
                },
                error: function() {
                }
            });
        }
    </script>
@endpush
