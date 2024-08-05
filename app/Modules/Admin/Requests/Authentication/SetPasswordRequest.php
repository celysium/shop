<?php

namespace App\Modules\Admin\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
            'token'    => ['required', 'string']
        ];
    }
}
