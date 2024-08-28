@extends('layouts.app')
@section('title', $title)
@section('content')
    {{-- bread crumb area --}}
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image pt--30 pb--30">
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
    <div class="rts-course-default-area rts-section-gap pt--30">
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
                                    <input id="text-search" type="text" placeholder="Search Course...">
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
                                <div class="search-filter mb--0">
                                    <div class="input-wrapper">
                                        <input id="tag-search" type="text" placeholder="Search Tag...">
                                        <i class="fa-light fa-magnifying-glass"></i>
                                    </div>
                                    <div class="course-single-information">
                                        <div class="body">
                                            <div id="selected-tags" class="tags-wrapper">
                                            </div>
                                        </div>
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
                                            <input name="price" value="0" type="checkbox" id="price-1">
                                            <label for="price-1">Free</label><br>
                                        </div>
                                        {{-- <span class="number">(6)</span> --}}
                                    </div>
                                    <!-- single check box end -->
                                    <!-- single check box -->
                                    <div class="single-checkbox-filter">
                                        <div class="check-box">
                                            <input name="price" value="1" type="checkbox" id="price-2">
                                            <label for="price-2">Paid</label><br>
                                        </div>
                                        {{-- <span class="number">(80)</span> --}}
                                    </div>
                                    <!-- single check box end -->
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                        <a href="javascript:void(0)" class="rts-btn btn-border clear-filters"><i
                                class="fa-regular fa-x"></i> Clear All Filters</a>
                    </div>
                    <!-- course-filter-area end -->
                </div>
                <div id="course-list" class="col-lg-9">
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
            $('#tag-search').on('input', debounce(function() {
                const searchTerm = $(this).val();
                loadTags(searchTerm);
            }, 500));

            // Event listeners for filters

            // Search input for courses
            $('#text-search').on('input', debounce(function() {
                triggerAjaxCall();
            }, 500));

            // Checkbox inputs for levels, tags, and prices
            $('input[name="level"]').on('change', function() {
                triggerAjaxCall();
            });
            $('input[name="price"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('input[name="price"]').not(this).prop('checked', false);
                }

                triggerAjaxCall();
            });

            // Tag checkbox handling
            $('#tagList').on('change', 'input[name="tag"]', function() {
                const tagName = $(this).val();

                if ($(this).is(':checked')) {
                    // Add the tag to the selectedTags array if checked
                    if (!selectedTags.includes(tagName)) {
                        selectedTags.push(tagName);
                    }
                    // Update the display and trigger an AJAX call
                    updateSelectedTagsDisplay();
                    triggerAjaxCall();
                } else {
                    // Remove the tag from the selectedTags array if unchecked
                    removeTag(tagName);
                }
            });

            // Clear all filters
            $('.clear-filters').on('click', function(e) {
                e.preventDefault();

                // Clear all inputs and checkboxes
                $('#text-search, #tag-search').val('');
                $('input[name="level"], input[name="tag"], input[name="price"]').prop('checked', false);

                // Clear the selectedTags array and update the display
                selectedTags = [];
                updateSelectedTagsDisplay();

                // Trigger AJAX call with cleared filters
                triggerAjaxCall();
            });

        });

        // get tags using ajax
        function loadTags(searchTerm = '') {

            $.ajax({
                url: '{{ route('tags.search') }}', // Replace with your API endpoint
                dataType: 'json',
                data: {
                    q: searchTerm
                },
                success: function(data) {
                    if (data.success == true) {
                        $('#tagList').html(data.html);
                    }
                },
                error: function() {}
            });
        }

        var selectedTags = [];

        // Function to update the selected tags display
        function updateSelectedTagsDisplay() {
            const $selectedTagsContainer = $('#selected-tags');
            $selectedTagsContainer.empty(); // Clear existing tags

            selectedTags.forEach(function(tag) {
                $selectedTagsContainer.append(`
                    <span class="selected-tag" data-tag-name="${tag}">
                        ${tag} <i class="fa fa-times remove-tag" aria-hidden="true" data-tag-name="${tag}"></i>
                    </span>
                `);
            });

        }

        // Reattach click event listener for cross icons
        $('#selected-tags').on('click', '.remove-tag', function() {
            const tagName = $(this).data('tag-name');
            removeTag(tagName);
        });

        // Function to remove a tag from the selected tags array
        function removeTag(tagName) {
            selectedTags = selectedTags.filter(tag => tag !== tagName);

            // Uncheck the checkbox corresponding to the removed tag
            $(`#tagList input[value="${tagName}"]`).prop('checked', false);

            // Update the display and trigger an AJAX call
            updateSelectedTagsDisplay();
            triggerAjaxCall();
        }


        // Function to get all filter values
        function getFilterValues() {
            const filters = {};

            // Get course search text
            filters.search = $('#text-search').val();

            // Get selected levels
            filters.levels = [];
            $('input[name="level"]:checked').each(function() {
                filters.levels.push($(this).val());
            });

            // Get selected tags from the selectedTags array
            filters.tags = selectedTags;


            const checkedPrice = $('input[name="price"]:checked').val();
            if (checkedPrice !== undefined) {
                filters.price = checkedPrice;
            } else {
                delete filters.price; // Remove the price filter if none are checked
            }

            return filters;
        }

        // Function to trigger AJAX call
        function triggerAjaxCall() {
            const filterValues = getFilterValues();

            $.ajax({
                url: '{{ route('courses.search') }}',
                method: 'GET',
                data: filterValues,
                success: function(response) {
                    if(response.success) {
                        $('#course-list').html(response.html);
                    }
                    else {
                        $('#course-list').html('<div class="d-flex justify-content-center"><h6 class="mt--100 title">No Course Found</h6></div>');
                    }

                },
                error: function(xhr, status, error) {
                    // Handle any errors here
                    console.error(error);
                }
            });
        }
    </script>
@endpush
