<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Store Request to validate the Notification fields
 */
class NotificationStoreRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'title' => 'required|string|min:6',
            'description' => 'required|string|min:6',
        ];
    }
}
