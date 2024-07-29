<?php

namespace App\Modules\Admin\Requests\Admin\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'string']
        ];
    }
}
