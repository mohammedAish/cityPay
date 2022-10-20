<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordActivity extends Model
{
    protected $table = 'record_activities';
    
    protected $guarded = ['id'];
}
