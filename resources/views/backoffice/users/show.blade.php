@extends('backoffice.layouts.app')

@section('title', 'User Details')

@section('page-level-style')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #2f4cdd;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
            font-size: 16px;
        }

        .user-detail p {
            font-size: 16px;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .user-detail p strong {
            color: #333;
        }

        .enrolled-courses {
            list-style-type: decimal;
            padding-left: 20px;
        }

        .enrolled-courses li {
            font-size: 16px;
            margin-bottom: 5px;
            list-style-type: decimal !important;
        }

        .enrolled-courses a {
            text-decoration: none;
            /*color: #2f4cdd;*/
            font-weight: bold;
            transition: color 0.3s;
        }

        .enrolled-courses a:hover {
            color: #1d35b7;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">User Details</h3>
                </div>
                <div class="card-body user-detail">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    <h4>Enrolled Courses</h4>
                    <ol class="enrolled-courses">
                        @foreach($user->courseEnrolls->unique('course_id') as $enrollment)
                            @if($enrollment->course) <!-- Ensures course exists -->
                            <li>
                                <a href="{{ route('admin.course.show', $enrollment->course->id) }}">
                                    {{ $enrollment->course->name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
