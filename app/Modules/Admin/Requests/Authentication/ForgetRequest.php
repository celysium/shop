<?php

namespace App\Modules\Admin\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class ForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
        ];
    }
}
