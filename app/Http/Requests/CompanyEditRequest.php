<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CompanyEditRequest extends FormRequest
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
        $company_id = $this->route('company');
        // $company    = Company::find($company_id);

        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('companies')->ignore($company_id)
            ],
            // 'logo'  => [
            //     'image|mimes:jpeg,png,jpg,gif|max:2048',
                // function ($attribute, $value, $fail) use ($company) {
                //     if ($value === null && $company->logo) {
                //         return true;
                //     }

                //     return false;
                // }
            // ],
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
            'website.required'  => "Please fill website url",
            'website.url'       => "Only fill url",
            'email.unique'  => "Email already exists",
        ];
    }
}
