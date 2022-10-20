<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceInstructionResource extends JsonResource
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
            'id'           => $this->id,
            'steps'        => $this->steps,
            'instructions' => $this->instructions,
            'img_path'     => $this->img_path,
        ];
    }
}
