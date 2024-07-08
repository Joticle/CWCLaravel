<?php

namespace App\Http\Requests\User;

use App\Rules\OldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'string', new OldPassword],
            'new_password' => 'required|min:8|confirmed|different:old_password'
        ];
    }
}
