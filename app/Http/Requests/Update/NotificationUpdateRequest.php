<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

/**
 * RequestUpdate from Notifications
 */
class NotificationUpdateRequest extends FormRequest
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
                'user_id' => 'required|integer',
                'title' => 'required|string|min:6',
                'description' => 'required|string|min:6',
            ];
        } else if ($method == 'PATCH') {
            return [
                'user_id' => 'sometimes|required|integer',
                'title' => 'sometimes|required|string|min:6',
                'description' => 'sometimes|required|string|min:6',
            ];
        }
    }
}
