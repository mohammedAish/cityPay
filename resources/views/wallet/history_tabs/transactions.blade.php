<div class="" style="margin-top: 20px;">
    <div class="row table-responsive">

        <table id="example" class="table  table-borderless" style="width:100%">
            <thead>
            <tr>
                <th>{{trans('lang.transaction')}}</th>
                <th>{{trans('lang.transaction-id')}}</th>
                <th>{{trans('lang.amount')}}</th>
                <th>{{trans('lang.transaction-type')}}</th>
                <th>{{trans('lang.transaction-date')}}</th>
                <th>{{trans('lang.status')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>

                        <div class="wallet-transaction-name">

                            <h3>
                                {{trans('lang.'.$item->op_type)}}</h3>
                            <span>

                          {{ empty($item->agency) ? "":$item->agency->name}}

                                {{ !empty($item->agencyCountry->country) ?  $item->agencyCountry->country->name :''}}
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

                            <h3>    {{$item->amount}}
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
                        {{--                        {{$item->current_status}}--}}
                        <div class="circle_icon"><i class="fas fa-check"></i>

                        </div>
                    </td>


                </tr>
            @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header   col-md-12">
                        <div class=" col-md-10 row ">
                            <div class="col-md-2 text-right">
                                <div class="circle_icon "><i class="fas fa-check"></i></div>
                            </div>
                            <div class="col-md-8 " style="margin-top: 5px">
                                <h3>{{trans('lang.transaction-detail')}}</h3>
                            </div>
                        </div>


                        <div class=" text-left">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-center " style="border: 0">

                                    <h3><i class="fas fa-arrow-down"></i>
                                        ايداع</h3>
                                </th>
                                <td class="text-center " style="border: 0">
                                    <h3>{{trans('lang.transaction-id')}} : 526456</h3>
                                </td>

                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.transaction-type')}}</h3></th>
                                <td class="text-center">كاش</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.amount')}}</h3></th>
                                <td class="text-center">500$</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.our-fees')}} </h3></th>
                                <td class="text-center">0%</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3> {{trans('lang.deposit-date')}} </h3></th>
                                <td class="text-center">5-2-2021</td>
                            </tr>
                        </table>
                    </div>
                    {{--                                        <div class="modal-footer">--}}
                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
