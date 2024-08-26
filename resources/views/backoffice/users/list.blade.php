@extends('layouts.app')

@section('title', 'Manage '.ucfirst($role))

@section('page-level-style')

@endsection

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Users</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ucfirst($role)}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List {{ucfirst($role)}} Users</h4>
                    @if(hasPermissions([$role.'_add'],true))
                        <button type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> Add User</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone#</th>
                                <th>Status</th>
                                <th>C.Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index=>$row)
                                <tr>
                                    <th class="text-black">{{ $index + $data->firstItem() }}</th>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone_number}}</td>
                                    <td>
                                        @if(hasPermissions([$role.'_status_change'],true))
                                            <span class="badge">In-Active</span><label class="cl-switch"><input autocomplete="off" type="checkbox" {{$row->status=='1'?'checked':''}} onchange="updateUserStatus(this.checked,'{{$row->id}}')"><span class="switcher"></span></label><span class="badge text-blue">Active</span>
                                        @else
                                            <span class="badge">{{$row->status == '1'?'Active':'In-Active'}}</span>
                                        @endif
                                    </td>
                                    <td>{{date('d F Y',strtotime($row['created_at']))}}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if(hasPermissions([$role.'_edit'],true))
                                                &nbsp;<a href="{{route('editUser',$row['id'])}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            @endif
                                            @if(hasPermissions([$role.'_delete'],true))
                                                &nbsp;<a data-toggle="tooltip" title="Delete {{ucfirst($role)}}?" href="javascript:void(0)" data-href="{{route('deleteUser',$row['id'])}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            @endif
                                            @if(hasPermissions([$role.'_view'],true))
                                                &nbsp;<a data-toggle="tooltip" title="View User Info" href="{{route('userProfile',$row['id'])}}" class="btn btn-info shadow btn-xs sharp"><i class="fa fa-user"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">{{ $data->links() }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <!-- Modal -->
    @if(hasPermissions([$role.'_add'],true))
        <div class="modal fade" id="addUserModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" data-dismiss="modal">
                        </button>
                    </div>
                    {{Form::open(['url'=>route('addUser'),'autocomplete'=>'off','enctype'=>'multipart/form-data'])}}
                    <input type="hidden" name="role" value="{{ucfirst($role)}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Name<span class="required">*</span></label>
                                    {{Form::text('name', '',['class' => 'form-control','required'=>'true'])}}
                                </div>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Email<span class="required">*</span></label>
                                    {{Form::email('email', '',['class' => 'form-control','required'=>'true'])}}
                                </div>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Password<span class="required">*</span></label>
                                    {{Form::text('password', '',['class' => 'form-control','required'=>'true'])}}
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
    @endif

@endsection

@section('page-level-script')
    <script>
        $(document).ready(function () {
            @if(Session::has('activeModal'))
                $('#{{Session::get('activeModal')}}').modal('show');
            @endif
        });
        function updateUserStatus(_checked,user_id) {
            $.ajax({
                type: 'POST',
                url: '{{route('updateUserStatus')}}',
                data: {'status':_checked,'user_id':user_id},
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
