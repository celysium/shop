<?php

namespace App\Modules\Panel\Requests\Banner;

use App\Modules\Core\Models\Banner;
use App\Modules\Core\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

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
            'status'    => ['sometimes', new Enum(Banner::class)],
        ];
    }
}
