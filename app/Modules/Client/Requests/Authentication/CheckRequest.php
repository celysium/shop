<?php

namespace App\Modules\Client\Requests\Authentication;

use Celysium\Helper\Rules\Mobile;
use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mobile'    => ['required', new Mobile() , 'exists:users,mobile'],
        ];
    }
}
