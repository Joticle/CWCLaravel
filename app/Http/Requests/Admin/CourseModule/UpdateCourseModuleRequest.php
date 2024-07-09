<?php

namespace App\Http\Requests\Admin\CourseModule;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCourseModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'status' => 'required|in:0,1'
        ];
    }

    protected function passedValidation()
    {
        $courseModule = CourseModule::findOrFail($this->id);
        $this->merge([
            'course_id' => $courseModule->course_id
        ]);
    }
}
