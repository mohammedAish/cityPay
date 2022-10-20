<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositAgenciesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'phone'                => $this->phone,
            'address'              => $this->address,
            'national'             => $this->national,
            "img_path"             => $this->img_path,
            'ytadawul_acc_number'  => $this->ytadawul_account_number,
            'ytadawul_acc_name'    => $this->ytadawul_account_name,
            'deposit_fee_percent'  => $this->deposit_fee_percent,
            'fixed_charge_deposit' => $this->fixed_charge_deposit,
            'min_deposit_amount'   => $this->min_deposit_amount,
            'max_deposit_amount'   => $this->max_deposit_amount,
            'deposit_instructions' => $this->deposit_instructions,
            'description'          => $this->description,
        ];
    }
}
