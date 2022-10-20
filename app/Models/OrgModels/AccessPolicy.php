<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AccessPolicy extends Model
{
    use LogsActivity,CrudTrait;
    protected $table ='org_access_policies';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $guarded = [];
}
