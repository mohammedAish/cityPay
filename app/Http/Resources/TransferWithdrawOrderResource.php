<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferWithdrawOrderResource extends JsonResource
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
            "id"                      => $this->id,
            "amount"                  => $this->amount,
            "currency_id"             => $this->currency_id,
            "exchange_price"          => $this->exchange_price,
            "transfer_fee"            => $this->transfer_fee,
            "fee_percent"             => $this->fee_percent,
            "transferred_amount"      => $this->transferred_amount,
            "transferred_currency_id" => $this->transferred_currency_id,
            "receiving_mode"          => $this->receiving_mode,
            "current_status"          => $this->current_status,
            "status_note"             => $this->status_note,
            /*    "status_changed_date": null,
                "detail_statement": null,
                "admin_id": null,*/
            "img_path"                => $this->img_path,
            'agency_name'             => $this->agencyCountry->transferAgency->agency_name,
            'country'                 => $this->agencyCountry->country->name,
            'currency'                => $this->currency->name,
            'created_at'                => $this->created_at,
            'created_at_human'                => $this->created_at->diffForHumans(),
            'last_updated'                => $this->updated_at,
            'last_updated_human'                => $this->updated_at->diffForHumans(),
        ];
    }
}
