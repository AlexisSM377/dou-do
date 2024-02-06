<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class NotificationBulkRequest extends FormRequest
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
            '*.user_id' => 'required|integer',
            '*.title' => 'required|string|min:4',
            '*.description' => 'required|string|min:6',
        ];
    }
}
