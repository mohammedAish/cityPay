<div class="" style="margin-top: 20px;">
    <div class="row table-responsive">
        <table id="example5" class="table table-borderless" style="width:100%">
            <thead>
            <tr>
                <th>{{trans('lang.transaction-id')}}</th>
                <th>{{trans('lang.real_price')}}</th>
                <th>{{trans('lang.commission_fee')}}</th>
                <th>{{trans('lang.final_price')}}</th>
                <th>{{trans('lang.order-date')}}</th>
                <th>{{trans('lang.status')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>


                    <td>
                        <div class="wallet-transaction-balance">
                            <a href="#" class="operation_detail" data-id="{{$item->id}}"
                               style="text-decoration: underline"><h3>{{$item->id}}</h3></a>
                        </div>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">
                            {{$item->product_price}}
                            {{ empty($item->currency) ? "":$item->currency->name}}

                        </div>
                    </td>

                    <td>
                        <div class="wallet-transaction-balance">
                            {{$item->commission_fee}}
                            {{ empty($item->currency) ? "":$item->currency->name}}

                        </div>
                    </td>

                    <td>
                        <div class="wallet-transaction-balance">
                            {{$item->final_price}}
                            {{ empty($item->currency) ? "":$item->currency->name}}

                        </div>
                    </td>

                    <td>
                        <div class="wallet-transaction-balance">
                            <span>{{$item->created_at}} </span>
                        </div>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">


                        </div>



                        @if($item->current_status=="pending")
                            <span>
                                    <a href="#"
                                       class="operation_detail" data-type="confirm" data-id="{{$item->id}}"> <i
                                            class="fas fa-circle p-5-wizard  "

                                            style="color:  red;"></i> تاكيد العملية</a></span>
                        @else
                            <span>
                                <a href="#">
                                    <i class="fas fa-circle p-5-wizard " style="color:  #ffcb2e;"></i>
                                    {{$item->current_status}}
                                </a>
                            </span>

                        @endif

                    </td>


                </tr>
            @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="detail5" tabindex="-1" role="dialog" aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header   col-md-12">
                        <div class=" col-md-10 row ">
                            <div class="col-md-2 text-right">
                                <div class="circle_icon "><i class="fas fa-check"></i></div>
                            </div>
                            <div class="col-md-8 " style="margin-top: 5px">
                                <h3> {{trans('lang.transaction-detail')}}</h3>
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

                                    <h3><i class="fas fa-file-invoice"></i>
                                        سداد فاتورة مشتريات</h3>
                                </th>
                                <td class="text-center " style="border: 0">
                                    <h3>{{trans('lang.transaction-id')}} : 15824</h3>
                                </td>

                            </tr>

                            <tr>
                                <th class="text-center"><h3> {{trans('lang.status')}}</h3></th>
                                <td class="text-center">تمت بنجاح</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.amount')}}</h3></th>
                                <td class="text-center">500$</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.our-fees')}} </h3>
                                </th>
                                <td class="text-center">10 $</td>
                            </tr>

                            <tr>
                                <th class="text-center"><h3>{{trans('lang.order-date')}} </h3>
                                </th>
                                <td class="text-center">5-2-2021</td>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <h3>{{trans('lang.purchasing-date')}} </h3></th>
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
