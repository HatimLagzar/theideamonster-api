<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'min:1', 'max:30', 'required'],
            'last_name' => ['string', 'min:1', 'max:30', 'required'],
            'email' => ['email', 'max:100', 'required'],
            'gender' => ['numeric', Rule::in([User::MALE_GENDER, User::FEMALE_GENDER])],
            'password' => ['string', 'confirmed', 'min:5', 'max:32', 'required'],
        ];
    }
}
