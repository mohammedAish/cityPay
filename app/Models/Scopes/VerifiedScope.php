<?php


namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class VerifiedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     * @return $this|Builder
     */
    public function apply(Builder $builder, Model $model) {
        if (request()->segment(1) == admin_uri()) {
            return $builder;
        }

        return $builder->where('email_verified_at','!=', null)
            //->where('verified_phone', 1)
            ;
    }
}
