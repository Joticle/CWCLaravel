@extends('backoffice.layouts.app')

@section('title', array_key_last($breadcrumb))

@section('page-level-style')
    <style>
        .ui-sortable-helper{
            background: #ddd;
            display: table;
        }
    </style>
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
                    <h4 class="card-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#selectCourseModuleModal" title="Select Another Course Module">Select Course Module <i class="fa fa-pencil"></i></a></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($course)
                                <tr>
                                    <td>{{$course->name}}</td>
                                    <td><img style="width: 80px;height: 50px;" src="{{$course->getLogo()}}"></td>
                                    <td>{{_date($course->start_date)}}</td>
                                    <td>{{!empty($course->end_date)?_date($course->end_date):'---'}}</td>
                                    <td>
                                        @if($course->status == '1')
                                            <span class="badge badge-primary">Active</span>
                                        @else
                                            <span class="badge badge-danger">In-Active</span>
                                        @endif
                                    </td>
                                    <td>{{_date($course->created_at)}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('admin.course.edit',$course->id)}}" data-toggle="tooltip" title="Edit {{$singular_name}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            &nbsp;<a data-toggle="tooltip" title="Delete {{$singular_name}}" href="javascript:void(0)" data-href="{{route('admin.course.delete',$course->id)}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <table class="table table-responsive-sm">
                                            <tr>
                                                <th>Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                {{--<th>Action</th>--}}
                                            </tr>
                                            <tr>
                                                <td>{{$courseModule->name}}</td>
                                                <td>{{_date($courseModule->start_date)}}</td>
                                                <td>{{!empty($courseModule->end_date)?_date($courseModule->end_date):'---'}}</td>
                                                <td>
                                                    @if($courseModule->status == '1')
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">In-Active</span>
                                                    @endif
                                                </td>
                                                <td>{{_date($courseModule->created_at)}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($course)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><span class="badge badge-success">{{$courseModule->name}}</span> {{$pulular_name}}</h4>
                        <a href="javascript:void(0)" onclick="addCourseModuleContent()" data-toggle="tooltip" title="Add New {{$singular_name}}" type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0"><i class="fa fa-plus"></i> Add {{$singular_name}}</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm sortable_table">

                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Content Type</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                    <th>Sort</th>
                                </tr>

                                @if($data->count() > 0)
                                    @foreach($data as $index=>$row)
                                        <tr data-id="{{$row->id}}">
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$content_types[$row->content_type_id]['name']}}</td>
                                            <td>
                                                @if($content_types[$row->content_type_id]['type'] == 'file' || $content_types[$row->content_type_id]['type'] == 'image')
                                                    <a target="_blank" href="{{asset('/uploads/course-module-content/'.$row->id.'/'.$row->value)}}"><i class="fa fa-download"></i> Download</a>
                                                @elseif($content_types[$row->content_type_id]['type'] == 'link')
                                                    <a href="{{$row->value}}" target="_blank">{{$row->value}}</a>
                                                @else
                                                    {{Str::words(strip_tags($row->value), 3, '...');}}
                                                @endif

                                            </td>
                                            <td>
                                                @if($row->status == '1')
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td>{{_date($row->created_at)}}</td>
                                            <td>
                                                <div class="d-flex">
                                                   <a data-toggle="tooltip" title="Delete {{$singular_name}}" href="javascript:void(0)" data-href="{{route('admin.course.content.delete',$row->id)}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td class="drag"><i class="fa fa-arrows" style="cursor: pointer"></i></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No record found.</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- row -->
    {{--Models--}}
    <div class="modal fade" id="selectCourseModuleModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Course Module</h5>
                    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Select Course Module<span class="text-danger">*</span></label>
                                {{Form::select('course_id', [],'' ,['class' => 'form-control','required'=>'true','id'=>'select_search_course'])}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if($course)
        <div class="modal fade" id="addCourseModuleContent">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course Module Content </h5>
                        <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
                    </div>
                    {{Form::open(['url'=>route('admin.course.content.add',$courseModule->id),'method'=>'post','autocomplete'=>'off','files'=>'true'])}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Content Type<span class="text-danger">*</span></label>
                                    <select name="content_type" class="form-control" required="true" onchange="drawContentType(this)">
                                        <option value="">Select Content Type</option>
                                        @foreach($content_types as $content_type)
                                            <option value="{{$content_type['id']}}" data-type="{{$content_type['type']}}">{{$content_type['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Content Name<span class="text-danger">*</span></label>
                                    {{Form::text('name', '',['class' => 'form-control','required'=>'true','placeholder'=>'Enter Content Name'])}}
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group" id="content_type_field">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save {{$singular_name}}</button>
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    @endif
    <div style="display: none">
        @foreach(getContentList() as $contentType=>$contentTypeName)
            @if($contentType == 'file')
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Select File<span class="text-danger">*</span></label>
                    {{Form::file('value', ['class' => 'form-control','required'=>'true'])}}
                </div>
            @elseif($contentType == 'image')
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Select Image<span class="text-danger">*</span></label>
                    {{Form::file('value', ['class' => 'form-control','required'=>'true', 'accept' => 'image/*'])}}
                </div>
            @elseif($contentType == 'link')
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Enter Link<span class="text-danger">*</span></label>
                    {{Form::url('value', '',['class' => 'form-control','required'=>'true','pattern'=>'https?://.*', 'placeholder'=>'https://example.com'])}}
                </div>
            @elseif($contentType == 'embedded-video')
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Enter Embedded Video Link<span class="text-danger">*</span></label>
                    {{Form::textarea('value', '',['class' => 'form-control','required'=>'true', 'placeholder'=>'Enter Embedded Video Link'])}}
                </div>
            @elseif($contentType == 'paragraph')
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Enter Paragraph<span class="text-danger">*</span></label>
                    {{Form::textarea('value', '',['class' => 'form-control','required'=>'true', 'placeholder'=>'Enter Your Paragraph'])}}
                </div>
            @else
                <div id="content_type_{{$contentType}}">
                    <label class="text-label">Enter {{$contentType}}<span class="text-danger">*</span></label>
                    {{Form::text('value', '',['class' => 'form-control','required'=>'true'])}}
                </div>
            @endif
        @endforeach
    </div>
@endsection

@section('page-level-script')
    <script src="https://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function () {
            @if(Session::has('activeModal'))
$('#{{Session::get('activeModal')}}').modal('show');
            @endif
$("#select_search_course").select2({
                ajax: {
                    url: '{{route('admin.course.search')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            with: 'modules'
                        };
                    },
                    processResults: function (data) {
                        // Make sure the data is in the correct format
                        return {
                            results: data.items.map(course => ({
                                id: course.id,
                                text: course.text,
                                logo: course.logo,
                                start_date: course.start_date,
                                end_date: course.end_date,
                                description: course.description,
                                children: course.children.map(courseModule => ({
                                    id: courseModule.id,
                                    text: courseModule.name,
                                    start_date: courseModule.start_date,
                                    end_date: courseModule.end_date
                                }))
                        }))
                    };
                    },
                    cache: true
                },
                placeholder: 'Search Course',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            {{--Fields Sorting--}}
$(".sortable_table").sortable({
                items: 'tr:not(tr:first-child)',
                cursor: 'pointer',
                axis: 'y',
                handle: 'td.drag',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                    //console.log(ui.item.width())
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    var obj_sort = {};
                    $(this).find("tr").each(function (index) {
                        if (index > 0) {
                            let row_id = $(this).attr("data-id");
                            obj_sort[row_id] = index;
                        }
                    }).promise().done( function(){ setSorting(obj_sort); } );
                }
            });

        });
        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $html = "<div class='select2-result-repository clearfix'>";
            if(typeof (repo.logo) != 'undefined' && repo.logo != ''){
                $html += "<div class='select2-result-repository__avatar'><img style='width: 50px;' src='" + repo.logo + "' /></div>";
            }
            $html += "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'></div>";

            if(typeof (repo.description) != 'undefined' && repo.description != ''){
                $html += "<div class='select2-result-repository__description'></div>";
            }


            $html += "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-clock-o'></i> </div>" +
                "</div>" +
                "</div>" +
                "</div>";
            var $container = $($html);
            $container.find(".select2-result-repository__title").text(repo.text);
            $container.find(".select2-result-repository__description").text(repo.description);
            $container.find(".select2-result-repository__forks").append(repo.start_date+' - '+repo.end_date);
            return $container;
        }
        function formatRepoSelection(repo) {
            if (typeof (repo.id) != 'undefined' && repo.id != '') {
                showLoader();
                window.location.href = '{{route('admin.course.content.list')}}/' + repo.id;
                return repo.text;
            }
        }
        function addCourseModuleContent(){
            $('#addCourseModuleContent').modal('show');
        }
        function setSorting(obj_sort) {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.course.content.sort')}}',
                data: {'sorting':obj_sort},
                cache: false,
                success: function(result){

                    try {
                        result = JSON.parse(result);
                    }catch(e) {}
                    if($.trim(result.success) == 'true'){
                        successMsg(result.message);
                    }else{
                        var errorsShow = '';
                        $.each(result.message, function(k, v) {
                            errorsShow += v+'<br>';
                        });
                        errorMsg(errorsShow);
                    }
                },
                error: function (request, status, error) {
                    errorMsg(error);
                }
            });
        }

        function drawContentType(obj) {
            $('#content_type_field').html('');
            var container = $(obj);
            var value = $.trim($(obj).val());
            if(value != ''){
                var field_type = $('option:selected', obj).attr('data-type');
                $('#content_type_field').html($('#content_type_'+field_type).html());
            }
        }
    </script>

@endsection
