<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is mandatory',
            'name.min' => 'The name field must not be less than :min characters',
            'name.max' => 'The name field must not be greater than :max characters',
        ];
    }
}
