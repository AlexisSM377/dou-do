<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Update Request to validate the User fields
 */
class UserUpdateRequest extends FormRequest
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
    public function rules()
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'name' => 'required|max:25|min:4|string',
                'last_name' => 'required|max:60|min:4|string',
                'email' => 'required|max:100|email',
                'password' => 'required|min:8|max:30',
                'birthdate' => 'required|date',
            ];
        } else if ($method == 'PATCH') {
            return [
                'name' => 'sometimes|required|max:25|min:4|string',
                'last_name' => 'sometimes|required|max:60|min:4|string',
                'email' => 'sometimes|required|max:100|email',
                'password' => 'sometimes|required|min:8|max:30',
                'birthdate' => 'sometimes|required|date',
            ];
        }

    }
}
