<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required|string|max:255', // Added a max length to prevent excessively long names
            'content' => 'string|nullable',
            'email' => 'email|nullable',
            'phone' => 'nullable|string|regex:/^\+?[1-9]\d{1,14}$/',
            'facebook' => 'string|nullable|max:255', // Consider limiting maximum length
            'instagram' => 'string|nullable|max:255',
            'twitter' => 'string|nullable|max:255',
        ];
        
    }
}
