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
        ];
    }

    public function messages(){
        return [
            "name.string" => __('updateProfile.name.string'),
            "name.min" => __('updateProfile.name.min'),
            "name.max" => __('updateProfile.name.max'),
            "email.email" => __('updateProfile.email.email'),
            "phone.digits" => __('updateProfile.phone.digits'),
            "experience.string" => __('updateProfile.experience.string'),
            "experience.min" => __('updateProfile.experience.min'),
            "experience.max" => __('updateProfile.experience.max'),
            "job_title.string" => __('updateProfile.job_title.string'),
            "job_title.min" => __('updateProfile.name.min'),
            "job_title.max" => __('updateProfile.job_title.max'),
            "name_governorate.string" => __('updateProfile.name_governorate.string'),
            "name_governorate.min" => __('updateProfile.name_governorate.min'),
            "name_governorate.max" => __('updateProfile.name_governorate.max'),
            "name_city.string" => __('updateProfile.name_city.string'),
            "name_city.min" => __('updateProfile.name_city.min'),
            "name_city.max" => __('updateProfile.name_city.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [] ;
        $validationMessages = Lang::get('updateProfile');
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
