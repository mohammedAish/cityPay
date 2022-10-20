<?php

namespace App\Observers;

use App\Models\DigitalCard;
use App\Models\DigitalCardProviderPackage;
use App\Models\DigitalCardsProvider;
use App\Models\DigitalCardStore;

class DigitalCardObserver
{
    public function creating(DigitalCard $digital_card){
        /*$package_id = $digital_card->d_c_package_id;
        if ($package_id) {
            $packageInfo = DigitalCardProviderPackage::where('id',$package_id)->first();
            if ($packageInfo) {
                $digital_card->store_id    = DigitalCardStore::find($packageInfo->store_id)->id;
                $digital_card->provider_id = DigitalCardsProvider::find($packageInfo->d_card_provider_id)->id;
            }
        }*/

        return $digital_card;
    }
    /*
        public function updating(DigitalCard $digital_card){
        }*/
}
