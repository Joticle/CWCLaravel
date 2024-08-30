<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateSocialProfilesRequest extends FormRequest
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
            'facebook' => 'nullable|string',
            'skype' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
            'pinterest' => 'nullable|string',
            'github' => 'nullable|string',
            'youtube' => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('activeTab', 'update-social');

        throw new HttpResponseException($response);
    }
}
