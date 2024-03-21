<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'title' => 'required|string|min:8|max:40',
            'description' => 'required|min:8|max:245',
            'workspace_id' => 'required',
            'priority_id' => 'required|integer',
            'due_date' => 'required|date',
        ];
    }
}
