<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DCProviderPackageResource extends JsonResource
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
            'id'              => $this->id,
            'package_id'      => $this->id,
            'provider_id'     => $this->d_card_provider_id,
            'store_id'        => $this->store_id,
            'digital_card_id' => $this->digital_card_id,
            'name'            => $this->name,
            'price'           => $this->price,
            'currency_id'     => $this->currency_id,
            'currency_name'   => $this->currency->name,
            'expire_days'     => $this->expire_days,
            // 'img_path'      => $this->img_path,
        ];
    }
}
