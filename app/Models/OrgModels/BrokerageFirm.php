<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class BrokerageFirm extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = "org_brokerage_firms";
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

  /*  public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
