<?php

namespace App\Http\Requests\Admin\Connection;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateConnectionRequest extends FormRequest
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
            'description' => 'required',
            'button.text' => 'required',
            'button.url' => 'required|url',
            'button.target_blank' => 'required|in:0,1',
            'categories.*.name' => 'required',
            'categories.*.icon' => 'required|image|max:2048',
        ];
    }
}
