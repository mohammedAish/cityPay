<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Http\Requests\DigitalCardOrderRequest;
use App\Http\Resources\DCCategoryResource;
use App\Http\Resources\DCProviderPackageResource;
use App\Http\Resources\DCStoreResource;
use App\Models\CustomerDCOrder;
use App\Models\DCardsPurchasesDetail;
use App\Models\DigitalCardCategory;
use App\Models\DigitalCardProviderPackage;
use App\Models\DigitalCardsProvider;
use App\Models\DigitalCardStore;


class DigitalCardController extends BaseWebController
{
    public function listCardCategories() {

        $cats = DigitalCardCategory::whereActive(1)->get();
        $cats = DCCategoryResource::collection($cats);

        // return \request()->wantsJson()? response()->json([$cats]) :$cats;
        $order_instruction = $this->getServiceInstructions(1);

        //todo if you want to return it to view
        return view('digital_cards.digital_cart')
            ->with('instructions', $order_instruction)
            ->with('card_categories', $cats);
    }

    public function listProvidersByCategoryID($cat_id) {
        $providers = DigitalCardsProvider::whereCategoryId($cat_id)->whereActive(1)->get();

        return view('digital_cards.provider_select', [
            "agencies" => $providers,
            "name"     => "provider_id",
            "label"    => trans("lang.digital_cards_providers"),
        ])->render();
    }

    public function listStoresByProviderID($provider_id)  //todo Osama changes here
    {
//        $hasStores = DigitalCardsProvider::whereHas('stores', function ($query) {
//            return $query->where('shown', 1);
//        })->whereId($provider_id)->get();

        $hasStores = DigitalCardStore::whereHas('providers', function ($query) use ($provider_id) {
            return $query->where("d_card_provider_id", $provider_id);
        })->get();
        if ($hasStores->count() > 0) {
            $packagesStore = DigitalCardProviderPackage::whereDCardProviderId($provider_id)
                ->select('store_id')->distinct()->get()->pluck('store_id');
            $stores        = DigitalCardStore::whereShown(1)
                ->whereIn('id', $packagesStore)->get();
            $arrayResponse = [
                'has_stores' => true,

                'stores'   => DCStoreResource::collection($hasStores),
                'packages' => null,

            ];

            return \request()->wantsJson() ? response()->json([$arrayResponse]) : $arrayResponse;
        } else {
            //get the packages for first store it is the default store
            $provider_packages = DigitalCardProviderPackage::with('digitalCard:id')
                ->whereDCardProviderId($provider_id)->where('store_id', 1)->get();
            $provider_packages = DCProviderPackageResource::collection($provider_packages);
            $arrayResponse     = [
                'has_stores' => false,
                'stores'     => null,
                'packages'   => $provider_packages,
            ];

            return \request()->wantsJson() ? response()->json([$arrayResponse]) : $arrayResponse;
        }
    }

    public function listStoresByProviderIDOld($provider_id) {
        $hasStores = DigitalCardsProvider::whereHas('stores', function ($query) {
            return $query->where('shown', 1);
        })->whereId($provider_id)->get();
        if ($hasStores->count() > 0) {
            $packagesStore = DigitalCardProviderPackage::whereDCardProviderId($provider_id)
                ->select('store_id')->distinct()->get()->pluck('store_id');
            $stores        = DigitalCardStore::whereShown(1)
                ->whereIn('id', $packagesStore)->get();
            $arrayResponse = [
                'has_stores' => true,
                'stores'     => DCStoreResource::collection($stores),
                'packages'   => null,
            ];

            return \request()->wantsJson() ? response()->json([$arrayResponse]) : $arrayResponse;
        } else {
            //get the packages for first store it is the default store
            $provider_packages = DigitalCardProviderPackage::with('digitalCard:id')
                ->whereDCardProviderId($provider_id)->where('store_id', 1)->get();
            $provider_packages = DCProviderPackageResource::collection($provider_packages);
            $arrayResponse     = [
                'has_stores' => false,
                'stores'     => null,
                'packages'   => $provider_packages,
            ];

            return \request()->wantsJson() ? response()->json([$arrayResponse]) : $arrayResponse;
        }
    }

