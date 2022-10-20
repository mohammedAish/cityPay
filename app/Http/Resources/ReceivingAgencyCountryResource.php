<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceivingAgencyCountryResource extends JsonResource
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
            "id"                => $this->id,
            "agency_name"       => $this->agency_name,
            "agency_desc"       => $this->agency_desc,
            "receive_method"    => $this->receive_method,
            "agency_country_id" => $this->ra_c_id,
            "transfer_fee"      => $this->transfer_fee,
        ];
    }
}
