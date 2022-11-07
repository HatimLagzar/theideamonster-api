<?php

namespace App\Http\Requests\Milestone;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ends_at'   => ['date', 'required'],
            'basket_id' => ['required', 'string'],
            'is_done'   => ['required', 'bool'],
        ];
    }
}
