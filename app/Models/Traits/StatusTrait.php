<?php


namespace App\Models\Traits;


trait StatusTrait
{
    public function getCurrentStatusArAttribute()
    {
        if (isset($this->attributes['current_status']) && is_string($this->attributes['current_status'])) {
            if (isFromAdminPanel()) {
                return $this->attributes['current_status'];
            }

            return trans('status.'.$this->attributes['current_status']);
        }

    }
    public function getDepositTypeAttribute(){
        if (isset($this->attributes['deposit_type']) &&
            is_string($this->attributes['deposit_type'])) {
            if (isFromAdminPanel()) {
                return $this->attributes['deposit_type'];
            }

            return trans('status.'.$this->attributes['deposit_type']);
        }
    }

}
