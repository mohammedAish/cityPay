<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCode extends Model
{
    protected $table = 'customers_codes';
    
    protected $guarded = ['id'];
}
