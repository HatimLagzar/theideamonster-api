<?php

namespace App\Http\Requests\Delegable;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'job'    => ['required', 'string', 'max:255'],
            'tasks'  => ['required'],
            'avatar' => ['required']
        ];
    }
}
