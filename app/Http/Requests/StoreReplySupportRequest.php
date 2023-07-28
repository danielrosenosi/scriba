<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplySupportRequest extends FormRequest
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
            'support_id' => ['required', 'exists:supports,id'],
            'content' => ['required', 'string', 'min:3', 'max:10000'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'support_id.required' => 'O campo :attribute é obrigatório!',
            'support_id.exists' => 'O campo :attribute não existe!',
            'content.required' => 'O campo :attribute é obrigatório!',
            'content.string' => 'O campo :attribute deve ser uma string!',
        ];
    }
}
