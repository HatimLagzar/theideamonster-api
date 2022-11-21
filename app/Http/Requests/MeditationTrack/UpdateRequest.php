<?php

namespace App\Http\Requests\MeditationTrack;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:192'],
            'duration' => ['required', 'string', 'max:192'],
            'track'    => ['file'],
        ];
    }
}
