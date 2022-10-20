<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Traits\Rounding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Certificate extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = 'org_certificates';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $guarded = [];
   /* public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
