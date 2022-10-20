<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicesRource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request){
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price_type'  => $this->price_type,
            'img_path'    => $this->id,
            'img_path_en' => $this->id,

        ];
    }
}
