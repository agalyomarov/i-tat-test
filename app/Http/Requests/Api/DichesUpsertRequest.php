<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Validation\Rule;

class DichesUpsertRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'token' => ['required',],
            'name' => ['required', Rule::unique('diches', 'name')->ignore($this->id, 'id_diches')],
            'price' => ['required', 'numeric'],
            'count' => ['required', 'integer'],
            'id_category' => ['required', 'exists:categories,id_category'],
            'id' => [],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,gif']
        ];
    }

    protected function failedValidation(ValidatorContract $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $errors
        ]));
    }
}
