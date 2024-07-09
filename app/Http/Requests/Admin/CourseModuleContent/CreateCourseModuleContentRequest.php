<?php

namespace App\Http\Requests\Admin\CourseModuleContent;

use App\Models\CourseModule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseModuleContentRequest extends FormRequest
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
            'content_type' => 'required|exists:content_types,id',
            'value' => 'required',

        ];
    }

    protected function passedValidation()
    {
        $courseModule = CourseModule::findOrFail($this->module_id);
        $this->merge([
            'course_id' => $courseModule->course_id,
            'content_type_id' => $this->content_type,
            'course_module_id' => $courseModule->id,
        ]);
    }
}
