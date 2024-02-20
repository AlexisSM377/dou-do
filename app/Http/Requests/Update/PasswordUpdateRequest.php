<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'password' => 'required|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'El campo es requerido.',
            '*.same' => 'Los valores deben coincidir.',
            '*.min' => 'La contraseña debe contener mínimo 8 caracteres.'
        ];
    }
}
