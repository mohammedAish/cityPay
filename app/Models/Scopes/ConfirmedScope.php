<?php


namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ConfirmedScope implements Scope
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
        return $builder->where('current_status','confirmed');
    }
}
