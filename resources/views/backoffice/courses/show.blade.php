@extends('backoffice.layouts.app')

@section('title', 'Course Details')

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

        .course-detail p {
            font-size: 16px;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .course-detail p strong {
            color: #333;
        }

        .btn-primary {
            background-color: #2f4cdd;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 text-white">Course Details</h3>
                </div>
                <div class="card-body course-detail">
                    <p><strong>Course Name:</strong> {{ $course->name }}</p>
                    <p><strong>Course Price:</strong> ${{ number_format($course->price, 2) }}</p>
                    <p><strong>Start Date:</strong> {{ _date($course->start_date) }}</p>
                    <p><strong>End Date:</strong> {{ _date($course->end_date) }}</p>

                    <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-primary mt-3">
                        <i class="fa fa-edit"></i> Edit Course
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
