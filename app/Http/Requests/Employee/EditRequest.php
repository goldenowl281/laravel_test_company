<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
        $employee_id = $this->route('employee');
        return [
            'name'       => 'required|string|max:255',
            'company_id' => 'required',
            'email'      => [
                                'required',
                                'email',
                                'max:255',
                                Rule::unique('employees')->ignore($employee_id)
                            ],
            'phone' => [
                            'required',
                            'numeric',
                            'regex:/^\d{6,}$/',
                            Rule::unique('employees')->ignore($employee_id)
                        ]
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
