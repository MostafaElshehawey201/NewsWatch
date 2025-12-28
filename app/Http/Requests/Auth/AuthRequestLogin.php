<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequestLogin extends FormRequest
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
            "login" => "required",
            "password" => "required|string|min:8",
        ];
    }

    public function messages(){
        return  [
            "login.required" => __("authLogin.login.required"),
            "password.required" => __("authLogin.password.required"),
            "password.min" => __("authLogin.password.min"),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [];
        $validationMessages = Lang::get('authLogin');
        foreach($validator->errors()->getMessages() as $field => $messages){
            foreach($messages as $message){
                $foundMessage  = $message;

                if(is_array($validationMessages)){
                    foreach($validationMessages as $value){
                        if(is_array($value) && isset($value['message']) && $value['message'] === $message){
                            $foundMessage = $value['message'];
                            break;
                        }
                    }
                }
                $errors[$field][] = [
                    "message" => $foundMessage,
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
