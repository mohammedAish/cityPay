<?php

namespace App\Observers;

use App\Models\DCardsPurchasesDetail;
use App\Models\DigitalCard;
use App\Models\DigitalCardProviderPackage;

class DCardsPurchasesDetailObserver
{
    public function created(DCardsPurchasesDetail $DCPCreated){
        $this->updatePrice($DCPCreated);

        return $this->updateOldPurchasePrices($DCPCreated->digital_card_id,$DCPCreated->sell_price);
    }

    public function updated(DCardsPurchasesDetail $dCPUpdated){
        $original = $dCPUpdated->getOriginal();
        if ($original['sell_price'] !== $dCPUpdated->sell_price) {
            $this->updatePrice($dCPUpdated);
        }

        return $this->updateOldPurchasePrices($dCPUpdated->digital_card_id,$dCPUpdated->sell_price);
    }

    private function updatePrice($DCPCreated){
        $id            = $DCPCreated->digital_card_id;
        $pck_id        = DigitalCard::find($id)->d_c_package_id;
        $updated_price = DigitalCardProviderPackage::whereId($pck_id)
            ->update([
                'price' => $DCPCreated->sell_price,
            ]);

        return $updated_price;
    }

    private function updateOldPurchasePrices($digital_card_id,$sell_price){
        return DCardsPurchasesDetail::whereDigitalCardId($digital_card_id)
            ->where('card_status','free')
            ->whereNull('customer_d_c_order_id')
            ->update(['sell_price' => $sell_price]);
    }
}
