<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayingOrderResource extends JsonResource
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
            'product_name'       => $this->product_name,
            'paying_date'        => $this->paying_date,
            'product_price'      => $this->product_price,
            'currency_id'        => ($this->currency)?$this->currency->name:null,
            'commission_percent' => $this->commission_percent,
            'commission_fee'     => $this->commission_fee,
            'description'        => $this->description,
            'link_url'           => $this->link_url,
            'current_status'     => $this->current_status,
            'admin_note'         => $this->admin_note,
        ];
    }
}
