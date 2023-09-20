<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name'  => 'required|string|max:255',
            'company_id' => 'required',
            'email' => 'required|email|max:255|unique:employees', // Added the `unique:employees` rule to check for unique emails
            'phone' => 'required|numeric|unique:employees|regex:/^\d{6,}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "You need to fill your name",
            'name.max'      => "Name must be less than 255",
            'email.email'   => "Email type wrong",
            'email.required'=> "Please fill email",
            'email.unique'  => "Email already exists",
            'phone.numeric' => "Phone number can only contain digits",
            'phone.regex'   => "Phone number must be at least 6 digits long",

            'company_id.required' => "Please choose your company",
        ];
    }

}
