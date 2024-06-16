<?php

namespace App\Http\Requests;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RentalAvailabilityRequest extends FormRequest
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
            'check_in_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date|date_format:Y-m-d|after_or_equal:today',
        ];
    }


    protected function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json(["errors" => $validator->errors() ], 422)); 
    }
    
}
