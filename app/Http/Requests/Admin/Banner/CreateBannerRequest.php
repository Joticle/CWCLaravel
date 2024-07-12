<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'pre_title' => 'required',
            'title' => 'required',
            'image' => 'sometimes|image|max:2048',
            'description' => 'required',
            'button.text' => 'nullable',
            'button.url' => 'nullable|url',
            'button.target_blank' => 'nullable|in:0,1'
        ];
    }
}
