<?php

namespace App\Models\OrgModels;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    protected $table = 'org_posts';
    protected $guarded = [];
    use LogsActivity;
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }//end of function

    public function category(){
        return $this->belongsTo(PostCategory::class,'post_category_id','id');
    }//end of function

    /*public function comments()
    {
        return $this->hasMany(PostNewwComment::class,'post_id')->where('comment_for','posts');
    }*/
    /*public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
