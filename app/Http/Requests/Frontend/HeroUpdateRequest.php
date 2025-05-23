<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class HeroUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'video_button_text' => 'nullable|string|max:255',
            'video_button_url' => 'nullable|string|max:255',
            'banner_item_title' => 'nullable|string|max:255',
            'banner_item_subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:3000',
            'round_text' => 'nullable|string|max:255',
        ];
    }
}
