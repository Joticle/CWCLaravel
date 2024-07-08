<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        if( empty(request('tag')) )
            return $this->store();
        else
            return $this->update();
    }
    private function store()
    {
        return [
            'name' => 'required|string|unique:tags'
        ];
    }
    private function update()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('tags')->ignore( request('tag')),
            ]
        ];
    }
}
