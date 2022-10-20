<?php

namespace App\Models\OrgModels;

use App\Models\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class News extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = 'org_news';
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /*public function comments(){
        return $this->hasMany(PostNewwComment::class,'neww_id')->where('comment_for','news');
    }*/

   /* public function scopeRestricteduser($query){
        if (Auth::user()->level != 'super_admin') {
            return $query->where('user_id',Auth::user()->id);
        } else {
            return $query;
        }
    }*/
}
