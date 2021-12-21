<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'phone' => 'string|min:8|max:11',
            'description' => 'max:20000',
        ];
    }

    public function messages()
{
    return [
        'description.max' => 'The document may not be greater than 2 KB'
    ];
}
}
