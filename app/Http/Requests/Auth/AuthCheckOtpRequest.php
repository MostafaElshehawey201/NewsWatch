<?php

namespace App\Http\Requests\Auth;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;

class AuthCheckOtpRequest extends FormRequest
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
            "otp" => "required|digits:6",
        ];
    }

    public function messages(){
        return [

        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors =[];
        $validationMessages = Lang::get('authCheckOtp');
        foreach($validator->errors()->messages() as $field => $messages){
            foreach($messages as $message){
                $foundMessage = $message;
                foreach ($validationMessages as $value){
                    if(is_array($value) && (isset($value['message'])) && $value['message'] === $message){
                        $foundMessage = $value['message'];
                        break;
                    }
                }
                $errors[$field][] = [
                    "message" => $foundMessage,
                ];
            }
        }
        throw new HttpResponseException(
            response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors,
            ],422)
        );
    }
}
