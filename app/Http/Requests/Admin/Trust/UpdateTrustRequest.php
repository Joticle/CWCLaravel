<?php

namespace App\Http\Requests\Admin\Trust;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrustRequest extends FormRequest
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
            'image' => 'sometimes|image|max:2048',
            'status' => 'required|in:0,1',
            'button.url' => 'nullable|string',
            'button.target_blank' => 'nullable|in:0,1'
        ];
    }
}
