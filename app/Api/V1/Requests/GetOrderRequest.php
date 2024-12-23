<?php

namespace App\Api\V1\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetOrderRequest extends FormRequest
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
            'LangType' => 'required|in:zh-CN,en-US',
            'Codes' => 'required|array'
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'LangType.required' => 'The LangType field is required.',
            'LangType.in' => 'LangType must be either zh-CN or en-US.',
            'Codes.required' => 'The Codes field is required.',
            'Codes.array' => 'The Codes field must be an array.',
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
