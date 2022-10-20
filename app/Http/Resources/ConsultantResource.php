<?php

namespace App\Http\Resources;

use App\Models\ConsultantsCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'consultant_type'   => $this->consultant_type,
            'price'             => $this->price,
            'currency'          => $this->currency->name,
            'description'       => $this->description,
            'who_will_benefit'  => $this->who_will_benefit,
            'what_will_benefit' => $this->what_will_benefit,
            'img_path'          => $this->img_path,
            'external_link'     => $this->external_link,
            'category'          => isset($this->additional['is_one'])
                ? new ConsultantCategoryResource($this->category) :'',
        ];
    }
}
