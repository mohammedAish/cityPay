<?php

namespace App\Models\Traits;


trait ActiveTrait
{
    public function getActiveHtml()
    {
        if (!isset($this->active)) return false;

        return ajaxCheckboxDisplay($this->{$this->primaryKey}, $this->getTable(), 'active', $this->active);
    }
}
