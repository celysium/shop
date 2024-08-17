<?php

namespace App\Modules\Admin\Requests\Widget;

use App\Modules\Core\Enumerations\Widget\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string'],
            'slug'          => ['sometimes', 'string', 'unique:widgets,slug'],
            'icon'          => ['nullable', 'file', 'max:200'],
            'image'         => ['nullable', 'file', 'max:500'],
            'status'        => ['required', new Enum(Status::class)],
            'products_id'   => ['required', 'array'],
            'products_id.*' => ['exists:products,id'],
        ];
    }
}
