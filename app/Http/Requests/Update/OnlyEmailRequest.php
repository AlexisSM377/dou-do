<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class OnlyEmailRequest extends FormRequest
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
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Ingresa tu correo electrónico.',
            '*.email' => 'Ingresa un correo electrónico válido.'
        ];
    }
}
