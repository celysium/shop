<?php

namespace App\Modules\Admin\Requests\Category;

use App\Modules\Core\Enumerations\Category\Status;
use App\Modules\Core\Enumerations\Category\Visibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'parent_id'   => ['required', 'exists:categories,id'],
            'icon'        => ['sometimes', 'file', 'max:200'],
            'image'       => ['sometimes', 'file', 'max:500'],
            'description' => ['required', 'string'],
            'status'      => ['required', new Enum(Status::class)],
            'position'    => ['sometimes', 'integer', 'min:0'],
            'visible'     => ['required', new Enum(Visibility::class)],
        ];
    }
}
