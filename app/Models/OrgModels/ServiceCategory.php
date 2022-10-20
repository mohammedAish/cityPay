<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class ServiceCategory extends Model
{
    use LogsActivity,CrudTrait;
    protected  $table = 'org_service_categories';
    protected $guarded=[];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /*public function services()
    {
        return $this->hasMany(Services::class,'course_id','id');
    }//end of products*/
   /* public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
