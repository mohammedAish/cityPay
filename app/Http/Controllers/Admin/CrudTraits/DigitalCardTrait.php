<?php


namespace App\Http\Controllers\Admin\CrudTraits;


use App\Models\DigitalCardProviderPackage;

trait DigitalCardTrait
{
    static function checkIsFoundProviderPackagePrice($provider_id,$store_id,$price){
        $found = DigitalCardProviderPackage::
        where('d_card_provider_id',$provider_id)
            ->where('store_id',$store_id)
            ->where('price',$price)->first();

        return $found ?? false;
    }
}
