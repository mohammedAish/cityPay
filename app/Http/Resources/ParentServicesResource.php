<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentServicesResource extends JsonResource
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
            'name'        => $this->name,
            'description' => $this->description,
            'img_path'    => $this->img_path,
            'img_path_en' => $this->img_path_en,
            'services'    => ServicesRource::collection($this->services),
        ];
    }

    function getName($attrValue){
        $val = json_decode($attrValue,true);
        if (isset($val[current_local()])) {
            return $val[current_local()];
        } else {
            $val['ar'];
        }
    }
}

