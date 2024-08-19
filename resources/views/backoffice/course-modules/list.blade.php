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
                    <h4 class="card-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#selectCourseModal" title="Select Another Course">Select Course <i class="fa fa-pencil"></i></a></h4>
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
                                <th>Level</th>
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
                                    <td><span class="badge badge-{{ $course->badgeClass }}">{{ $course->level }}</span></td>
                                    <td>{{_date($course->created_at)}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('admin.course.edit',$course->id)}}" data-toggle="tooltip" title="Edit {{$singular_name}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            &nbsp;<a data-toggle="tooltip" title="Delete {{$singular_name}}" href="{{route('admin.course.delete',$course->id)}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
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
                        <h4 class="card-title">List {{$pulular_name}}</h4>
                        <a href="javascript:void(0)" onclick="addCourseModule()" data-toggle="tooltip" title="Add New {{$singular_name}}" type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0"><i class="fa fa-plus"></i> Add {{$singular_name}}</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm sortable_table">

                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
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
                                            <td>{{_date($row->start_date)}}</td>
                                            <td>{{!empty($row->end_date)?_date($row->end_date):'---'}}</td>
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
                                                    <a onclick="editCourseModule('{{$row->id}}')" href="javascript:void(0)" data-toggle="tooltip" title="Edit {{$singular_name}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    &nbsp;<a data-toggle="tooltip" title="Delete {{$singular_name}}" href="{{route('admin.course.module.delete',$row->id)}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    &nbsp;<a data-toggle="tooltip" title="Add Course Module Content" href="{{route('admin.course.content.list',$row->id)}}" class="btn btn-success shadow btn-xs sharp"><i class="flaticon-381-map-1"></i></a>
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
    <div class="modal fade" id="selectCourseModal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Course</h5>
                    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Select Course<span class="text-danger">*</span></label>
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
        <div class="modal fade" id="addCourseModule">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course Module</h5>
                        <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
                    </div>
                    {{Form::open(['url'=>route('admin.course.module.add',$course->id),'method'=>'post','autocomplete'=>'off'])}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Module Name<span class="text-danger">*</span></label>
                                    {{Form::text('name', '',['class' => 'form-control','required'=>'true','id'=>'name','placeholder'=>'Enter Module Name'])}}
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Module Description<span class="text-danger">*</span></label>
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
    <div class="modal fade" id="editCourseModule">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="edit-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Course Module</h5>
                    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="spinner-grow" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    delay: 500,
                    data: function (params) {
                        return {
                            q: params.term || '',
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.items,
                        };
                    },
                    cache: true
                },
                placeholder: 'Search Course',
                minimumInputLength: 0,
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
        function formatRepo (repo) {
            if (repo.loading) {
                return repo.name;
            }
            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__avatar'><img style='width: 50px;' src='" + repo.logo + "' /></div>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'></div>" +
                "<div class='select2-result-repository__description'></div>" +
                "<div class='select2-result-repository__statistics'>" +
                "<div class='select2-result-repository__forks'><i class='fa fa-clock-o'></i> </div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
            $container.find(".select2-result-repository__title").text(repo.text);
            $container.find(".select2-result-repository__description").text(repo.description);
            $container.find(".select2-result-repository__forks").append(repo.start_date);
            return $container;
        }
        function formatRepoSelection (repo) {
            if(typeof (repo.id) != 'undefined' && repo.id != ''){
                showLoader();
                window.location.href='{{route('admin.course.module.list')}}/'+repo.id;
                return repo.name;
            }
        }
        function editCourseModule(_id) {
            $('#editCourseModule').modal('show');
            showLoader();
            $.ajax({
                type: 'GET',
                url: '{{route('admin.course.module.edit')}}/'+_id,
                data: {},
                cache: false,
                success: function(result){
                    hideLoader();
                    try {
                        result = JSON.parse(result);
                    }catch(e) {}
                    if($.trim(result.success) == 'true'){
                        //successMsg(result.message)
                        $('#edit-modal-content').html(result.html);
                        tinymceReInit('tiny-'+_id);
                    }else{
                        var errorsShow = '';
                        $.each(result.message, function(k, v) {
                            errorMsg(v);
                        });
                    }
                },
                error: function (request, status, error) {
                    hideLoader();
                    errorMsg(error);
                }
            });
        }
        function addCourseModule(){
            $('#addCourseModule').modal('show');
            tinymceReInit('tiny');
        }
        function setSorting(obj_sort) {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.course.module.sort')}}',
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
    </script>

@endsection
