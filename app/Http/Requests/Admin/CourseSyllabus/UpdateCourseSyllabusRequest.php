<?php

namespace App\Http\Requests\Admin\CourseSyllabus;

use App\Models\CourseRequirement;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseSyllabusRequest extends FormRequest
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
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,odt,rtf,xls,xlsx,csv,ods',
            'status' => 'required|in:0,1'
        ];
    }
}
