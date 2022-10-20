<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseTrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request){
        $minimum = [

            "id"                 => $this->id,
            "teacher_id"         => $this->teacher_id,
            "name"               => $this->name,
            "course_category_id" => $this->course_category_id,
            "language"           => $this->language,
            "description"        => $this->description,
            "img_path"           => $this->img_path,
            "price"              => $this->price,
            "discount"           => $this->discount,
            "discount_type"      => $this->discount_type,
            "external_link"      => $this->external_link,
            "level"              => $this->level,
            "subjects_count"     => $this->subjects_count,
            "duration"           => $this->duration,
            "total_students"     => $this->total_students,
            "rating"             => $this->rating,


        ];
        if (isset($this->additional['is_one'])) {
            $minimum = array_merge($minimum,$this->extraArray());
        }

        return $minimum;
    }

    function extraArray(){
        return [
            "currency_id"          => $this->currency->name,
            "teacher_name"         => $this->teacher->customer->name,
            "teacher_info"         => new TeacherDetailResource($this->teacher),
            "requirements"         => $this->requirements,
            "what_learn"           => $this->what_learn,
            "course_category_name" => new CourseCategoryResource($this->category),
            "course_subjects"      => CourseSubjectResource::collection($this->courseSubjects),
        ];
    }
}
