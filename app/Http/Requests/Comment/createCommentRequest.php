<?php

namespace App\Http\Requests\Comment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class createCommentRequest extends FormRequest
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
            'content' => 'required|string|max:255',
        ];
    }

    public function messages(){
        return [
            'content.required' => __('validation.content.required'),
            'content.string' => __('validation.content.string'),
            'content.max' => __('validation.content.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors=[];
        foreach($validator->errors()->getMessages() as $key => $messages){
            $errors[$key][] = $messages;
            break;
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
