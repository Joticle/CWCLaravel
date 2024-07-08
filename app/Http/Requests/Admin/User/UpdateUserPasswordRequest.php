<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\OldPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordRequest extends FormRequest
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
            'old_password' => ['required', 'string', new OldPassword],
            'new_password' => 'required|min:8|confirmed|different:old_password'
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'password' => Hash::make($this->new_password),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'error',
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);

        return redirect()->back()->withInput()->withErrors($validator->errors())->with('activeTab', 'update-password');
    }
}
