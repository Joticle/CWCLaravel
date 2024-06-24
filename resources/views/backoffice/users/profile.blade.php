@extends('layouts.app')

@section('title', 'Profile - '.$user->name)

@section('page-level-style')

@endsection

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>View {{$user->role}}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                @if(\Request::route()->getName() == 'userProfile')
                    <li class="breadcrumb-item active"><a href="#">Manage Users</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users',strtolower($user->role))}}">{{$user->role}}</a></li>
                @endif
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="{!! getUserImg($user->thumbnail) !!}" class="rounded-circle" alt="" style="width: 100px; height: 100px;">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{$user->name}}</h4>
                                <p>{{$user->role}}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{$user->email}}</h4>
                            </div>
                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-169px, 30px, 0px);">
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="showEditProfile()"> <i class="fa fa-pencil text-primary mr-2"></i> Edit </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#aboutTab" data-toggle="tab" class="nav-link active show">About</a></li>
                                @if(\Request::route()->getName() == 'profile' || hasPermissions([strtolower($user->role).'_edit'],true))
                                    <li class="nav-item"><a href="#updateProfileTab" data-toggle="tab" class="nav-link">Update Profile</a></li>
                                    <li class="nav-item"><a href="#updatePasswordTab" data-toggle="tab" class="nav-link">Change Password</a></li>
                                @endif
                                @if($user->role == 'Staff' || $user->role == 'Client')
                                    <li class="nav-item"><a href="#listCasesTab" data-toggle="tab" class="nav-link">{{$user->role=='Staff'?'Assinged':'Created'}} Cases <span class="badge badge-pill badge-outline-primary" style="border-radius: 10rem;">{{$cases->total()}}</span></a></li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div id="aboutTab" class="tab-pane fade active show">
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4 mt-4">Information</h4>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->email}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Date of birth <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{!empty($user->birth_date)?date('d F Y',strtotime($user->birth_date)):""}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Gender <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->gender}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Address <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->address}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Phone Number <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->phone_number}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Role <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$user->role}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Status <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{!! ($user->status == 1)? '<span class="badge light badge-success">Active</span>': '<span class="badge light badge-warning">Inactive</span>'  !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(\Request::route()->getName() == 'profile' || hasPermissions([strtolower($user->role).'_edit'],true))
                                    <div id="updateProfileTab" class="tab-pane fade">
                                        <div class="profile-personal-info">
                                            <h4 class="text-primary mb-4 mt-4">Update Profile</h4>
                                            {{Form::open(['url'=>route('updateProfile'),'autocomplete'=>'off','enctype'=>'multipart/form-data'])}}
                                            <input type="hidden" name="uid" value="{{$user->id}}">
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Name<span class="required">*</span></label>
                                                        {{Form::text('name', $user->name,['class' => 'form-control','required'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Email<span class="required">*</span></label>
                                                        {{Form::text('email', $user->email,['class' => 'form-control','disabled'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Birth Date</label>
                                                        {{Form::text('birth_date', !empty($user->birth_date)?date('Y-m-d',strtotime($user->birth_date)):'',['class' => 'form-control datepicker','readonly'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Phone Number</label>
                                                        {{Form::text('phone_number', $user->phone_number,['class' => 'form-control'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Address</label>
                                                        {{Form::text('address', $user->address,['class' => 'form-control'])}}
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Gender</label>
                                                    </div>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender-male" value="Male" {!! $user->gender == 'Male'?'checked':'' !!}>
                                                        <label class="form-check-label" for="gender-male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check d-inline-block mx-2">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender-female" value="Female" {!! $user->gender == 'Female'?'checked':'' !!}>
                                                        <label class="form-check-label" for="gender-female">
                                                            Female
                                                        </label>
                                                    </div>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender-other" value="Other" {!! $user->gender == 'Other'?'checked':'' !!}>
                                                        <label class="form-check-label" for="gender-other">
                                                            Other
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mb-2">
                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Avatar</label>
                                                        <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                                                        <small class="text-danger"><i class="fa fa-info-circle"></i> Preferred size 100x100</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                                </div>

                                            </div>
                                            {{Form::close()}}

                                        </div>
                                    </div>
                                    <div id="updatePasswordTab" class="tab-pane fade">
                                        <div class="profile-personal-info">
                                            <h4 class="text-primary mb-4 mt-4">Update Password</h4>
                                            {{Form::open(['url'=>route('updateProfilePassword')])}}
                                            <input type="hidden" name="uid" value="{{$user->id}}">
                                            <div class="row">
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Old Password<span class="required">*</span></label>
                                                        {{Form::password('old_password', ['class' => 'form-control','required'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Password<span class="required">*</span></label>
                                                        {{Form::password('password', ['class' => 'form-control','required'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label class="text-label">Confirm Password<span class="required">*</span></label>
                                                        {{Form::password('password_confirmation', ['class' => 'form-control','required'=>'true'])}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                                </div>

                                            </div>
                                            {{Form::close()}}

                                        </div>
                                    </div>
                                @endif
                                @if($user->role == 'Staff' || $user->role == 'Client')
                                    <div id="listCasesTab" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm sortable_table">

                                                        <tr>
                                                            <th>Case#</th>
                                                            {{--<th>Case Type</th>--}}
                                                            <th>Client</th>
                                                            <th>Staff</th>
                                                            <th>Status</th>
                                                            <th>C.Date</th>
                                                            <th>Action</th>
                                                        </tr>

                                                        @foreach($cases as $index=>$row)
                                                            <tr data-id="{{$row['id']}}">
                                                                {{--<th class="text-black">{{ $index + 1 }}</th>--}}
                                                                <td class="text-black">{{$row['category_info']['name']}} - {{maskCaseId($row['id'])}}</td>
                                                                <td><a target="_blank" href="{{route('userProfile',$row['client_info']['id'])}}">{{$row['client_info']['name']}}</a></td>
                                                                <td>
                                                                    @if(isset($row['staff_info']['name']) && !empty($row['staff_info']['name']))
                                                                        <a target="_blank" href="{{route('userProfile',$row['staff_info']['id'])}}">{{$row['staff_info']['name']}}</a>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($row['status'] == 'Open' && $row['staff_id'] != '0')
                                                                        <span class="label label-info">{{$row['status']}}</span>
                                                                    @endif
                                                                    @if($row['status'] == 'Open' && $row['staff_id'] == '0')
                                                                        <span class="label label-danger">Un-assign</span>
                                                                    @endif
                                                                    @if($row['status'] == 'Close')
                                                                        <span class="label label-success">{{$row['status']}}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{date('d F Y',strtotime($row['created_at']))}}</td>
                                                                <td>
                                                                    <a href="{{route('caseDetail',$row['id'])}}" class="btn btn-success shadow btn-xs sharp" data-toggle="tooltip" title="View Detail"><i class="fa fa-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="5">
                                                                {!! $cases->links() !!}
                                                                Showing {{($cases->currentpage()-1)*$cases->perpage()+1}} to {{$cases->currentpage()*$cases->perpage()}} of  {{$cases->total()}} entries
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="assignCaseModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign case to staff</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">
                    </button>
                </div>
                {{Form::open(['url'=>route('caseAssignStaff'),'autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'case_assign_staff_form'])}}
                <input type="hidden" name="case_id" id="case_id" value="" required>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-group">
                                <label class="text-label">Question<span class="required">*</span></label>
                                {{Form::select('staff', $staff_users, '',['class' => 'form-control','required'=>'true','placeholder'=>'Please Select Staff'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection

@section('page-level-script')
    <script>
        $(document).ready(function () {
            @if(Session::has('activeTab'))
                $('a[href="#{{Session::get('activeTab')}}"]').trigger('click')
            @endif
            $('.datepicker').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });
        });
        function showEditProfile() {
            $('a[href="#updateProfileTab"]').trigger('click')
        }

        /*cases script*/
        function assignCase(case_id) {
            $('#case_assign_staff_form')[0].reset();
            $('#case_id').val(case_id);
            $('#assignCaseModal').modal('show');

        }
        function unassignCase(case_id) {
            swal({
                title: "Are you sure?",
                text: "You want to un-assign the staff from this case?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = '{{route('caseUnAssignStaff')}}/'+case_id;
                }
            });
        }
    </script>
@endsection
