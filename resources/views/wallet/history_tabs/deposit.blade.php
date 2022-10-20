<div class="" style="margin-top: 20px;">
    <div class="row table-responsive">

        <table id="example2" class="table table-borderless" style="width:100%">
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

                          {{ empty($item->agency) ? "":$item->agency->name}}
                                {{ !empty($item->agencyCountry->country) ? " ". $item->agencyCountry->country->name :''}}
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
                            @if($item->current_status=="pending" )
                                <span>    <img id="img_path_{{$item->id}}" src="{{asset($item->img_path)}}" alt=""
                                               style="max-width: 40px;">
                                    <a href="#" data-order_id="{{$item->id}}" class="show_add_file_model"> <i
                                                class="fas fa-circle p-5-wizard  "
                                                style="color:  red;"></i>   {{$item->current_status_ar}}{{'- ايصال الدفع'}}</a></span>
                            @else
                                <span>
                                <a href="#">
                                    <i class="fas fa-circle p-5-wizard " style="color:  #ffcb2e;"></i>
                                    {{$item->current_status_ar}}
                                </a>

                            </span>

                            @endif

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


<script type="text/javascript">
    $(document).ready(function () {
        var tst = '{{session()->get('order_msg')}}';
        if (tst !== '' && tst !== null) {
            $.toast({
                heading: 'تم ارسال الطلب',
                text: '{{session()->get('order_msg')}}',
                showHideTransition: 'fade',
                icon: 'success',
                position:'top-right'
            });
        }
    });
</script>

<!-- Detail Modal -->

