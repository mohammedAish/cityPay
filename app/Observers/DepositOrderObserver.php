<?php

namespace App\Observers;

use App\Events\WalletTransactionEvent;
use App\Models\Customer;
use App\Models\DepositWithdrawProcess;
use App\Models\Traits\WalletModelTrait;
use App\Models\DepositOrder;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Event;

class DepositOrderObserver
{
    use WalletModelTrait;

    public function created(DepositOrder $deposit_order) {

        if ($deposit_order->op_type == 'withdraw' && 'current_status' == 'confirmed') {
            $this->execWithdrawWallet($deposit_order);
        }
    }

    public function updated(DepositOrder $deposit_order) {

        $originalAttributes = $deposit_order->getOriginal();

        if (isFromAdminPanel()) {

            //perform saving
            $originalStatus = $originalAttributes['current_status'];
            //if the current is confirmed and the previous not confirmed

            //to prevent the exec more then once
            if (($deposit_order->current_status != 'confirmed') && $originalStatus == 'confirmed') {
                return;
            }
            if (($deposit_order->current_status !== 'rejected') && $originalStatus == 'rejected') {
                return;
            }
            if ($deposit_order->current_status == 'confirmed' && $deposit_order->op_type == 'deposit') {
                try {
                    $this->execRelatedDepositOps($deposit_order->toArray());
                } catch (\Exception $ex) {
                    //todo try it
                    $deposit_order->fill($originalAttributes);
                    $deposit_order->removeObservableEvents('updated');
                    $deposit_order->save();
                    \Alert::error($ex->getMessage())->flash();
                }
            }
            //if confirmed
            if ($deposit_order->current_status == 'confirmed' && $deposit_order->op_type == 'withdraw') {
                try {
                    $deposit_order->customer->notify(new OrderNotification($deposit_order, cp('su_withdraw_notification_subject'), cp('su_withdraw_notification_description')));
                    $this->execWithdrawWallet($deposit_order);
                    $this->updateWalletTrxToConfirmed($deposit_order->toArray());
                } catch (\Exception $ex) {
                    $deposit_order->fill($originalAttributes);
                    $deposit_order->removeObservableEvents('updated');
                    $deposit_order->save();
                    \Alert::error($ex->getMessage())->flash();
                }

            }//if confirmed

            //if withdrawal rejected
            if ($deposit_order->current_status == 'rejected' && $deposit_order->op_type == 'withdraw') {
                try {
                    $this->doReTheWithdrawal($deposit_order->toArray());
                } catch (\Exception $ex) {
                    $deposit_order->fill($originalAttributes);
                    $deposit_order->removeObservableEvents('updated');
                    $deposit_order->save();
                    \Alert::error($ex->getMessage())->flash();
                }

            }

        }
            //todo try it
            if ($deposit_order->isDirty()) {
                $processing                    = new DepositWithdrawProcess();
                $processing->processable_type  = '\\App\\\Models\\DepositOrder';
                $processing->processable_id    = $deposit_order->id;
                $processing->reference_id_type = $deposit_order->op_type;
                //$processing->transfer_number   = transfer_number::class;
                $changes   = $deposit_order->getChanges();
                $keys      = array_keys($changes);
                $oldValues = [];
                foreach ($keys as $key) {
                    $oldValues[$key] = $originalAttributes[$key];
                }
                $processing->old_values = json_encode($oldValues);
                $processing->new_values = json_encode($deposit_order->getChanges());
                if (isFromAdminPanel()) {
                    $processing->admin_id         = auth()->id();
                    $processing->admin_note       = $deposit_order->status_note;
                    $processing->last_modified_by = 'admin';
                } else {
                    $processing->last_modified_by = 'customer';
                }
                $processing->save();
            }

    }
}
