<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:2|max:100',
            'date' => 'required',
            'description' => 'required|min:10',
            'image' => 'image|mimes:jpg,png|max:20480',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is mandatory',
            'title.min' => 'The title field must not be less than :min characters',
            'title.max' => 'The title field must not be greater than :max characters',

            'date.required' => 'The date field is mandatory',

            'description.required' => 'The description field is mandatory',
            'description.min' => 'The description field must not be less than :min characters',

            'image.image' => 'The upload file must be an image',
            'image.mimes' => 'The upload image must be a jpg or png format',
            'image.max' => 'The upload image must not be greater than 20MB',

        ];
    }
}
