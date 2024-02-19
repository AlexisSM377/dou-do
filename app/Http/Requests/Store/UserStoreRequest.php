<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

/**
 * RequestStore from Users
 */
class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sets validation rules to apply to the request
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:25|min:4|string',
            'last_name' => 'required|max:60|min:4|string',
            'email' => 'required|max:100|email|unique:users,email',
            'password' => 'required|min:8|max:30',
            'birthdate' => 'required|date',
        ];
    }
}
