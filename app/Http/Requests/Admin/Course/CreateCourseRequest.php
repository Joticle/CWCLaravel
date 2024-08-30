<?php

namespace App\Http\Requests\Admin\Course;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateCourseRequest extends FormRequest
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
            'logo' => 'required|image',
            // 'syllabuses.*' => 'nullable|file|mimes:pdf,doc,docx,txt,odt,rtf,xls,xlsx,csv,ods',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'price' => 'required|numeric',
            'level' => 'required|in:' . implode(',', Course::LEVELS),
            'certificate_issued' => 'required|in:0,1'
        ];
    }

    protected function passedValidation()
    {
        $tags = null;
        if (!empty($this->tags)) {
            (new TagController(new TagService(new Tag())))->createNewTags($this->tags);
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
