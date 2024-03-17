<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'user_id' => 'required',
                'priority_id' => 'required|integer',
                'title' => 'required|string|min:8|max:40',
                'description' => 'required|min:8|max:245',
                'due_date' => 'required|date',
            ];
        } else if ($this->method() == 'PATCH') {
            return [
                'user_id' => 'sometimes|required',
                'priority_id' => 'sometimes|required|integer',
                'title' => 'sometimes|required|string|min:8|max:40',
                'description' => 'sometimes|required|min:8|max:245',
                'due_date' => 'sometimes|required|date',
            ];
        }
    }
}
