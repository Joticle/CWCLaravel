<?php

namespace App\Http\Requests\Admin\Course;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCourseRequest extends FormRequest
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
            'logo' => 'nullable|image',
            'description' => 'required',
            'start_date' => 'required',
            'price' => 'required|numeric',
            'level' => 'required|in:' . implode(',', Course::LEVELS),
        ];
    }

    protected function passedValidation()
    {
        $tags = null;
        if (!empty($this->tags)) {
            (new TagController())->createNewTags($this->tags);
            $tags = implode(',', $this->tags);
        }
        $this->merge([
            'tags' => $tags,
        ]);
    }
}
