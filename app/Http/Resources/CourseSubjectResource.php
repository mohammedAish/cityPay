<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseSubjectResource extends JsonResource
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
            'path'        => $this->subject_path,
            'sort'        => $this->sort,
            'description' => $this->description,
            'duration'    => $this->duration,
            'is_free'     => $this->is_free,
            'likes'       => $this->likes,
            'visited'     => $this->visited,
            'dis_likes'   => $this->dis_likes,
        ];
    }
}
