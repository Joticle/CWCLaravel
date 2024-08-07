<?php

namespace App\Http\Requests\Admin\ContentType;

use App\Http\Controllers\Backoffice\TagController;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContentTypeRequest extends FormRequest
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
            'type' => 'required',
            'status' => 'required|in:0,1'
        ];
    }

}
