<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositOrderResource extends JsonResource
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
            "id"                 => $this->id,
            "deposit_date"       => $this->deposit_date->toDateTimeString(),
            "deposit_date_human" => $this->deposit_date->diffForHumans(),
            "amount"             => $this->amount,
            "currency_id"        => $this->currency_id,
            "customer_id"        => $this->customer_id,
            "deposit_type"       => $this->deposit_type,
            "country_id"         => $this->additional['country_id'] ?? '',
            "deposit_agency_id"  => $this->additional['deposit_agency_id'] ?? '',
            "country_name"       => ($this->agencyCountry->country)
                ? $this->agencyCountry->country->name :'',
            "agency_name"        => ($this->agencyCountry->depositAgency)
                ? $this->agencyCountry->depositAgency->name :'',
            'currency'           => ($this->currency->name)
                ? $this->currency->name :'',
            /*            "deposit_agency_country_id" =>$this->deposit_agency_country_id,*/
            "current_status"     => $this->current_status,
        ];
    }
}
