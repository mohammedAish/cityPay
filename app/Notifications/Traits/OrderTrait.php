<?php


namespace App\Notifications\Traits;


use App\Models\EmailTemplate;

trait OrderTrait
{
    public function getEmailParams() {
        $op_type=$this->deposit_order->op_type;
        $status=$this->deposit_order->current_status;
        $params = EmailTemplate::where('category', strtoupper($op_type))
            ->where('name', strtoupper($op_type).'_'.strtoupper($status))->first();
        if (!$params) {
            return null;
        }

        return $params;

    }
}