<?php

namespace App\Http\Requests\Admin\StudentsFeedback;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\StudentsFeedback;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateStudentsFeedbackRequest extends FormRequest
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
            'name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'nullable|image',
            'text' => 'required',
            'status' => 'required|in:0,1',
            'rating' => 'required|in:' . implode(',', StudentsFeedback::RATINGS),
        ];
    }
}
