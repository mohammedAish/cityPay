<?php

namespace App\Observers;

use App\Models\Traits\WalletModelTrait;
use App\Models\TransferWithdrawOrder;

class TransferWithdrawObserver
{
    use WalletModelTrait;

    public function updated(TransferWithdrawOrder $transfer_order){
        //perform saving
        $originalAttributes = $transfer_order->getOriginal();
        $originalStatus     = $originalAttributes['current_status'];
        //if the current is confirmed and the previous not confirmed
        if (($transfer_order->current_status != 'confirmed') && $originalStatus == 'confirmed') {
            return;
        }
        if ($transfer_order->current_status == 'confirmed') {
            $this->execTransfer($transfer_order->toArray());
        }//if confirmed
    }
}
