<?php

namespace App\Http\Requests\Post;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\HttpKernelBrowser;

class PostCreateRequest extends FormRequest
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
            "title" => "nullable|string",
            "body" => "nullable|string",
        ];
    }

    public function messages()
    {
        return [
            "title.string" => __('validation.title.string'),
            "body.string" => __('validation.body.string'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $failed => $messages) {
            $errors[$failed][] = [
                "message" => $messages[0],
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
