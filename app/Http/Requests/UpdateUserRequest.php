<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\FormatPhone;

class UpdateUserRequest extends FormRequest
{
    use FormatPhone;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'max:255',
                'email',
                'required',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('id', '!=', $this->user);
                })
            ],
            'phone' => [
                'min:9',
                'max:11',
                'string',
                'required'
            ],
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:3'
        ];
    }

    public function getValidatorInstance()
    {
        $this->formatPhoneNumber();

        return parent::getValidatorInstance();
    }


    protected function formatPhoneNumber()
    {
        $this->merge([
            'phone' => $this->phoneToInt($this->phone)
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password field must contain at least 3 numbers.',
            'password.required' => 'The password field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'The email field must be unique.',
            'phone.required' => 'The phone field is required.',
            'phone.min' => 'The phone field must contain at least 9 numbers.',
            'phone.max' => 'The phone field must contain a maximum of 11 numbers.'
        ];
    }
}
