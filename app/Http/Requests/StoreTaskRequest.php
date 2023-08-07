<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,done',
            'user_assigned_id' => 'required|exists:users,id',
            'deadline' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле ":attribute" обов\'язкове.',
            'description.required' => 'Поле ":attribute" обов\'язкове.',
            'deadline.required' => 'Поле ":attribute" обов\'язкове.',
            // Дополнительные пользовательские сообщения об ошибках...
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Назва',
            'description' => 'Опис',
            'deadline' => 'Крайній термін',
            // Дополнительные пользовательские атрибуты...
        ];
    }

}
