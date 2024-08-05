<?php

namespace App\Modules\Admin\Resources\Category;

use App\Modules\Core\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DetailResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Category $this */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'parent'      => $this->parent->only(['id', 'name']),
            'slug'        => $this->slug,
            'icon'        => $this->icon,
            'path'        => $this->path,
            'image'       => $this->image,
            'description' => $this->description,
            'status'      => $this->status,
            'level'       => $this->level,
            'position'    => $this->position,
            'visible'     => $this->visible,
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
