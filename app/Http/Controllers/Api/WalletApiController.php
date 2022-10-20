<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\CustomerFinanceAccountRequest;

use App\Http\Resources\FinanceAccountResource;
use Illuminate\Http\JsonResponse;

class WalletApiController extends BaseApiController
{
    use WalletTrait;

    public function listFinanceAccounts(): JsonResponse {
        $listAccounts = $this->getCustomerFinanceAccounts(auth()->id());
        $listAccounts = FinanceAccountResource::collection($listAccounts);
        return $this->success_response($listAccounts, trans('you_get_finance_accounts'));
    }

    public function showAddingFinanceAccount(): JsonResponse {
        $instructions    = self::getServiceInstructions(2);
        $agenciesCountry =
            $this->getAgenciesForFinanceAccountByCountry(auth()->user()->country_code);


        $depositTypes                       = self::getDepositTypes();

        $this->base_data['instruction']     = $instructions;
        $this->base_data['depositTypes']    = $depositTypes;
        $this->base_data['agenciesCountry'] = $agenciesCountry; //deprecated

        return $this->success_response($this->base_data, trans('you_get_deposit_types'));
    }

    public function getWithdrawAgencyByMethod($method_id): JsonResponse {
        $country_id       = self::getUserCountryId();//YEMEN 247
        $deposit_agencies = self::getDepositAgencyByMethod($method_id, $country_id, 1);
        if ((!$deposit_agencies->count()) > 0) {
            return $this->fail_response(config('err_codes.data_not_found'), 'we cant find any agency');
        }

        return $this->success_response($deposit_agencies, trans('you_get_agencies'));
    }

    public function storeFinanceAccount(CustomerFinanceAccountRequest $request): JsonResponse {
        $createdFinance = $this->creatCustomerFinanceAccount(auth()->id(), $request->all());

        return $this->success_response($createdFinance, "تم التعديل بنجاح");
    }
}
