<?php


namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ActiveScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     *
     * @return $this|Builder
     */
    public function apply(Builder $builder,Model $model){
        // Load all entries for the Admin panel
        /* if (request()->segment(1) == admin_uri()) {
             return $builder;
         }*/

        // Load only activated entries for the front
        return $builder->where('active',1);
    }
}
