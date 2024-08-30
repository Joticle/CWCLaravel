<div class="modal-header">
    <h5 class="modal-title">Edit Course Syllabus</h5>
    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
</div>
{{ Form::open(['url' => route('admin.course.syllabus.edit', $row->id), 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-label">Name<span class="text-danger">*</span></label>
                {{ Form::text('name', $row->name, ['class' => 'form-control', 'required' => 'true', 'id' => 'name', 'placeholder' => 'Enter Syllabus Name']) }}
            </div>
            <div class="form-group">
                <label class="text-label">File</label>
                {{ Form::file('file', ['class' => 'form-control', 'id' => 'file', 'accept' => '.pdf,.doc,.docx,.txt,.odt,.rtf,.xls,.xlsx,.csv,.ods']) }}
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-label">Status</label>
                <br>
                {{ Form::radio('status', '1', $row->status == '1' ? true : false, ['id' => 'status_active']) }}
                <label for="status_active">Active</label>
                {{ Form::radio('status', '0', $row->status == '0' ? true : false, ['id' => 'status_inactive']) }}
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
