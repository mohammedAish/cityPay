<?php


namespace App\Http\Controllers\Traits;


use App\Events\WalletTransactionEvent;
use App\Models\Customer;
use App\Models\CustomerDCOrder;
use App\Models\CustomersLoyaltyPointsPrice;
use App\Models\DCardsPurchasesDetail;
use App\Models\DigitalCard;
use App\Models\ServicesPackage;
use http\Exception;

trait OrderTrait
{

    static function createLoyaltyPointsForService(
        $serviceId,
        $modelTypeName,
        $model_id,
        $customerId,
        $score_type = 'confirmed'
    ){
        $loyalty_points = self::getLoyaltyPointsFromService($serviceId);
        $pointsCreated  = null;
        if ($loyalty_points > 0) {
            $pointsCreated = self::createLoyaltyPoints($modelTypeName,$model_id,
                $customerId,
                $loyalty_points,
                $score_type);
        }

        return $pointsCreated? $pointsCreated->count_scores :0;
    }

    static public function getLoyaltyPointsFromService($serviceId){
        $loyalty_points = ServicesPackage::
        where('service_id',$serviceId)->first();
        if ($loyalty_points) {
            return $loyalty_points->operation_scores;
        }

        return 0;
    }

    static public function createLoyaltyPoints(
        $modelTypeName,
        $model_id,
        $customerId,
        $countLoyaltyPoints,
        $score_type = 'confirmed'
    ){
        return CustomersLoyaltyPointsPrice::create(
            [
                'customer_id'      => $customerId,
                'count_scores'     => $countLoyaltyPoints,
                'score_type'       => $score_type,
                'loyaltyable_type' => '\\App\\Models\\'.$modelTypeName,
                'loyaltyable_id'   => $model_id,
            ]
        );
    }

    static function checkIsCardOrderValid($posted_data){
        if(empty($posted_data['package_id'])||
            empty($posted_data['digital_card_id'])||empty($posted_data['qty'])){
            return false;
        }
        $found=DigitalCard::whereDCPackageId($posted_data['package_id'])
            ->whereId($posted_data['digital_card_id'])->first();
        if(!$found){
            return false;
        }
        return true;
    }

    static function completeDCOrder($customer_id,$total_price,$itemsIds){
        try {
            \DB::beginTransaction();
            $orderCreated = CustomerDCOrder::create([
                'customer_id'    => $customer_id,
                'current_status' => 'order_completed',
                'total_amount'   => $total_price,
                'customer_hint'  => null,
            ]);
            $updated      = DCardsPurchasesDetail::whereIn('id',$itemsIds)
                ->update([
                    'customer_d_c_order_id' => $orderCreated->id,
                    'card_status'           => 'used',
                    'assigned_type'         => 'auto',
                    'assign_date'           => now(),
                ]);


            //create LoyaltyPoints
            $loyaltyPoints = self::createLoyaltyPointsForService(
                config('ytadawul.all_services.digital_cards'),
                'CustomerDCOrder',$orderCreated->id,auth()->id());
            $TRX           = Customer::find($customer_id)->withdrawFloat($total_price);
            event(new WalletTransactionEvent($TRX,'d_card_parches_order',$orderCreated->id));
            \DB::commit();

            return $orderCreated;
        } catch (\Exception $ex) {
            $updated      = DCardsPurchasesDetail::whereIn('id',$itemsIds)
                ->update([
                    'customer_d_c_order_id' =>null,
                    'card_status'           => 'free',
                    'assigned_type'         => null,
                    'assign_date'           => null,
                ]);
            \DB::rollBack();
            throw new \Exception($ex->getMessage());
        }
    }
}
