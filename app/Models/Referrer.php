<?php

namespace App\Models;


class Referrer extends BaseModel
{
    protected $table = 'referrers';

    protected $fillable = ['session_id', 'ip_address', 'referrer_id', 'other_info'];
}
