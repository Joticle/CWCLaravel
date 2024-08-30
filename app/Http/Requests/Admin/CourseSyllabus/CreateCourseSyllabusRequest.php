<?php

namespace App\Http\Requests\Admin\CourseSyllabus;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseSyllabusRequest extends FormRequest
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
            'files.*' => 'required|file|mimes:pdf,doc,docx,txt,odt,rtf,xls,xlsx,csv,ods',
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
