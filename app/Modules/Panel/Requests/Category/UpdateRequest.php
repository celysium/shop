<?php

namespace App\Modules\Panel\Requests\Category;

use App\Modules\Core\Models\Category;
use App\Modules\Core\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['sometimes', 'string'],
            'slug'        => ['sometimes', 'string'],
            'parent_id'   => ['sometimes', 'exists:categories,id'],
            'icon'        => ['sometimes', 'file', 'max:200'],
            'image'       => ['sometimes', 'file', 'max:500'],
            'description' => ['sometimes', 'string'],
            'status'      => ['sometimes', new Enum(Category::class)],
            'position'    => ['sometimes', 'integer', 'min:0'],
            'visible'     => ['sometimes', new Enum(Category::class)],
        ];
    }
}
