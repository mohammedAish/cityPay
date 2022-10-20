<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DCProviderResource extends JsonResource
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
            'id'                 => $this->id,
            'name'               => $this->name,
            'short_desc'         => $this->short_desc,
            'description'        => $this->description,
            'back_ground_color1' => $this->back_ground_color1,
            'back_ground_color2' => $this->back_ground_color2,
            'img_path'           => $this->img_path,
            'category_id'        => $this->category_id,
            'category'           => isset($this->additional['once'])? $this->category :null,
        ];
    }
}
