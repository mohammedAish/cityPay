<?php

namespace App\Models;

use App\Models\Traits\ActiveTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use ActiveTrait;
    public function asJson($value){
        return json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    public function scopeLimitOrder($query,$limit,$last_id){
        return $query->limit($limit)->where('id','>',$last_id)->orderBy('id','asc');
    }

}
