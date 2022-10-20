<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FreeLancingPlatformResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request) {
        return [
            'id'                      => $this->id,
            'name'                    => $this->name,
            'phone'                   => $this->phone,
            'address'                 => $this->address,
            'international'           => $this->national,
            "img_path"                => $this->img_path,
            'ytadawul_acc_number'     => $this->ytadawul_account_number,
            'description'             => $this->description,
            'max_deposit_amount'      => $this->max_deposit_amount,
            'min_deposit_amount'      => $this->min_deposit_amount,
            'deposit_agency_id'       => $this->f_p_d_id,
            'ytadawul_account_number' => $this->ytadawul_account_number,
            'ytadawul_account_name'   => $this->ytadawul_account_name,
            'fixed_charge_deposit'    => $this->fixed_charge_deposit,
            'deposit_fee_percent'     => $this->deposit_fee_percent,
        ];
    }
}
