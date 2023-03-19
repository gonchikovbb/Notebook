<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNotebookUpdateRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'string|max:60',
            'last_name' => 'string|max:60',
            'third_name' => 'string|max:60',
            'company' => 'string|max:60',
            'phone' => 'string|min:11|max:11|unique:notebooks',
            'email' => 'string|max:60|email|unique:notebooks',
            'date_birth' => 'date',
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'first_name' => 'First name is required',
            'last_name' => 'Last name is required',
            'third_name' => 'Third name is required',
            'email.points' => 'Points is required',
            'email.required' => 'Email is required',
            'email.unique' => 'The user with the specified email address is already registered',
            'phone.unique' => 'The user with the specified phone address is already registered',
        ];
    }
}
