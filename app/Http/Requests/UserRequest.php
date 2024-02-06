<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:25|min:4|string',
            'last_name' => 'required|max:60|min:4|string',
            'email' => 'required|max:100|email',
            'password' => 'required|min:8|max:30',
            'birthdate' => 'required|date',
        ];
    }
}
