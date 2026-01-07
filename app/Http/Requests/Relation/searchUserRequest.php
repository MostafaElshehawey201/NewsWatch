<?php

namespace App\Http\Requests\Relation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class searchUserRequest extends FormRequest
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
            "name" => "required|string",
        ];
    }

    public function messages(){
        return [
            "name.required" => __('validation.name.required'),
            "name.string" => __('validation.name.string'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors =[];
        foreach($validator->errors()->getMessages() as $failed => $messages){
            $errors[$failed][] = [
                "messages" => $messages,
            ];
            break;
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
