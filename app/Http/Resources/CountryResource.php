<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "id"       => $this->id,
            "code"     => $this->code,
            "name"     => $this->name,
            "transfer_fee"     => $this->transfer_fee,
            //"is_source_transferring" => $this->is_source_transferring,
            //"is_dist_transferring"   => $this->is_dist_transferring,
            // "currency_id"            => $this->currency_id,
            "img_path" => $this->img_path,
            //"flag_path"              => $this->flag_path,
        ];
    }
}
