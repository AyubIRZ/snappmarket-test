<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;


class ProductListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'nullable|integer|exists:categories,id'
        ];
    }

    /**
     * Set the response object that will be returned if any validation fails.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category.integer' => 'The category value should be an integer.',
            'category.exists' => 'The selected category was not found.',
        ];
    }

    /**
     * Override the default error response for validation.
     *
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function buildResponse($validator)
    {
        return response()->json([
            'ok' => false,
            'message' => 'There are problems retrieving products!',
            'errors' => $validator->errors()->all()
        ], 422);
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, $this->buildResponse($validator)));
    }
}
