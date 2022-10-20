<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Services extends Model
{
    use LogsActivity,CrudTrait;
    protected  $table = 'org_services';
    protected $guarded=[];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

     //One-2-Many relationship//
   /* public function service_category(){
        return $this->belongsTo(ServiceCategory::class,'service_category_id');
    }//end of function*/

    //One-2-Many relationship//
   /* public function Service_features(){
        return $this->hasMany(Service_features::class);
    }//end of function*/

   /* public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
