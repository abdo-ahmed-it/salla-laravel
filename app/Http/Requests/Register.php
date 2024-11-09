<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'email' => ['required', 'string', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'numeric',  'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
    public function attributes()
    {
        return[
            'name' => trans('main.name'),
            'email' => trans('main.email'),
            'phone' => trans('main.phone'),
            'password' => trans('main.password'),
            'password_confirmation' => trans('main.password_confirmation'),
        ];

    }
}
