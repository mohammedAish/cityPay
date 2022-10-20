<?php

namespace App;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class IdentityDocumentation extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    protected $table = 'identity_documentations';
    
    protected $guarded = ['id'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
