<table class="table table-borderless">
    <tr>
        <th class="text-center"><h3>{{trans('lang.transaction-id')}} :</h3></th>

        <td class="text-center " style="border: 0">
            <h3>{{$data->id}} </h3>
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3>{{trans('lang.qty_cards')}}</h3></th>
        <td class="text-center">
            {{count($data->digitalCardsBought)}}
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3>{{trans('lang.amount')}}</h3></th>
        <td class="text-center">
            {{$data->total_amount}}
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3>{{trans('lang.order-date')}} </h3></th>
        <td class="text-center">
            <span>{{$data->created_at->format('Y-m-d')}}  </span>
        </td>
    </tr>

    <tr>
        <th class="text-center"><h3>{{__('lang.package_name')}} </h3></th>
        <td class="text-center">
            <span> {{($data->digitalCardsBought[0]->digitalCard->providerPackage->name)}}</span>
        </td>
    </tr>

    <tr>
        <th class="text-center"><h3>{{__('lang.provider_name')}} </h3></th>
        <td class="text-center">
            <span> {{($data->digitalCardsBought[0]->digitalCard->provider->name)}}</span>
        </td>
    </tr>
    <tr>
        <th class="text-center"><h3>{{__('lang.store_name')}} </h3></th>
        <td class="text-center">
            <span>  {{empty($data->digitalCardsBought[0]->digitalCard->store)?"":$data->digitalCardsBought[0]->digitalCard->store->name}}</span>
        </td>
    </tr>
</table>
<div class=" col-md-10 row ">
    <div class="col-md-2 text-right">
        <div class="circle_icon "><i class="fa fa-credit-card"></i></div>
    </div>
    <div class="col-md-8 " style="margin-top: 5px">
        <h3> الكروت </h3>
    </div>
</div>
<table class="table table-borderless">
    <thead>
    <tr>
        <td class="text-center">{{__('lang.card_code')}}</td>
        <td class="text-center">{{__('lang.price')}}</td>
    </tr>
    </thead>
    <tbody>
    @foreach($data->digitalCardsBought as $card)
        <tr>
            <td class="text-center">
                {{($card->card_code)}}
            </td>
            <td class="text-center">
                {{($card->sell_price)}}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>