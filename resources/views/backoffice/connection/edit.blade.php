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
                    <h4 class="card-title">Edit {{ $singular_name }} </h4>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('admin.connection.edit', $row->id), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
                    {{-- <div class="mb-2">
                        <div class="align-items-center mb-3">
                            <div class="align-items-center d-flex flex-row justify-content-between section-header">
                                <h3 class="section-title mb-0">Connection Box</h3>
                                <a class="extra-fields-button" href="javascript:void(0)"><i
                                        class="fa fa-plus-circle mr-2 fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="row align-items-center">
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
                        @foreach ($row->categories as $index => $category)
                            <div
                                class="row align-items-center mb-3 category_records  @if (!$loop->first) remove @endif">
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        {{ Form::text('categories[][name]', $category->name, ['class' => 'form-control', 'required' => 'true', 'id' => 'text', 'placeholder' => 'Enter Category Name']) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::file('categories[][icon]', ['class' => 'form-control', 'id' => 'icon', 'accept' => 'image/*']) }}
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-4">
                                        <img style="width: 80px;height: 50px;"
                                            src="{{ $row->getCategoryIcon($category->icon) }}">
                                    </div>
                                </div>
                                @if (!$loop->first)
                                    <a href="javascript:void(0)" class="col-md-2 remove-field"><i
                                            class="fa fa-trash fa-2x"></i></a>
                                @endif
                            </div>
                        @endforeach

                        <div class="category_records_dynamic"></div>
                    </div> --}}
                    <h3>Primary Detail</h3>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Name<span class="text-danger">*</span></label>
                                {{ Form::text('name', $row->name, ['class' => 'form-control', 'required' => 'true', 'id' => 'name', 'placeholder' => 'Enter Connection Name']) }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label class="text-label">Logo<span class="text-danger">*</span></label>
                                {{ Form::file('logo', ['class' => 'form-control', 'id' => 'logo', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <img style="width: 80px;height: 50px;" src="{{ $row->getLogo() }}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Description<span class="text-danger">*</span></label>
                                {{ Form::textarea('description', $row->description, ['class' => 'form-control', 'id' => 'description']) }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Content<span class="text-danger">*</span></label>
                                {{ Form::textarea('content', $row->content, ['class' => 'form-control tiny', 'id' => 'content']) }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="align-items-center mb-3">
                                <div class="align-items-center d-flex flex-row justify-content-between section-header">
                                    <h3 class="section-title mb-0">Action Item</h3>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="text-label">Text<span class="text-danger">*</span></label>
                                        {{ Form::text('button[text]', $row->button->text, ['class' => 'form-control', 'required' => 'true', 'id' => 'text', 'placeholder' => 'Enter Action Item Text']) }}
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="text-label">URL<span class="text-danger">*</span></label>
                                        {{ Form::text('button[url]', $row->button->url, ['class' => 'form-control', 'required' => 'true', 'id' => 'url', 'placeholder' => 'Enter Action Item Url']) }}
                                    </div>
                                </div> --}}
                                <div class="col-md-2">
                                    <div class="form-group mb-0">
                                        <label class="text-label">Open in new tab?<span class="text-danger">*</span></label>
                                        <br>
                                        {{ Form::radio('button[target_blank]', '1', $row->button->target_blank == '1' ? true : false, ['id' => 'status_active']) }}
                                        <label for="status_active">Yes</label>
                                        {{ Form::radio('button[target_blank]', '0', $row->button->target_blank == '0' ? true : false, ['id' => 'status_inactive']) }}
                                        <label for="status_inactive">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Status</label>
                                <br>
                                {{ Form::radio('status', '1', $row->status == '1' ? true : false, ['id' => 'status_active']) }}
                                <label for="status_active">Active</label>
                                {{ Form::radio('status', '0', $row->status == '0' ? true : false, ['id' => 'status_inactive']) }}
                                <label for="status_inactive">Inactive</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Update {{ $singular_name }}</button>
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
                var imgTags = clonedFields.find('img').remove();
                clonedFields.appendTo('.category_records_dynamic');

                $('.category_records_dynamic .category_records').addClass('single remove');
                // $('.single .extra-fields-button').remove();
                $('.single').append(
                    '<a href="javascript:void(0)" class="col-md-2 remove-field "><i class="fa fa-trash fa-2x"></a>'
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
