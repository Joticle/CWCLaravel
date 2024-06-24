@extends('layouts.app')

@section('title', 'Grant Access')

@section('page-level-style')
    <style>

        fieldset {
            padding: 1px 15px 10px !important;
            border: 1px solid #ced4da !important;
            margin-bottom: 15px !important;
        }

        legend {
            width: auto !important;
            padding: 0 10px !important;
            font-weight: 400;
        }

        fieldset input[type="checkbox"] {
            float: right;
            margin-top: 5px;
            margin-right: 15px;
        }

        fieldset label {
            margin-bottom: 0px;
        }

        label {
            font-size: 14px;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Role Grant Access</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Access & Permissions</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <div class="tab-content">
                                <div id="aboutTab" class="tab-pane fade active show">
                                    <div class="profile-personal-info">
                                        {{Form::open(['url'=>route('updatePermissions'),'autocomplete'=>'off','enctype'=>'multipart/form-data'])}}
                                        <p style="width:300px">Role:
                                            {{Form::select('role',['admin'=>'Admin','client'=>'Client','staff'=>'Staff'], strtolower($role),['class'=>'form-control form-control-lg','onchange'=>'selectRole(this.value)'])}}
                                        </p>
                                        @foreach($permissions_data as $groupName=>$permissions)
                                            <fieldset class="mb-4 mt-4">
                                                <legend><h4 class="text-primary">{{beautify($groupName)}}</h4></legend>
                                                <div class="row">
                                                    @foreach($permissions as $subGroupName=>$permissionArr)
                                                        <div class="col-sm-6">
                                                            <fieldset>
                                                                <legend><h5 class="text-primary">{{beautify($subGroupName)}}</h5></legend>
                                                                <div class="row">
                                                                    @foreach($permissionArr as $permissionRow)
                                                                        @php
                                                                        $permission_value = $subGroupName.'_'.$permissionRow;
                                                                        @endphp
                                                                        <div class="col-sm-4">
                                                                            <label for="{{$permission_value}}">{{beautify($permissionRow)}}</label> <input id="{{$permission_value}}" type="checkbox" name="permissions[]" value="{{$permission_value}}" {{in_array($permission_value,$allow_permissions)?'checked':''}} >
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </fieldset>
                                        @endforeach
                                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-level-script')
    <script>
        function selectRole(_value) {
            window.location.href = '{{route('userPermissions')}}/'+_value;
        }
    </script>
@endsection
