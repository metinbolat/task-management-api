<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('PUT')) {
            return $this->user()->tokenCan('update-tasks');
        } else {
            return $this->user()->tokenCan('update-task-status');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'title' => 'required|string|max:255',
                'body' => 'required|string|min:10',
                'status' => ['required','string', Rule::in(['Tamamlandı', 'Devam ediyor'])],
                'assigned_date' => 'required',
                'due_date' => 'required',
                'user_ids' => 'nullable|array',
                'user_ids.*' => 'exists:users,id',
            ];
        }  else {
            return [
                'title' => 'sometimes|required|string|max:255',
                'body' => 'sometimes|required|string|min:10',
                'status' => ['sometimes','required','string', Rule::in(['Tamamlandı', 'Devam ediyor'])],
                'assigned_date' => 'sometimes|required',
                'due_date' => 'sometimes|required',
                'user_ids' => 'nullable|array',
                'user_ids.*' => 'sometimes|required|exists:users,id',
                'completed_date' => 'sometimes|required',
            ];
        }
    }
}
