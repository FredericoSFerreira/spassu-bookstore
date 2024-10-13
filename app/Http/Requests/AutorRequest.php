<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AutorRequest extends FormRequest
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
            'nome' => [
                'required',
                'string',
                'max: 40',
                'unique:autor,nome',
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
            'nome.required' => 'O campo nome é obrigatório!',
            'nome.unique' => 'Este autor já foi cadastrado.',
            'nome.max' => 'O campo nome pode ter no maximo 40 caracteres!',
        ];
    }


}
