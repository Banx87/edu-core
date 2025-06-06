<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            "title" => "required|string|max:255|unique:blogs,title," . $this->blog->id,
            "content" => "required|string|min:50",
            'category' => 'required|exists:blog_categories,id',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
        ];
    }
}
