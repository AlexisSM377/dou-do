<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class WorkspaceUpdateRequest extends FormRequest
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
        if ($this->method() == 'PAT') {
            return [
                'name' => 'required|string|min:6',
                'description' => 'required|string|min:8',
                'color' => 'required|string',
                'advance' => 'required|integer',
            ];
        } else if ( $this->method() == 'PATCH' ) {
            return [
                'name' => 'sometimes|required|string|min:6',
                'description' => 'sometimes|required|string|min:8',
                'color' => 'sometimes|required|string',
                'advance' => 'sometimes|required|integer',
            ];
        }
    }
}
