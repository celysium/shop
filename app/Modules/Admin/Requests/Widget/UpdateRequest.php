<?php

namespace App\Modules\Admin\Requests\Widget;

use App\Modules\Core\Enumerations\Widget\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string'],
            'slug'          => ['sometimes', 'string', 'unique:widgets,slug'],
            'icon'          => ['sometimes', 'file', 'max:200'],
            'image'         => ['sometimes', 'file', 'max:500'],
            'status'        => ['required', new Enum(Status::class)],
            'products_id'   => ['required', 'array'],
            'products_id.*' => ['exists:products,id'],
        ];
    }
}
