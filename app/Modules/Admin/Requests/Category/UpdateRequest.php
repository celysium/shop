<?php

namespace App\Modules\Admin\Requests\Category;

use App\Modules\Core\Enumerations\Category\Status;
use App\Modules\Core\Enumerations\Category\Visibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'status'      => ['sometimes', new Enum(Status::class)],
            'position'    => ['sometimes', 'integer', 'min:0'],
            'visible'     => ['sometimes', new Enum(Visibility::class)],
        ];
    }
}
