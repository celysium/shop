<?php

namespace App\Modules\Client\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
            'code'     => ['required', 'string']
        ];
    }
}
