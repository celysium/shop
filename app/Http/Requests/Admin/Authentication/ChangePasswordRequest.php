<?php

namespace App\Http\Requests\Admin\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'confirmed', 'min:8'],
        ];
    }
}
