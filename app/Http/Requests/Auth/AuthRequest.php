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
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'digits_between:10,15', 'unique:users,phone'],
            "password" => ['required', 'string', 'min:6'],
            "role_user" => ['sometimes', 'string'],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => __('validation.name.required'),
            "name.string" => __('validation.name.string'),
            "name.max" => __('validation.name.max'),
            "email.required" => __('validation.email.required'),
            "email.email" => __('validation.email.email'),
            "email.max" => __('validation.email.max'),
            "email.unique" => __('validation.email.unique'),
            "phone.required" => __('validation.phone.required'),
            "phone.digits_between" => __('validation.phone.digits_between'),
            "phone.unique" => __('validation.phone.unique'),
            "password.required" => __('validation.password.required'),
            "password.confirmed" => __('validation.password.confirmed'),
            "password.string" => __('validation.password.string'),
            "password.min" => __('validation.password.min'),
        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = [];
        $validationMessages = Lang::get('validation');

        foreach ($validator->errors()->getMessages() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[$field][] = [
                    "message" => $message,
                ];
                break;
                if (is_array($validationMessages)) {
                    foreach ($validationMessages as $value) {
                        if (is_array($value) && isset($value['message']) && $value['message'] === $message ) {
                            $errors[$field][] = [
                                "message" => $value['message'],
                            ];
                        }
                    }
                }
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
