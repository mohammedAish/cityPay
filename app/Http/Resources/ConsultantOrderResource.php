<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantOrderResource extends JsonResource
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
            "order_id"       => $this->id,
            "price"          => $this->price,
            "is_open"        => true,
            "current_status" => $this->current_status,
            "paid_status"    => $this->paid_status,
        ];
    }
}
