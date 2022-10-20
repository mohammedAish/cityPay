<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            "id"         => $this->id,
            "short_name" => $this->abbr,
            "locale"     => $this->locale,
            "name"       => $this->name,
            "local_name" => $this->local_name,
            "direction"  => $this->direction,
        ];
    }
}
