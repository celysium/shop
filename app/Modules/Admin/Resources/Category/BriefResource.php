<?php

namespace App\Modules\Admin\Resources\Category;

use App\Modules\Core\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BriefResource extends ResourceCollection
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
            'id'     => $this->id,
            'name'   => $this->name,
            'icon'   => $this->icon,
            'path'   => $this->path,
            'image'  => $this->image,
            'status' => $this->status,
        ];
    }
}
