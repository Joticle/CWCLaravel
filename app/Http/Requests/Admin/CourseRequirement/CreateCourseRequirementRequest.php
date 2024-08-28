<?php

namespace App\Http\Requests\Admin\CourseRequirement;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateCourseRequirementRequest extends FormRequest
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
        ];
    }

    protected function passedValidation()
    {

        $course = Course::findOrFail($this->course_id);
        $this->merge([
            'course_id' => $course->id
        ]);
    }
}
