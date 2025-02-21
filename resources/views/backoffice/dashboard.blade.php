@extends('backoffice.layouts.app')

@section('title', 'Dashboard')

@section('page-level-style')
    <link rel="stylesheet" href="{!! asset('admin-assets/vendor/datatables/css/jquery.dataTables.min.css') !!}">
@endsection

@section('content')

    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Dashboard</h2>
            <p class="mb-4">Welcome {{Auth::user()->name}},</p>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="widget-stat card bg-success">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Admins</p>
                            <h3 class="text-white">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-stat card bg-dark">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Users</p>
                            <h3 class="text-white">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-stat card bg-blue-dark">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Courses</p>
                            <h3 class="text-white">{{ $total_paid_courses }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="widget-stat card bg-gray-dark">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Courses</p>
                            <h3 class="text-white">{{ $total_courses }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-script')
@endsection
