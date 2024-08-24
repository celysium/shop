<?php

namespace App\Modules\Admin\Requests\Widget;

use App\Modules\Core\Models\Widget;
use App\Modules\Core\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string'],
            'slug'          => ['sometimes', 'string', 'unique:widgets,slug'],
            'icon'          => ['sometimes', 'file', 'max:200'],
            'image'         => ['sometimes', 'file', 'max:500'],
            'status'        => ['required', new Enum(Widget::class)],
            'products_id'   => ['required', 'array'],
            'products_id.*' => ['exists:products,id'],
        ];
    }
}
