<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => stripslashes($this->title),
            'abstract' => stripslashes($this->abstract),
            'description' => stripslashes($this->description),
            'price' => $this->price,
            'image_url' => $this->image_url,
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
