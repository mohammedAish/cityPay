<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Service_features extends Model
{
    use LogsActivity,CrudTrait;
    protected  $table = 'org_service_features';
    protected $guarded=[];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    //One-2-Many relationship//
   /* public function service(){
        return $this->belongsTo(Services::class);
    }//end of function*/

   /* public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
