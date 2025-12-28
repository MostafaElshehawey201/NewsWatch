<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
            "name" => ['required' , 'string' , 'max:255'],
            "email" => ['required' , 'email' , 'max:255' , 'unique:users,email'],
            'phone' => ['required' , 'string' , 'digits_between:10,15' , 'unique:users,phone'],
            "password" => ['required' , 'string' , 'min:6' ],
            "role_user" => ['sometimes' , 'string'],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => __('authRegister.name.required'),
            "name.string" => __('authRegister.name.string'),
            "name.max" => __('authRegister.name.max'),
            "email.required" => __('authRegister.email.required'),
            "email.email" => __('authRegister.email.email'),
            "email.max" => __('authRegister.email.max'),
            "email.unique" => __('authRegister.email.unique'),
            "phone.required" => __('authRegister.phone.required'),
            "phone.digits_between" => __('authRegister.phone.digits_between'),
            "phone.unique" => __('authRegister.phone.unique'),
            "password.required" => __('authRegister.password.required'),
            "password.confirmed" => __('authRegister.password.confirmed'),
            "password.string" => __('authRegister.password.string'),
            "password.min" => __('authRegister.password.min'),
        ];
    }

    
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
{
    $errors = [];
    $validationMessages = Lang::get('AuthRegister');

    foreach ($validator->errors()->getMessages() as $field => $messages) {
        foreach ($messages as $message) {

            $foundMessage = $message;

            if (is_array($validationMessages)) {
                foreach ($validationMessages as $value) {
                    if (
                        is_array($value) &&
                        isset($value['message']) &&
                        $value['message'] === $message
                    ) {
                        $foundMessage = $value['message'];
                        break;
                    }
                }
            }

            // الإضافة مرة واحدة فقط
            $errors[$field][] = [
                'message' => $foundMessage
            ];
        }
    }

    throw new HttpResponseException(
        response()->json([
            'success' => false,
            'data' => null,
            'errors' => $errors,
        ], 422)
    );
}
}
