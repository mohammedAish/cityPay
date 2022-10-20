<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\OrderTrait;
use App\Http\Requests\DigitalCardOrderRequest;
use App\Http\Resources\CustomerDCOrderResource;
use App\Http\Resources\DCCategoryResource;
use App\Http\Resources\DCProviderPackageResource;
use App\Http\Resources\DCProviderResource;
use App\Http\Resources\DCStoreResource;
use App\Models\CustomerDCOrder;
use App\Models\DCardsPurchasesDetail;
use App\Models\DigitalCardCategory;
use App\Models\DigitalCardProviderPackage;
use App\Models\DigitalCardsProvider;
use App\Models\DigitalCardStore;
use Illuminate\Http\Request;

class DigitalCardApiController extends BaseApiController
{
    use OrderTrait;

    /**
     *  /list_card_categories
     * [ارجاع قائمة بالمجموعات لللكروت الرقمية  .]
     * @group DigitalCards
     * @return \Illuminate\Http\JsonResponse
     */
    public function listCardCategories(){
        $cats = DigitalCardCategory::whereActive(1)->get();
        if (!$cats->count()) {
            return $this->fail_response(config('err_codes.data_not_found'),tt('no categories found'));
        }
        $cats = DCCategoryResource::collection($cats);

        return $this->success_response($cats,trans('you_get_digital_cards_categories'));
    }

