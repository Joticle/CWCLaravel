@extends('backoffice.layouts.app')

@section('title', array_key_last($breadcrumb))

@section('page-level-style')

@endsection

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @foreach ($breadcrumb as $title => $link)
                    <li class="breadcrumb-item {{ empty($link) ? 'active' : '' }}"><a
                            href="{{ !empty($link) ? $link : 'javascript:void(0)' }}">{{ $title }}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add {{ $singular_name }}</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('admin.connection.add'), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Name<span class="text-danger">*</span></label>
                                {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'true', 'id' => 'name', 'placeholder' => 'Enter Connection Name']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Logo<span class="text-danger">*</span></label>
                                {{ Form::file('logo', ['class' => 'form-control', 'required' => 'true', 'id' => 'logo', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Description<span class="text-danger">*</span></label>
                                {{ Form::textarea('description', '', ['class' => 'form-control', 'id' => 'description']) }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="align-items-center mb-3">
                            <div class="align-items-center d-flex flex-row justify-content-between section-header">
                                <h3 class="section-title mb-0">Button</h3>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="text-label">Text<span class="text-danger">*</span></label>
                                    {{ Form::text('button[text]', '', ['class' => 'form-control', 'required' => 'true', 'id' => 'text', 'placeholder' => 'Enter Button Text']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="text-label">URL<span class="text-danger">*</span></label>
                                    {{ Form::text('button[url]', '', ['class' => 'form-control', 'required' => 'true', 'id' => 'url', 'placeholder' => 'Enter Button Url']) }}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-0">
                                    <label class="text-label">Open in new tab?<span class="text-danger">*</span></label>
                                    <br>
                                    {{ Form::radio('button[target_blank]', '1', '1', ['id' => 'status_active']) }}
                                    <label for="status_active">Yes</label>
                                    {{ Form::radio('button[target_blank]', '0', '', ['id' => 'status_inactive']) }}
                                    <label for="status_inactive">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="align-items-center mb-3">
                            <div class="align-items-center d-flex flex-row justify-content-between section-header">
                                <h3 class="section-title mb-0">Categories</h3>
                                <a class="extra-fields-button" href="javascript:void(0)"><i
                                        class="fa fa-plus-circle mr-2 fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="text-label">Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="text-label">Icon<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3 category_records">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" name="categories[][name]"
                                        placeholder="Enter Category Name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{ Form::file('categories[][icon]', ['class' => 'form-control', 'required' => 'true', 'id' => 'icon', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="category_records_dynamic"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save {{ $singular_name }}</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
    <script>
        $(document).ready(function() {

            $('.extra-fields-button').click(function() {

                var clonedFields = $('.category_records').first().clone();
                clonedFields.find('input').each(function() {
                    $(this).val('');
                });
                clonedFields.appendTo('.category_records_dynamic');

                $('.category_records_dynamic .category_records').addClass('single remove');
                // $('.single .extra-fields-button').remove();
                $('.single').append(
                    '<a href="javascript:void(0)" class="col-md-2 remove-field"><i class="fa fa-trash fa-2x"></a>'
                );
                $('.category_records_dynamic > .single').attr("class",
                    "row align-items-center mb-3 remove");

                $('.category_records_dynamic input').each(function() {
                    var count = 0;
                    var fieldname = $(this).attr("name");
                    $(this).attr('name', fieldname);
                    count++;
                });

            });

            $(document).on('click', '.remove-field', function(e) {
                $(this).parent('.remove').remove();
                e.preventDefault();
            });
        });
    </script>

@endsection
