<?php

namespace App\Modules\Admin\Requests\Banner;

use App\Modules\Core\Enumerations\Banner\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'     => ['sometimes', 'string'],
            'slider_id' => ['nullable', 'exists:sliders,id'],
            'image'     => ['sometimes', 'file', 'max:700'],
            'url'       => ['required', 'url'],
            'position'  => ['sometimes', 'integer', 'min:0'],
            'status'    => ['sometimes', new Enum(Status::class)],
        ];
    }
}
