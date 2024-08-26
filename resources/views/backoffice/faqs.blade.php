@extends('layouts.app')

@section('title', 'Manage FAQs')

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
                <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">FAQs</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List FAQs</h4>
                    @if(hasPermissions(['faq_add'],true))
                        <button type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0" data-toggle="modal" data-target="#addFaqModal"><i class="fa fa-plus"></i> Add FAQ</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm sortable_table">

                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                @if(hasPermissions(['faq_edit'],true))
                                    <th>Sort</th>
                                @endif
                                <th>Action</th>
                            </tr>

                            @foreach($data as $index=>$row)
                                <tr data-id="{{$row['id']}}">
                                    <th class="text-black">{{ $index + 1 }}</th>
                                    <td>{{$row['question']}}</td>
                                    <td>{{$row['answer']}}</td>
                                    @if(hasPermissions(['faq_edit'],true))
                                        <td class="drag"><i class="fa fa-arrows" style="cursor: pointer"></i></td>
                                    @endif
                                    <td>
                                        <div class="d-flex">
                                            @if(hasPermissions(['faq_edit'],true))
                                                <a href="#" data-toggle="modal" data-target="#editCategory{{$row['id']}}Modal" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                <!-- Modal Edit-->
                                                <div class="modal fade" id="editCategory{{$row['id']}}Modal">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit FAQ</h5>
                                                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                            </div>
                                                            {{Form::open(['url'=>route('updateFaq',$row['id']),'autocomplete'=>'off','enctype'=>'multipart/form-data'])}}
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 mb-2">
                                                                        <div class="form-group">
                                                                            <label class="text-label">Question<span class="required">*</span></label>
                                                                            {{Form::text('question', $row['question'],['class' => 'form-control','required'=>'true'])}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-2">
                                                                        <div class="form-group">
                                                                            <label class="text-label">Answer<span class="required">*</span></label>
                                                                            {{Form::textarea('answer', $row['answer'],['class' => 'form-control','required'=>'true'])}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                            {{Form::close()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(hasPermissions(['faq_delete'],true))
                                                &nbsp;<a data-toggle="tooltip" title="Delete Category" href="javascript:void(0)" data-href="{{route('deleteFaq',$row['id'])}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <!-- Modal -->
    <div class="modal fade" id="addFaqModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add FAQ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">
                    </button>
                </div>
                {{Form::open(['url'=>route('faqAdd'),'autocomplete'=>'off','enctype'=>'multipart/form-data'])}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Question<span class="required">*</span></label>
                                {{Form::text('question', '',['class' => 'form-control','required'=>'true'])}}
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Answer<span class="required">*</span></label>
                                {{Form::textarea('answer', '',['class' => 'form-control','required'=>'true'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                {{Form::close()}}
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
        function setSorting(obj_sort) {
            $.ajax({
                type: 'POST',
                url: '{{route('setFaqSorting')}}',
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
