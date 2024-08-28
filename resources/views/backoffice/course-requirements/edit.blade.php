<div class="modal-header">
    <h5 class="modal-title">Edit Course Requirement</h5>
    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
</div>
{{ Form::open(['url' => route('admin.course.requirement.edit', $course->id), 'method' => 'post', 'autocomplete' => 'off']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-label">Text<span class="text-danger">*</span></label>
                {{ Form::text('text', $course->text, ['class' => 'form-control', 'required' => 'true', 'id' => 'name', 'placeholder' => 'Enter Requirement Text']) }}
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-label">Status</label>
                <br>
                {{ Form::radio('status', '1', $course->status == '1' ? true : false, ['id' => 'status_active']) }}
                <label for="status_active">Active</label>
                {{ Form::radio('status', '0', $course->status == '0' ? true : false, ['id' => 'status_inactive']) }}
                <label for="status_inactive">Inactive</label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
</div>
{{ Form::close() }}
