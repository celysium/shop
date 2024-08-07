<?php

namespace App\Modules\Admin\Resources\Banner;

use App\Modules\Core\Models\Banner;
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
        /** @var Banner $this */
        return [
            'id'        => $this->id,
            'slider_id' => $this->slider_id,
            'image_url' => $this->image_url,
            'title'     => $this->title,
            'url'       => $this->url,
            'status'    => $this->status,
        ];
    }
}
