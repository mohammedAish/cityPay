<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInfoResource extends JsonResource
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
            "id"           => $this->id,
            "first_name"   => $this->first_name,
            "last_name"    => $this->last_name,
            "email"        => $this->email,
            "phone"        => $this->phone,
            "img_profile"  => $this->img_profile,
            "whatsapp_acc" => $this->whatsapp_acc,
            "facebook_acc" => $this->facebook_acc,
            "country_code" => $this->country_code,
            "gender"       => $this->gender,
            "birth_date"   => $this->birth_date,
            "address"      => $this->address,
            "badge_id"     => $this->badge_id,
            "badge_name"   => ($this->badge_id)? $this->badge->id :null,
            "full_name"    => $this->name,
        ];
    }
}
