<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['sometimes', 'required', 'string', 'min:1', 'max:255'],
            'audio'   => ['sometimes', 'file', 'max:10000'],
            'type'    => ['required', Rule::in(['1', '2'])]
        ];
    }
}
