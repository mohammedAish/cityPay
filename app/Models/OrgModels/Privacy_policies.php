<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Privacy_policies extends Model
{
    use LogsActivity,CrudTrait;
   protected $table = 'org_privacy_policies';
   protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
}
