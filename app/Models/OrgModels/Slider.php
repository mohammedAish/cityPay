<?php

namespace App\Models\OrgModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{


    use LogsActivity;
    protected $table = 'org_sliders';
    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    /*public function scopeRestricteduser($query)
    {
        if (Auth::user()->level!='super_admin')
            return $query->where('user_id',Auth::user()->id);
        else
            return $query;

    }*/
}
