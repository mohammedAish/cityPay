<table class="table table-borderless">
    <tr>
        <td class="text-center " style="border: 0">
            <h3><i class="fas fa-arrow-left"></i>
                @if($type=="invoices")
                    {{trans("lang.pay_purchase_bills")}}
                @elseif($type=="freelancing")
                    {{trans("lang.Withdraw-money-from-freelancing-platforms")}}
                @elseif($type=="transfer")
                    {{trans("lang.transfer-money")}}
                @elseif($type=="withdraw")
                    {{trans("lang.withdraw")}}
                @elseif($type=="deposit")
                    {{trans("lang.deposit")}}
                @else
                    {{trans("lang.transactions")}}
                @endif
            </h3>
        </td>
        <td class="text-center " style="border: 0">
            <h3>{{trans('lang.transaction-id')}} :{{$data->id}} </h3>
        </td>

    </tr>
    @if($type=="transfer")
        <tr>
            <th class="text-center">
                <h3>{{trans('lang.receiving-country')}}</h3></th>
            <td class="text-center">
            {{ empty($data->agencyCountry->country) ?  "": $data->agencyCountry->country->name }}
        </tr>
        <tr>
            <th class="text-center">
                <h3>{{trans('lang.receiving-method')}}</h3></th>
            <td class="text-center"> {{$data->receiving_mode}}</td>
        </tr>
    @endif
    @if($type=="invoices")
        <tr>
            <th class="text-center">
                <h3>{{trans('lang.real_price')}}</h3></th>
            <td class="text-center">
            {{ ($data->real_price)  }}
        </tr>
        <tr>
            <th class="text-center">
                <h3>{{trans('lang.commission_fee')}}</h3></th>
            <td class="text-center"> {{$data->commission_fee}}</td>
        </tr>
        <tr>
            <th class="text-center">
                <h3>{{trans('lang.final_price')}}</h3></th>
            <td class="text-center"> {{$data->final_price}}</td>
        </tr>
    @endif
    <tr>
        <th class="text-center"><h3> {{trans('lang.agency')}}</h3></th>
        <td class="text-center">
            @if($type=="transfer")
                {{ empty($data->agencyCountry->transferAgency) ? "":$data->agencyCountry->transferAgency->agency_name}}
            @else
                {{ empty($data->agency) ? "":$data->agency->name}}
            @endif
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3> {{trans('lang.status')}}</h3></th>
        <td class="text-center"> {{$data->current_status_ar}}</td>
    </tr>
    @if( $type!="invoices")
    <tr>
        <th class="text-center"><h3>{{trans('lang.amount')}}</h3></th>
        <td class="text-center">
            {{$data->amount}}
            {{ empty($data->currency) ? "":$data->currency->name}}
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3>{{trans('lang.our-fees')}} </h3></th>
        <td class="text-center">{{$data->fee_amount}}{{$data->currency->name}}</td>
    </tr>
    @endif
    @if($type=="deposit")
        <tr>
            <th class="text-center"><h3>{{trans('lang.amount_must_deposit')}}</h3></th>
            <td class="text-center">
                {{$data->client_amount}}
                {{ empty($data->currencyClient)? "":$data->currencyClient->name}}
            </td>
        </tr>
    @endif
    @if($type=="transfer" or $type=="invoices")
        <tr>
            <th class="text-center"><h3>{{trans('lang.transferred_date')}} </h3></th>
            <td class="text-center">
                <span>{{$data->created_at->format('Y-m-d')}}  </span>
            </td>
        </tr>

    @endif
    <tr>
        @if($type=="withdraw")
            <th class="text-center"><h3>{{trans('lang.withdraw-date')}} </h3></th>
            <td class="text-center"><span>{{$data->deposit_date->format('Y-m-d')}} </span></td>
        @endif

        @if($type=="deposit")
            <th class="text-center"><h3>{{trans('lang.order-date')}} </h3></th>
            <td class="text-center"><span>{{$data->created_at->format('Y-m-d')}} </span></td>
        @endif
    </tr>
</table>


@if ($data_type=='confirm')

    <div class="transfer-coin-button" style="width: 100%">
        <button id="confirm_opration" class="theme-btn" data-id="{{$data->id}}"  data-final_price="{{$data->final_price}}"
                type="button">{{trans('lang.confirm')}}</button>

    </div>
@endif
