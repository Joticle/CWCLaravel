@extends('backoffice.layouts.app')

@section('title', array_key_last($data['breadcrumb']))

@section('content')
    <div class="row">
        <div class="page-titles">
            <ol class="breadcrumb">
{{--                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>--}}
                @foreach($data['breadcrumb'] as $title => $link)
                    <li class="breadcrumb-item {{ empty($link) ? 'active' : '' }}">
                        <a href="{{ !empty($link) ? $link : 'javascript:void(0)' }}">{{$title}}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center justify-content-between">
                    <h4 class="card-title">Paid Courses List</h4>
                    <h4 class="float-center card-title">Total Revenue: ${{ number_format($data['total_revenue'], 2) }}</h4>
                    <div class="float-right">
                        <form method="GET" action="{{ route('admin.revenue') }}">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Search"
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.revenue') }}" class="btn btn-secondary ml-2">Reset</a>
                        </div>
                    </form>
                    </div>

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
                                <th>Enrollment Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data['courses']->count() > 0)
                                @foreach($data['courses'] as $index => $row)
                                    <tr>
                                        <td><strong>{{ $index + $data['courses']->firstItem() }}</strong></td>
                                        <td>{{ $row->course->name ?? 'N/A' }}</td>
                                        <td>{{ $row->user->name ?? 'N/A' }}</td>
                                        <td>${{ number_format($row->amount, 2) }}</td>
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
