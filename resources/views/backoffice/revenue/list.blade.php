@extends('backoffice.layouts.app')

@section('title', array_key_last($data['breadcrumb']))

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
                @foreach($data['breadcrumb'] as $title => $link)
                    <li class="breadcrumb-item {{ empty($link) ? 'active' : '' }}">
                        <a href="{{ !empty($link) ? $link : 'javascript:void(0)' }}">{{$title}}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Revenue</p>
                            <h3 class="text-white">${{ number_format($data['total_revenue'], 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-stat card bg-dark">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Users</p>
                            <h3 class="text-white">{{ $data['total_users'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-stat card bg-gray-dark">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-2"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Courses</p>
                            <h3 class="text-white">{{ $data['total_courses'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form with Full Width -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('admin.revenue') }}" method="GET" class="w-100">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="course_id" class="form-control select2">
                                    <option value="">Search by Course</option>
                                    @foreach ($data['all_courses'] as $course)
                                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="user_id" class="form-control select2">
                                    <option value="">Search by User</option>
                                    @foreach ($data['all_users'] as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Status</th> <!-- New Status Column -->
                                <th>Enrollment Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data['courses']->count() > 0)
                                @foreach($data['courses'] as $index => $row)
                                    <tr>
                                        <td><strong>{{ $index + $data['courses']->firstItem() }}</strong></td>
                                        <td>
                                            <a href="{{ route('admin.course.show', $row->course->id) }}">{{ $row->course->name ?? 'N/A' }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $row->user->id) }}">{{ $row->user->name ?? 'N/A' }}</a>
                                        </td>
                                        <td>${{ number_format($row->amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-success">Paid</span> <!-- Bootstrap Badge -->
                                        </td>
                                        <td>{{ _date($row->date) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No paid courses found.</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">{{ $data['courses']->links() }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
