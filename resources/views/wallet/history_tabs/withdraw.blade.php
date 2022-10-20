<div class="" style="margin-top: 20px;">
    <div class="row table-responsive">
        <table id="example3" class="table table-borderless" style="width:100%">
            <thead>
            <tr>

                <th>{{trans('lang.agency')}}</th>
                <th>{{trans('lang.transaction-id')}}</th>
                <th>{{trans('lang.amount')}}</th>
                <th>{{trans('lang.transaction-type')}}</th>
                <th>{{trans('lang.order-date')}}</th>
                <th>{{trans('lang.status')}}</th>


            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>

                        <div class="wallet-transaction-name">


                            <span>
                               {{ empty($item->agencyCountry->depositAgency) ? "":$item->agencyCountry->depositAgency->name}}
                                {{! empty($item->agencyCountry->country) ? " ". $item->agencyCountry->country->name :''}}

                        </span>
                        </div>
                    </td>

                    <td>
                        <div class="wallet-transaction-balance">
                            <a href="#" class="operation_detail" data-id="{{$item->id}}"
                               style="text-decoration: underline"><h3>{{$item->id}}</h3></a>
                        </div>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">

                            <h3>

                                {{$item->amount}}
                                {{ empty($item->currency) ? "":$item->currency->name}}

                            </h3>
                        </div>
                    </td>

                    <td>
                        <h3>{{$item->deposit_type}}</h3>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">
                            <span>{{$item->deposit_date}} </span>
                        </div>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">
                         <a href="#">
                             <i class="fas fa-circle p-5-wizard " style="color:  #ffcb2e;"></i>
                             {{$item->current_status_ar}}
                         </a>
                     </span>

                        </div>
                    </td>


                </tr>
            @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>

    </div>
</div>

