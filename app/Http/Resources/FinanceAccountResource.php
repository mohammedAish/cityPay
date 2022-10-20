<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinanceAccountResource extends JsonResource
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
            "id"                         => $this->id,
            "customer_id"                => $this->customer_id,
            "agency_id"                  => $this->agency_id,

            "customer_agency_acc_number" => $this->customer_agency_acc_number,
            'agency'=>new DepositAgenciesResource($this->agency)
        ];
    }
}
