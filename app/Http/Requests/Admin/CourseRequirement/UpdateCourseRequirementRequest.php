<?php

namespace App\Http\Requests\Admin\CourseRequirement;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseRequirement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCourseRequirementRequest extends FormRequest
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
            'text' => 'required',
            'status' => 'required|in:0,1'
        ];
    }

    protected function passedValidation()
    {
        $courseRequirement = CourseRequirement::findOrFail($this->id);
        $this->merge([
            'course_id' => $courseRequirement->course_id
        ]);
    }
}
