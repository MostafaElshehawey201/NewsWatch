<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AuthRequestForgetPassword extends FormRequest
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
            "login" => "required"
        ];
    }

    public function messages()
    {
        return [
            "login.required" => __("authForgetPassword.login.required"),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        // عملنا array هتشيل الرسايل ال جاية من ملف اللغة 
        $errors = [];
        // جبنا الرسايل ال جاية من ال validatoin
        $validationMessages = Lang::get('authForgetPassword');
        foreach ($validator->errors()->getMessages() as $filed => $messages) {
            foreach ($messages as $message) {
                $foundMessage = $message;
            }
            if (is_array($validationMessages)) {
                foreach ($validationMessages as $value) {
                    if (is_array($value) && isset($value['message']) && $value['message'] === $message) {
                        $foundMessage = $value['message'];
                        break;
                    }
                    $errors[$filed][] = [
                        "message" => $foundMessage,
                    ];
                }
                throw new HttpResponseException(
                    response()->json([
                        "success" => false,
                        "data" => null,
                        "errors" => $errors
                    ], 422)
                );
            }
        }
    }
}
