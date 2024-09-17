<?php

namespace App\Modules\Client\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string'],
            'lastname'  => ['required', 'string']
        ];
    }
}
