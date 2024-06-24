<div class="modal-header">
    <h5 class="modal-title">Edit Course Module</h5>
    <button type="button" class="btn-close bg-transparent border-0" data-dismiss="modal">x</button>
</div>
{{Form::open(['url'=>route('admin.course.module.edit',$course->id),'method'=>'post','autocomplete'=>'off'])}}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-label">Module Name<span class="text-danger">*</span></label>
                {{Form::text('name', $course->name,['class' => 'form-control','required'=>'true','id'=>'name','placeholder'=>'Enter Module Name'])}}
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label class="text-label">Module Description<span class="text-danger">*</span></label>
                {{ Form::textarea('description', $course->description,['class' => 'form-control tiny-'.$course->id, 'id' => 'description']) }}
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-label">Start Date<span class="text-danger">*</span></label>
                {{ Form::date('start_date', $course->start_date,['class' => 'form-control', 'required' => 'true', 'id' => 'start_date']) }}
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-label">End Date</label>
                {{ Form::date('end_date', $course->end_date,['class' => 'form-control', 'id' => 'end_date']) }}
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="form-group">
                <label class="text-label">Status</label>
                <br>
                {{ Form::radio('status', '1', $course->status=='1'?true:false, ['id' => 'status_active']) }}
                <label for="status_active">Active</label>
                {{ Form::radio('status', '0', $course->status=='0'?true:false, ['id' => 'status_inactive']) }}
                <label for="status_inactive">Inactive</label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
</div>
{{Form::close()}}