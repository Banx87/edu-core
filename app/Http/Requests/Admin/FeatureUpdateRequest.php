<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureUpdateRequest extends FormRequest
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
            'image_one' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'image_two' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'image_three' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'title_one' => 'nullable|string|max:255',
            'title_two' => 'nullable|string|max:255',
            'title_three' => 'nullable|string|max:255',
            'text_one' => 'nullable|string|max:255',
            'text_two' => 'nullable|string|max:255',
            'text_three' => 'nullable|string|max:255',
        ];
    }
}
