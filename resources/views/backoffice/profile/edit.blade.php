@extends('backoffice.layouts.app')

@section('title', 'Profile')

@section('page-level-style')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form autocomplete="off" method="POST" action="{{ route('admin.edit-profile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Name<span class="text-danger">*</span></label>
                                    <input name="name" id="name" placeholder="Enter Course Name"
                                        class="form-control" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Email<span class="text-danger"></span></label>
                                    <input class="form-control" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Current Thumbnail</label><br>
                                    @if ($user->thumbnail)
                                        <img src="{{ Storage::url($user->thumbnail) }}" alt="Current Thumbnail" style="max-width: 200px; max-height: 200px;">
                                    @else
                                        <p>No thumbnail available</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for='thumbnail' class="form-label">Thumbnail<span
                                            class="text-danger">*</span></label>
                                    <input id='thumbnail' name="thumbnail" type="file" class='form-control' required
                                        accept ='image/*'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@section('page-level-script')
@endsection
