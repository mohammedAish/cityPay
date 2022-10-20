<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TradingAgencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request){
        /*
         * `name`, `description`, `img_path`, `img_path_en`, `primary_email`,
         * `secondary_mail`, `phone1`, `phone2`,
         *  `contact_info`, `email_from_yt_to`, `email_from_cust_to`, `agency_terms`
         */
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'img_path'     => $this->img_path,
            'email'        => $this->primary_email,
            'other_mail'   => $this->secondary_mail,
            'phone'        => $this->phone1,
            'contact_info' => $this->contact_info,
            'agency_terms' => $this->agency_terms,
            'services'     => $this->services? TradingServiceResource::collection($this->services) :null,

        ];
    }
}
