<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorReport extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    protected $guarded = ['id'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
