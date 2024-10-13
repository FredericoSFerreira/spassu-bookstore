<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LivroRequest extends FormRequest
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
            'titulo' => [
                'required',
                'string',
                'max:40',
            ],
            'editora' => [
                'required',
                'string',
                'max:40',
            ],
            'edicao' => [
                'integer',
                'required',
            ],
            'ano_publicacao' => [
                'required',
                'max:4',
            ],
            'valor' => [
                'numeric',
                'required',
            ],
            'autores' => [
                'required',
                'array',
                'exists:autor,id'
            ],
            'assuntos' => [
                'required',
                'array',
                'exists:assunto,id'
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
            'titulo.required' => 'O campo titulo é obrigatório!',
            'titulo.unique' => 'Este titulo já foi cadastrado.',
            'titulo.max' => 'O campo titulo pode ter no maximo 40 caracteres!',
            'editora.required' => 'O campo editora é obrigatório!',
            'editora.unique' => 'Este editora já foi cadastrado.',
            'editora.max' => 'O campo editora pode ter no maximo 40 caracteres!',
            'edicao.required' => 'O campo edição é obrigatório!',
            'ano_publicacao.required' => 'O campo ano de publicacao é obrigatório!',
            'ano_publicacao.max' => 'O campo ano de publicacao pode ter no maximo 4 caracteres!',
            'valor.required' => 'O campo valor é obrigatório!',
            'autores.required' => 'O campo autores é obrigatório!',
            'assuntos.required' => 'O campo assuntos é obrigatório!',
        ];
    }
}
