<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'stock'       => $this->stock > 0 ? $this->stock : 'Out of stock',
            'discount'    => $this->discount,
            'totalPrice'  => round((1 - ($this->discount / 100)) * $this->price,2),
            'rating'      => $this->reviews->count() > 0 ? round($this->reviews->sum('rating') / $this->reviews->count(),2) : 'No rating yet',
            'href'        => [
                'reviews' => route('reviews.index',$this->id)
            ]
        ];
    }
}
