<?php

namespace App\Modules\Admin\Requests\Admin\Authentication;

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
