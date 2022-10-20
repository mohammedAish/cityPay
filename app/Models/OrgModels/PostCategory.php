<?php

namespace App\Models\OrgModels;

use App\Models\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class PostCategory extends Model
{
    //
    use LogsActivity,CrudTrait;
    protected $table = "org_post_categories";
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }//end of function

    /*public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
