<?php

namespace App\Models\OrgModels;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsletterSubscriber extends Model
{
    use LogsActivity;
    protected $table = 'org_newsletter_subscribers';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected $guarded =[];

}
