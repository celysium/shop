<?php

namespace App\Modules\Admin\Requests\Category;

use App\Modules\Core\Models\Category;
use App\Modules\Core\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'slug'        => ['required', 'string'],
            'parent_id'   => ['required', 'exists:categories,id'],
            'icon'        => ['sometimes', 'file', 'max:200'],
            'image'       => ['sometimes', 'file', 'max:500'],
            'description' => ['required', 'string'],
            'status'      => ['required', new Enum(Category::class)],
            'position'    => ['sometimes', 'integer', 'min:0'],
            'visible'     => ['required', new Enum(Category::class)],
        ];
    }
}
