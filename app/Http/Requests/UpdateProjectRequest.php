<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:200',
                'min:3',
                Rule::unique('projects')->ignore($this->project->id)
            ],
            'image' => 'nullable|max:255',
            'description' => 'nullable',
            'type_id' => 'nullable|exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'title.unique:projects' => 'Title already exists',
            'title.min' => 'Title must be at least :min characters',
            'title.max' => 'Title must be at most :max characters',
            'title.required' => 'Title is required',
            'image.max' => 'Image must be at most :max characters',
        ];
    }
}
