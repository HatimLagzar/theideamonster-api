<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'basket_id' => ['required'],
            'task_id'   => ['nullable'],
            'starts_at' => ['nullable', 'date'],
            'ends_at'   => ['nullable', 'date'],
        ];
    }
}