    public function listDCPackagesByProviderIdStoreId($provider_id, $store_id = null) //todo Osama changes 2 here
    {
        if (!$store_id || $store_id == null || $store_id == 0 || $store_id == '') {
            $provider_packages =

                DigitalCardProviderPackage::with('digitalCard:id,d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('store_id', 1)->get();
//            $provider_packages = DCProviderPackageResource::collection($provider_packages);
        } else {
            $provider_packages =
                DigitalCardProviderPackage::with('digitalCard:id,d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('store_id', $store_id)->get();
//            $provider_packages = DCProviderPackageResource::collection($provider_packages);

        }

        return \request()->wantsJson() ? response()->json([$provider_packages]) : $provider_packages;
    }

    public function listDCPackagesByProviderIdStoreIdOld($provider_id, $store_id = null) {
        if (!$store_id || $store_id == null || $store_id == 0 || $store_id == '') {
            $provider_packages =
                DigitalCardProviderPackage:: join('digital_cards',
                    'd_c_provider_packages.id', '=', 'digital_cards.d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('d_c_provider_packages.store_id', 1)
                    ->select('d_c_provider_packages.*', 'digital_cards.id as digital_card_id')->get();
            $provider_packages = DCProviderPackageResource::collection($provider_packages);
        } else {
            $provider_packages =
                DigitalCardProviderPackage::join('digital_cards',
                    'd_c_provider_packages.id', '=', 'digital_cards.d_c_package_id')
                    ->whereDCardProviderId($provider_id)->where('d_c_provider_packages.store_id', $store_id)
                    ->select('d_c_provider_packages.*', 'digital_cards.id as digital_card_id')->get();
            $provider_packages = DCProviderPackageResource::collection($provider_packages);
        }

        return \request()->wantsJson() ? response()->json([$provider_packages]) : $provider_packages;
    }

    public function checkIsFoundInStock($digital_card_id) {
        $found = DCardsPurchasesDetail::whereDigitalCardId($digital_card_id)
            ->where('card_status', 'free')->count();
        if ($found) {
            $res_data = ['status' => true, 'found' => $found];

            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        } else {
            $res_data = ['status' => false, 'found' => 0];

            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        }

    }

    public function testOrder() {
        return view('test_folder.test_digital_card');
    }

    public function checkoutDigitalCardOrder(DigitalCardOrderRequest $request) {
        $isValid = $this->checkIsCardOrderValid($request->all());
        if (!$isValid) {
            $res_data = ['status' => false, 'msg' => 'posted_data not valid'];

            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        }
        $digital_card_id = $request->digital_card_id;
        $qty             = $request->qty;
        $foundedCards    = DCardsPurchasesDetail::whereDigitalCardId($digital_card_id)
            ->where('card_status', 'free')
            ->limit($qty)// to get only by thy order qty
            ->orderBy('created_at', 'asc')//to sell the old cards
            ->get();
        if (!$foundedCards || $foundedCards->count() <= 0 || $foundedCards->count() < $qty) {
            $res_data = ['status' => false, 'msg' => trans('lang.not_available_this_qty_from_this_card')];

            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        }
        $totalPrice = 0;
        foreach ($foundedCards as $oneCard) {
            $totalPrice += $oneCard->sell_price;
        }
        //$totalPrice = $qty * $totalPrice;
        if (auth()->user()->balanceFloat < $totalPrice) {
            $res_data = ['status' => false, 'msg' => trans('lang.no_enough_balance')];
            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        }
        $purchaseItemsId = $foundedCards->pluck('id');
      //complete order
        try {
            $orderCreated = $this->completeDCOrder(auth()->id(), $totalPrice, $purchaseItemsId);
        } catch (\Exception $e) {
            $res_data = ['status' => false, 'msg' => trans('lang.we_cant_offer_your_order').$e->getMessage()];

            return \request()->wantsJson() ? response()->json($res_data) : $res_data;
        }


        //retrieve the updated
        $codes = $foundedCards->pluck('card_code')->toArray();

        $orderCreated->cards_codes = \GuzzleHttp\json_encode($codes);
        $orderCreated->save();
        $orderCreated->load('digitalCardsBought');
        $res_data = ['status' => true, 'data' => $orderCreated,
                     'message' => trans('lang.you_success_completed_order_and_get_the_cards')];

        return \request()->wantsJson() ? response()->json($res_data) : $res_data;
    }

    public function showDetail($id) {

        $data = CustomerDCOrder::whereHas('digitalCardsBought')
            ->with(['digitalCardsBought' => function ($q) {
                $q->with(["digitalCard" => function ($sub_q) {
                    $sub_q->with(['provider', 'store', 'providerPackage', 'providerPackageDistinct']);
                }]);
            }])->where('id', $id)->get()->first();


        return view('digital_cards.model_info')->with('data', $data)->render();
    }

    public function listDigitalCardOrders() {
        $list_orders =
            CustomerDCOrder::whereHas('digitalCardsBought')
                ->with('digitalCardsBought')
                ->where('customer_id', auth()->id())
                ->paginate(20);

        return view('wallet.history')
            ->with('type','digital_cards')
            ->with('data', $list_orders);
//        return \request()->wantsJson()? response()->json($list_orders) :$list_orders;

    }
}
