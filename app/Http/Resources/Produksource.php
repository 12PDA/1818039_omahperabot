<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Produksource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
        'id'             => $this->id,
        'nama_produk'    => $this->nama_produk,
        'harga'          => $this->harga,
        'desc'           => $this->desc,
        ];
        
        
    }
}
