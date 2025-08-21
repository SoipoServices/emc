<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'contact_email' => ['required', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'max:1024'], // max 1MB
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Business name is required.',
            'name.max' => 'Business name may not be greater than 255 characters.',
            'description.required' => 'Business description is required.',
            'contact_email.required' => 'Contact email is required.',
            'contact_email.email' => 'Contact email must be a valid email address.',
            'website.url' => 'Website must be a valid URL.',
            'logo.image' => 'Logo must be an image file.',
            'logo.max' => 'Logo file size may not be greater than 1MB.',
        ];
    }
}
