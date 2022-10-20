<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceivingAgencyResource extends JsonResource
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
            "id"             => $this->id,
            "agency_name"    => $this->agency_name,
            "agency_desc"    => $this->agency_desc,
            "img_path"       => $this->img_path,
        ];
    }
}
