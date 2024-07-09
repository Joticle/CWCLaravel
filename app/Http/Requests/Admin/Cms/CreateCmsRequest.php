<?php

namespace App\Http\Requests\Admin\Cms;

use App\Models\Cms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateCmsRequest extends FormRequest
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
            'content' => 'required',
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'slug' => $this->slugify($this->name)
        ]);
    }

    private function slugify($text, $id = '')
    {
        $slug = Str::slug($text);
        $isExists = Cms::where('slug', '=', $slug);
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
