<?php

namespace App\Modules\Admin\Resources\Widget;

use App\Modules\Core\Models\Widget;
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
        /** @var Widget $this */
        return [
            'id'        => $this->id,
            'name'       => $this->name,
            'slug'       => $this->slug,
            'icon'       => $this->icon,
            'banner'     => $this->banner,
            'status'     => $this->status,
        ];
    }
}
