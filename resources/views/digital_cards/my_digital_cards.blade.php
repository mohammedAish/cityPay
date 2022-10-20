@extends('wallet.index')
@section('content')
    <!-- Purchase Section Starts -->
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">

            @include('layouts.profile.tabs')

            <h2><i class="fas fa-credit-card"></i>{{__('lang.my-digital-cards')}} </h2>
        </div>
        <div class="tranfer-coin-box " style="">
            <div class="transfer-coin-content-box col-xl-12 row ">
                <div class="tab-content" id="nav-tabContent" style="width: 100%">
                    <div class="tab-pane fade show active" id="transaction" role="tabpanel"
                         aria-labelledby="nav-home-tab">

                        <div class="" style="margin-top: 20px;">
                            <div class="row table-responsive">

                                <table id="example2" class="table table-borderless" style="width:100%">
                                    <thead>
                                    <tr>

                                        <th>{{trans('lang.transaction-id')}}</th>
                                        <th>{{trans('lang.qty_cards')}}</th>
                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.order-date')}}</th>
                                        <th>{{trans('lang.order-status')}}</th>
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
                                                    <h3>
                                                        {{count($item->digitalCardsBought)}}
                                                    </h3>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="wallet-transaction-balance">
                                                    <h3>
                                                        {{$item->total_amount}}
                                                    </h3>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="wallet-transaction-balance">
                                                    <span>{{$item->created_at->diffForHumans()}} </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="wallet-transaction-balance">
                                                    <span>{{$item->current_status_ar}} </span>
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

                        <!-- Detail Modal -->

                        <!-- deposit-order -->
                        <div class="modal fade" id="deposit-order" tabindex="-1" role="dialog" aria-labelledby="modal"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header   col-md-12">
                                        <div class=" col-md-10 row ">
                                            <div class="col-md-2 text-right">
                                                <div class="circle_icon " style="background-color: red"><i
                                                            class="fas fa-info"></i></div>
                                            </div>
                                            <div class="col-md-8 " style="margin-top: 5px">
                                                <h3>{{trans('lang.upload-payment-invoice')}}</h3>
                                            </div>
                                        </div>


                                        <div class=" text-left">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="inner">
                                            <div class="form-row form-row-date">
                                                <div class="form-holder form-holder-2 col-md-12">
                                                    <div class="container" style="text-align: center;">
                                                        <form id="data" method="post" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-12 col-md-offset-3 "
                                                                     style="text-align: center;">
                                                                    <div class="btn-container">
                                                                        <!--the three icons: default, ok file (img), error file (not an img)-->

                                                                        <h1 class="imgupload"><i
                                                                                    class="zmdi zmdi-cloud-upload"
                                                                                    style="color: #0B4879;"></i>
                                                                        </h1>
                                                                        <h1 class="imgupload ok"><i
                                                                                    class="zmdi zmdi-check"></i></h1>
                                                                        <h1 class="imgupload stop"><i
                                                                                    class="zmdi zmdi-close-circle"></i>
                                                                        </h1>
                                                                        <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                                        <p id="namefile">{{trans('lang.img-extension')}}
                                                                            (jpg,jpeg,bmp,png)</p>
                                                                        <!--our custom btn which which stays under the actual one-->
                                                                        <button type="button" id="btnup"
                                                                                class="btn  btn-lg"
                                                                                style="background-color: #0B4879; color: white">
                                                                            {{trans('lang.brows-imgs')}}
                                                                        </button>
                                                                        <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                                        <input type="file" value="" name="fileup"
                                                                               id="fileup">
                                                                        <input type="hidden" name="order_id"
                                                                               id="model_order_id" value="0">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!--additional fields-->


                                                    </div>


                                                </div>

                                            </div>

                                        </div>

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
            </div>
        </div>

        <div class="modal fade" id="model_operation" tabindex="-1" role="dialog" aria-labelledby="modal"
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="modal-body" id="model_operation_body">

                    </div>
                    {{--                                        <div class="modal-footer">--}}
                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section("custom_js")
    <script>
        $(document).on("click", '.operation_detail', function (e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var url = '{!! route('cards.show_d_card_order', [':order_id']) !!}';
            url = url.replace(':order_id', order_id);
            $.ajax({
                url: url,
                type: "get",
                redirect: true,
                data: {},
                success: function (response) {
                    $('#model_operation_body').html(response);
                    $('#model_operation').modal('show');
                }
            })
// $("#info_agency_name").text(get_first_objectVal(data.name));


        });

    </script>
@endsection