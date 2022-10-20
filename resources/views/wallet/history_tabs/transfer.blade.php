<div class="" style="margin-top: 20px;">
    <div class="row table-responsive">
        <table id="example3" class="table table-borderless" style="width:100%">
            <thead>
            <tr>

                <th>{{trans('lang.agency')}}</th>
                <th>{{trans('lang.transaction-id')}}</th>
                <th>{{trans('lang.amount')}}</th>
                <th>{{trans('lang.receiving-method')}}</th>
                <th>{{trans('lang.receiver-information')}}</th>
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
                          {{ empty($item->agencyCountry->transferAgency) ? "":$item->agencyCountry->transferAgency->agency_name}}

                                {{ empty($item->agencyCountry->country) ?  "": $item->agencyCountry->country->name }}
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
                        <h3>{{$item->receiving_mode}}</h3>

                    </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#receiver"><h3>
                                {{$item->receiver_name}}
                            </h3></a>

                    </td>
                    <td>
                        <div class="wallet-transaction-balance">
                            <span>{{$item->created_at}} </span></div>
                    </td>
                    <td>
                        <div class="wallet-transaction-balance">

                                                <span> <a href="#"> <i class="fas fa-circle p-5-wizard "
                                                                       style="color:  #ffcb2e;"></i>{{$item->current_status}}  </a></span>
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
        <div class="modal fade" id="detail4" tabindex="-1" role="dialog" aria-labelledby="modal"
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

                                    <h3><i class="fas fa-sync-alt"></i>
                                        تحويل</h3>
                                </th>
                                <td class="text-center " style="border: 0">
                                    <h3>{{trans('lang.transaction-id')}} : 15824</h3>
                                </td>

                            </tr>
                            <tr>
                                <th class="text-center">
                                    <h3>{{trans('lang.receiving-country')}}</h3></th>
                                <td class="text-center">مصر</td>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <h3>{{trans('lang.receiving-method')}}</h3></th>
                                <td class="text-center">نقد - كريمي</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.status')}}</h3></th>
                                <td class="text-center">قيد الانتظار</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.amount')}}</h3></th>
                                <td class="text-center">500$</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.our-fees')}} </h3>
                                </th>
                                <td class="text-center">2%</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>  {{trans('lang.amount')}} </h3>
                                </th>
                                <td class="text-center">459$</td>
                            </tr>

                            <tr>
                                <th class="text-center"><h3>{{trans('lang.order-date')}} </h3>
                                </th>
                                <td class="text-center">5-2-2021</td>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    <h3>{{trans('lang.receiving-date')}} </h3></th>
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

        <!-- receiver Modal -->
        <div class="modal fade" id="receiver" tabindex="-1" role="dialog"
             aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header   col-md-12">
                        <div class=" col-md-10 row ">
                            <div class="col-md-2 text-right">
                                <div class="circle_icon "><i class="fas fa-user"></i></div>
                            </div>
                            <div class="col-md-8 " style="margin-top: 5px">
                                <h3>{{trans('lang.receiver-information')}}</h3>
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
                                <th class="text-center" style="border: 0">
                                    <h3>{{trans('lang.receiver-name')}}</h3></th>
                                <td class="text-center" style="border: 0">ايمان محمد مطهر
                                    اللوندي
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.phone-number')}}</h3>
                                </th>
                                <td class="text-center">77778940063</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.email')}}</h3></th>
                                <td class="text-center">eman@gmail.com</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.address')}}</h3></th>
                                <td class="text-center">الستين الشمالي - حي الاعناب</td>
                            </tr>
                            <tr>
                                <th class="text-center"><h3>{{trans('lang.account')}} </h3></th>
                                <td class="text-center">5454548444</td>
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
