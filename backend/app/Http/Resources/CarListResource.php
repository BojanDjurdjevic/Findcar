<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CarListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'year' => $this->year,

            'make' => $this->make?->name,
            'model' => $this->model?->name,

            'image' => $this->images->first()
                ? Storage::url($this->images->first()->image_path)
                : null,
            
            'user_id' => $this->user_id
        ];
    }
}
