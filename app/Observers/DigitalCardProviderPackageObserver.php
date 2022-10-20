<?php

namespace App\Observers;

use App\Models\DigitalCard;
use App\Models\DigitalCardProviderPackage;

class DigitalCardProviderPackageObserver
{
    public function created(DigitalCardProviderPackage $created){
        try {
            $createDG=DigitalCard::create([
                    'd_c_package_id' => $created->id,
                    'provider_id'    => $created->d_card_provider_id,
                    'store_id'       => $created->store_id,
                    'name'           => $created->name,
                ]
            );
        }catch (\Exception $ex){
            $created->delete();
            \Alert::error('we can\'t create DG :'.$ex->getMessage())->flash();
            return redirect()->back()->withInput();
        }

    }
}
