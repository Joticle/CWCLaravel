<?php

namespace App\Http\Requests\Admin\Trust;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrustRequest extends FormRequest
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
            'hub_id' => 'nullable|exists:hubs,id',
            'image' => 'image|max:2048',
            'button.url' => 'nullable|string',
            'button.target_blank' => 'nullable|in:0,1'
        ];
    }
}
