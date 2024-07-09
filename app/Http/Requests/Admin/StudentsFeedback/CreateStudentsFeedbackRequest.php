<?php

namespace App\Http\Requests\Admin\StudentsFeedback;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\StudentsFeedback;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateStudentsFeedbackRequest extends FormRequest
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
            'image' => 'required|image',
            'text' => 'required',
            'rating' => 'required|in:' . implode(',', StudentsFeedback::RATINGS),
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
            'slug' => $this->slugify($this->name),
            'tags' => $tags,
        ]);
    }

    private function slugify($text, $id = '')
    {
        $slug = Str::slug($text);
        $isExists = Course::where('slug', '=', $slug);
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
