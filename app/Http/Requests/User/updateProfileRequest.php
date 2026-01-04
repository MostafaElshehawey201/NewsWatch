<?php

namespace App\Http\Requests\User;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class updateProfileRequest extends FormRequest
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
            "name"  => "nullable|string|min:3|max:255",
            "email" => "nullable|email",
            "phone" => "nullable|digits:10,15",
            "experience" => "nullable|string|min:3|max:255",
            "job_title"  => "nullable|string|min:3|max:255",
            "name_governorate" => "nullable|string|min:3|max:255",
            "name_city"        => "nullable|string|min:3|max:255",
            "image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
        ];
    }

    public function messages(){
        return [
            "name.string" => __('validation.name.string'),
            "name.min" => __('validation.name.min'),
            "name.max" => __('validation.name.max'),
            "email.email" => __('validation.email.email'),
            "phone.digits" => __('validation.phone.digits'),
            "experience.string" => __('validation.experience.string'),
            "experience.min" => __('validation.experience.min'),
            "experience.max" => __('validation.experience.max'),
            "job_title.string" => __('validation.job_title.string'),
            "job_title.min" => __('validation.name.min'),
            "job_title.max" => __('validation.job_title.max'),
            "name_governorate.string" => __('validation.name_governorate.string'),
            "name_governorate.min" => __('validation.name_governorate.min'),
            "name_governorate.max" => __('validation.name_governorate.max'),
            "name_city.string" => __('validation.name_city.string'),
            "name_city.min" => __('validation.name_city.min'),
            "name_city.max" => __('validation.name_city.max'),
            "image.image" => __('validation.image.image'),
            'image.max' => __('validation.image.max'),
            "image.mimes" => __('validation.image.mimes'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [] ;
        $validationMessages = Lang::get('validation');
        foreach($validator->errors()->getMessages() as $filed => $messages){
            foreach($messages as $message){
                $foundMessage = $message;
                if(is_array($validationMessages)){
                    foreach($validationMessages as $value){
                        if(is_array($value) && isset($value['message']) && $value['message'] === $message){
                            $foundMessage = $value['message'];
                            break;
                        }
                    }
                }
                $errors[$filed][]=[
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
