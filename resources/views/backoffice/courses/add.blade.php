@extends('backoffice.layouts.app')

@section('title', array_key_last($breadcrumb))

@section('page-level-style')

@endsection

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                @foreach($breadcrumb as $title=>$link)
                    <li class="breadcrumb-item {{empty($link)?'active':''}}"><a href="{{!empty($link)?$link:'javascript:void(0)'}}">{{$title}}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add {{$singular_name}}</h4>
                </div>
                <div class="card-body">
                    {{Form::open(['url'=>route('admin.course.add'),'method'=>'post','autocomplete'=>'off','files'=>true])}}
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Course Name<span class="text-danger">*</span></label>
                                {{Form::text('name', '',['class' => 'form-control','required'=>'true','id'=>'name','placeholder'=>'Enter Course Name'])}}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Course Logo<span class="text-danger">*</span></label>
                                {{ Form::file('logo', ['class' => 'form-control', 'required' => 'true', 'id' => 'logo', 'accept' => 'image/*']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Course Syllabus<span class="text-danger">*</span></label>
                                {{ Form::file('syllabuses[]', ['class' => 'form-control', 'required' => 'true', 'id' => 'syllabuses', 'accept' => '.pdf,.doc,.docx,.txt,.odt,.rtf,.xls,.xlsx,.csv,.ods', 'multiple' => true]) }}
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Course Description<span class="text-danger">*</span></label>
                                {{ Form::textarea('description', '',['class' => 'form-control tiny', 'id' => 'description']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Start Date<span class="text-danger">*</span></label>
                                {{ Form::date('start_date', '',['class' => 'form-control', 'required' => 'true', 'id' => 'start_date']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">End Date</label>
                                {{ Form::date('end_date', '',['class' => 'form-control', 'id' => 'end_date']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Price<span class="text-danger">*</span></label>
                                {{ Form::number('price', '', ['class' => 'form-control', 'required' => 'true', 'placeholder' => '0.00', 'min' => '0', 'step' => '0.01']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Level<span class="text-danger">*</span></label>
                                {{ Form::select('level', $levels, '',['class' => 'form-control', 'placeholder' => 'Select Course Level','required'=>'true']) }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="text-label">Select Course Tags<span class="text-danger">*</span></label>
                                <select id="tags" name="tags[]" multiple="multiple" class="form-control">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save {{$singular_name}}</button>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
<script>
    $(document).ready(function() {
        var allowNewTags = true;

        $('#tags').select2({
            tags: true,
            ajax: {
                url: '{{ route('admin.tags.search') }}',
                dataType: 'json',
                delay: 750,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    if (data.items && data.items.length) {
                        allowNewTags = false;
                    } else {
                        allowNewTags = true;
                    }
                    return {
                        results: $.map(data.items, function(item) {
                            return {
                                id: item.text,
                                text: item.text
                            };
                        })
                    };
                },
                cache: true
            },
            createTag: function(params) {
                var term = $.trim(params.term);
                if (!allowNewTags || term === '' || term.length < 1) {
                    return null;
                }
                return {
                    id: term,
                    text: term
                };
            },
            insertTag: function(data, tag) {
                if ($.grep(data, function(e) {
                        return e.text === tag.text;
                    }).length === 0) {
                    data.push(tag);
                }
            },
            minimumInputLength: 1
        });
    });
</script>

@endsection
