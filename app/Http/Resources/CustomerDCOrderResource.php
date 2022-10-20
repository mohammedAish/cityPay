<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDCOrderResource extends JsonResource
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
            "customer_id"        => $this->customer_id,
            "current_status"     => $this->current_status,
            "total_amount"       => $this->total_amount,
            "cards_codes"        => $this->cards_codes,
            "customer_hint"      => $this->customer_hint,
            "admin_note"         => $this->admin_note,
            "digital_cards_bought" => $this->digitalCardsBought ?? null,
        ];
    }
}
