<?php

namespace App\Models\OrgModels;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact_us_social_link_setups extends Model
{
    use LogsActivity,CrudTrait;
    protected $table = 'org_contact_us_social_link_setups';
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

}
