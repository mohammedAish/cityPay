<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawAgenciesResource extends JsonResource
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
            'id'                    => $this->id,
            'name'                  => $this->name,
            'phone'                 => $this->phone,
            'address'               => $this->address,
            'national'              => $this->national,
            "img_path"              => $this->img_path,
            'deposit_fee_percent'   => $this->deposit_fee_percent,
            'fixed_charge_deposit'  => $this->fixed_charge_deposit,
            'min_withdraw_amount'   => $this->min_withdraw_amount,
            'max_withdraw_amount'   => $this->max_withdraw_amount,
            'withdraw_instructions' => $this->withdraw_instructions,
            'description'           => $this->description,
        ];
    }
}
