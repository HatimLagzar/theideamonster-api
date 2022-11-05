<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'min:1', 'max:255']
        ];
    }
}