    /**
     *  /list_providers_category/{cat_id}
     * [ارجاع قائمة المزودين(المنتجين للكروت) برقم المجموعة  .]
     * @group DigitalCards
     * @bodyParam cat_id  number    required  رقم المجموعة المراد اظهار مزوديها -
     * @return \Illuminate\Http\JsonResponse
     */
    public function listProvidersByCategoryID($cat_id){
        $providers = DigitalCardsProvider::whereCategoryId($cat_id)->whereActive(1)->get();
        if (!$providers->count()) {
            return $this->fail_response(config('err_codes.data_not_found'),tt('no providers found'));
        }
        $providers = DCProviderResource::collection($providers);

        return $this->success_response($providers,trans('you_get_digital_cards_providers'));
    }
    /**
     *  /list_stores_provider/{provider_id}
     * [ارجاع قائمة المتاجر لمزود معين برقم المزود فان لم ترجع المتاجر سترجع مباشرة الفئات المتوفرة  لهذا المزود .]
     * @group DigitalCards
     * @bodyParam provider_id  number    required  رقم المزود المراد اظهار متاجره او فئات البيع له -
     * @return \Illuminate\Http\JsonResponse
     */
    public function listStoresByProviderID($provider_id){
        $hasStores = DigitalCardsProvider::whereHas('stores',function ($query){
            return $query->where('shown',1);
        })->whereId($provider_id)->get();
        if ($hasStores->count() > 0) {
            $packagesStore = DigitalCardProviderPackage::whereDCardProviderId($provider_id)
                ->select('store_id')->distinct()->get()->pluck('store_id');
            $stores        = DigitalCardStore::whereShown(1)
                ->whereIn('id',$packagesStore)->get();
            $arrayResponse = [
                'has_stores' => true,
                'stores'     => DCStoreResource::collection($stores),
                'packages'   => null,
            ];

            return $this->success_response($arrayResponse,trans('you_get_digital_cards_stores_by_provider'));
        } else {
            //get the packages for first store it is the default store
            $provider_packages = DigitalCardProviderPackage::with('digitalCard:id')
                ->whereDCardProviderId($provider_id)->where('store_id',1)->get();
            $provider_packages = DCProviderPackageResource::collection($provider_packages);
            $arrayResponse     = [
                'has_stores' => false,
                'stores'     => null,
                'packages'   => $provider_packages->count() > 0? $provider_packages :null,
            ];

            return $this->success_response($arrayResponse,trans('you_get_digital_cards_packages_by_provider'));
        }
    }
    /**
     *  /list_packages/{provider_id}/{store_id?}
     * [ارجاع قائمة الفئات المتوفرة  لهذا المزود في متجر معين او في المتجر الافتراضي .]
     * @group DigitalCards
     * @bodyParam provider_id  number    required  رقم المزود المراد اظهار متاجره او فئات البيع له -
     * @bodyParam store_id  number    optional  رقم المتجر  وهو حقل اختياري -
     * @return \Illuminate\Http\JsonResponse
     */
    public function listDCPackagesByProviderIdStoreId($provider_id,$store_id = null){
        if (!$store_id || $store_id == null || $store_id == 0 || $store_id == '') {
            $provider_packages     =
                DigitalCardProviderPackage:: join('digital_cards',
                    'd_c_provider_packages.id','=','digital_cards.d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('d_c_provider_packages.store_id',1)
                    ->select(['d_c_provider_packages.*','digital_cards.id as digital_card_id'])->get();
            $provider_packages_res = DCProviderPackageResource::collection($provider_packages);
        } else {
            $provider_packages     =
                DigitalCardProviderPackage::join('digital_cards',
                    'd_c_provider_packages.id','=','digital_cards.d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('d_c_provider_packages.store_id',$store_id)
                    ->select(['d_c_provider_packages.*','digital_cards.id as digital_card_id'])->get();
            $provider_packages_res = DCProviderPackageResource::collection($provider_packages);
        }
        if ($provider_packages->count() <= 0) {
            return $this->fail_response(config('err_codes.data_not_found'),tt('no packages found'));
        }

        return $this->success_response($provider_packages_res,
            trans('you_get_digital_cards_packages_by_provider_store'));
    }
    /**
     *  /check_d_card_id/{digital_card_id}
     * [لفحص مخزون الكروت عن هذا الكرت هل متوفر ام لا  .]
     * @group DigitalCards
     * @bodyParam digital_card_id  number    required  رقم الكرت المراد فحصه -
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIsFoundInStock($digital_card_id){
        $found = DCardsPurchasesDetail::whereDigitalCardId($digital_card_id)
            ->where('card_status','free')->count();
        if ($found) {
            $res_data = ['status' => true,'found' => $found];

            return $this->success_response($res_data,trans('yes_it_is_in_stock'));
        } else {
            return $this->fail_response(config('err_codes.data_not_found'),tt('no stock for this digital_card'));
        }
    }
    /**
     *  /store_digital_card_order
     * [اكمااااااال عملية شراء كرت رقمي معين  .]
     * @group DigitalCards
     * @bodyParam digital_card_id  number    required  رقم الكرت المراد شراءه -
     * @bodyParam package_id  number    required  رقم البكج التابع له -
     * @bodyParam qty  number    required  عدد الكروت المراد شرائها-
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkoutDigitalCardOrder(DigitalCardOrderRequest $request){
        $isValid = $this->checkIsCardOrderValid($request->all());
        if (!$isValid) {
            return $this->fail_response(config('err_codes.invalid_posted_data'),tt('your posted data is invalid'));
        }
        $digital_card_id = $request->digital_card_id;
        $qty             = $request->qty;
        $foundedCards    = DCardsPurchasesDetail::whereDigitalCardId($digital_card_id)
            ->where('card_status','free')
            ->limit($qty)                 // to get only by thy order qty
            ->orderBy('created_at','asc') //to sell the old cards
            ->get();
        if (!$foundedCards || $foundedCards->count() <= 0 || $foundedCards->count() < $qty) {
            return $this->fail_response(config('err_codes.un_available_in_stock'),
                tt('no stock for this digital_card available'));
        }
        $totalPrice = 0;
        foreach ($foundedCards as $oneCard) {
            $totalPrice += $oneCard->sell_price;
        }
        $totalPrice = $qty * $totalPrice;
        if (auth()->user()->balanceFloat < $totalPrice) {
            return $this->fail_response(config('err_codes.no_enough_balance'),
                tt('no_enough_balance').'your_balance_is:'.auth()->user()->balanceFloat);
        }
        $purchaseItemsId = $foundedCards->pluck('id');


        //complete order
        try {
            $orderCreated = $this->completeDCOrder(auth()->id(),$totalPrice,$purchaseItemsId);
        } catch (\Exception $e) {
            return $this->fail_response(config('err_codes.cant_create_dc_order'),
                tt('we_cant_offer_your_order').$e->getMessage());
        }


        //retrieve the updated
        $codes                     = $foundedCards->pluck('card_code')->toArray();
        $orderCreated->cards_codes = \GuzzleHttp\json_encode($codes);
        $orderCreated->save();
        $orderCreated->load('digitalCardsBought');

        return $this->success_response($orderCreated,tt('you get the Cards'));
    }
    public function listDigitalCardOrders(){
        $list_orders = CustomerDCOrder::whereHas('digitalCardsBought')
            ->with('digitalCardsBought')
            ->where('customer_id',auth()->id())->get();
        $list_orders=CustomerDCOrderResource::collection($list_orders);
        return $this->success_response($list_orders,tt('you get the orders'));
    }
}
