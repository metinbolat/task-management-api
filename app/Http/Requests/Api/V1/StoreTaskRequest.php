<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'status' => ['required','string', Rule::in(['Tamamlandı', 'Devam ediyor'])],
            'assigned_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'completed_date' => 'nullable|date_format:Y-m-d',
            'user_id' => 'exists:users,ids'
        ];
    }
}
