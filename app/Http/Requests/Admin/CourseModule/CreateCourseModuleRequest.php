<?php

namespace App\Http\Requests\Admin\CourseModule;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateCourseModuleRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',

        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'slug' => $this->slugify($this->name),
        ]);
    }

    private function slugify($text, $id = '')
    {
        $slug = Str::slug($text);
        $isExists = CourseModule::where('slug', '=', $slug);
        if (!empty($id)) {
            $isExists = $isExists->where('id', '!=', $id);
        }
        $isExists = $isExists->count();
        if ($isExists) {
            $slug = $slug . '-' . $isExists;
        }
        return $slug;
    }
}
