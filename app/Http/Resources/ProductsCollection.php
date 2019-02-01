<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->limitedData(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
    
    /**
     * custom collection.
     * @return array
     */
    public function limitedData()
    {
        $productCollection  = [];
        foreach ($this->collection as $product) {
            $productCollection[] = [
                'id' => $product->getAttribute('id'),
                'title' => $product->getAttribute('title'),
                'price' => $product->getAttribute('price'),
                'image_url' => $product->getAttribute('image_url'),
                'stock' => $product->getAttribute('stock')
            ];
        }
        return $productCollection;
    }
}
