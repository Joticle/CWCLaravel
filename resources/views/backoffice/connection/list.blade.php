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
                    <h4 class="card-title">List {{$pulular_name}}</h4>

                    <a href="{{route('admin.connection.add')}}" type="button" class="btn btn-primary btn-sm mt-3 mt-sm-0"><i class="fa fa-plus"></i> Add {{$singular_name}}</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data->count() > 0)
                                @foreach($data as $index=>$row)
                                    <tr>
                                        <td><strong>{{ $index + $data->firstItem() }}</strong></td>
                                        <td>{{$row->name}}</td>
                                        <td><img style="width: 80px;height: 50px;" src="{{$row->getLogo()}}"></td>
                                        <td>
                                            @if($row->status == '1')
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-danger">In-Active</span>
                                            @endif
                                        </td>
                                        <td>{{_date($row->created_at)}}</td>
                                        <td>{{$row->slug}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('admin.connection.edit',$row->id)}}" data-toggle="tooltip" title="Edit {{$singular_name}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                &nbsp;<a data-toggle="tooltip" title="Delete {{$singular_name}}" href="javascript:void(0)" data-href="{{route('admin.connection.delete',$row->id)}}" class="btn btn-danger deletedBtn shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                &nbsp;<a data-toggle="tooltip" title="View Connection" target="_blank" href="{{route('connection-page',$row->slug)}}" class="btn btn-success shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No record found.</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">{{ $data->links() }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
@endsection
