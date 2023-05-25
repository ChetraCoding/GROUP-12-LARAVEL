<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDroneRequest extends FormRequest
{
    protected function failedValidation( Validator $validator)
    {
        throw new HttpResponseException(response()->json(['success'=> false, 'message'=> $validator->errors()], 412));
    }
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                Rule::unique('drones')->ignore($this->drone),
            ],
            'battery' => 'required|numeric',
            'payload' => 'required|max:255',
            'lat' => 'required',
            'lng' => 'required'
        ];
    }
}
