<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request){
        $teacher = [
            "id"               => $this->id,
            "last_certificate" => $this->last_certificate,
            "classification"   => $this->classification,
            "scores"           => $this->scores,
            "skills"           => $this->skills,
            "rating"           => $this->rating,
            "join_date"        => $this->join_date,
            "teacher_name"     => $this->customer->name,
            "email"            => $this->customer->email,
            "phone"            => $this->customer->phone,
            "img_profile"      => $this->customer->img_profile,
            "whatsapp_acc"     => $this->customer->whatsapp_acc,
            "facebook_acc"     => $this->customer->facebook_acc,
            "country"          => $this->customer->country_code,
            "gender"           => $this->customer->gender,
        ];

        return $teacher;
    }

}
