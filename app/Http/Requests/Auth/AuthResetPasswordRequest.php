<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AuthResetPasswordRequest extends FormRequest
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
            "password" => "required|string|min:8",
        ];
    }

    public function messages()
    {
        return [
            "password.required" => __('validation.password.required'),
            "password.string" => __('validation.password.string'),
            "password.min" => __('validation.password.min'),
        ];
    }

    public function failedValidation(Validator $validator)
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
                        if (is_array($value) && isset($value['message']) && $value['message'] === $message) {
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
                "success" => false,
                "data" => null,
                "errors" => $errors,
            ], 422)
        );
    }
}
