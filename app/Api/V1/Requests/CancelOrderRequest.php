<?php

namespace App\Api\V1\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CancelOrderRequest extends FormRequest
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
            'Code' => 'required'
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'Code.required' => 'Code field is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'Result' => 2,
            'Message' => $validator->errors()->first(),
            'error' => true,
        ], 422);
        throw new HttpResponseException($response);
    }
}
