<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'min:3', 'max:255', 'unique:supports,subject'],
            'body' => ['required', 'min:3', 'max:10000'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'O campo "Assunto" é de preenchimento obrigatório',
            'subject.min' => 'O campo "Assunto" deve ter no mínimo 3 caracteres',
            'subject.max' => 'O campo "Assunto" deve ter no máximo 255 caracteres',
            'subject.unique' => 'Já existe um suporte para esse assunto',
            'body.required' => 'O campo "Descrição" é de preenchimento obrigatório',
            'body.min' => 'O campo "Descrição" deve ter no mínimo 3 caracteres',
            'body.max' => 'O campo "Descrição" deve ter no máximo 10.000 caracteres',
        ];
    }
}
