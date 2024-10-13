<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssuntoRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => [
                'required',
                'string',
                'max: 20',
            ]
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'error_code' => 422,
            'error_message' => $validator->errors()->first()], 422));
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'descricao.required' => 'O campo descrição é obrigatório!',
            'descricao.max' => 'O campo descrição pode ter no maximo 20 caracteres!',
        ];
    }


}
