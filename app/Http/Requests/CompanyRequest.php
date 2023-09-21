<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:companies', // Added the `unique:companies` rule to check for unique emails
            'logo'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming logo is an image file
            'website'   => 'required|url|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "You need to fill company name",
            'name.max'      => "Name must be less than 255",
            'email.email'   => "Email type wrong",
            'email.required'=> "Please fill email",
            'logo.image'    => "Please insert image only",
            'logo'          => "Please insert a valid image (jpeg, png, jpg, gif) with a maximum size of 2048 KB",
            'logo.required' => "please insert logo image",
            'website.required'  => "Please fill website url",
            'website.url'       => "Only fill url",
            'email.unique'  => "Email already exists",
        ];
    }
}
