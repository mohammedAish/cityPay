@extends('wallet.index')
@section('content')

    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2 class="mb-5"><i class="fas fa-user"></i> {{trans('lang.my-finical-accounts')}} </h2>
            <div class="row">

            </div>
            <div class="container mt-0">
                <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0 text-right">
                                <a class="col-6" href={{route('wallet.add_finance_account')}} >
                                    <i class="fas fa-plus"></i>
                                    {{trans('lang.add_account')}}
                                </a>
                            </h3>

                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{trans('lang.agency')}}</th>
                                  {{--  <th scope="col">{{trans('lang.agency-type')}}</th>--}}
                                    <th scope="col">{{trans('lang.account-information')}}</th>
                                    <th scope="col">{{trans('lang.cust_account_name')}}</th>
                                    <th scope="col">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($finance_accounts as $account)
                                    @if($account->agency!=null)
                                        <tr>
                                            <th scope="row">

                                                <div class="media align-items-center">
                                                    <img src="{{asset($account->agency->img_path)}}"
                                                         alt="Loader" class="wizardimg mx-auto d-block">
                                                    <div class="media-body">
                                                        <span class="mb-0 mr-5 text-sm">{{$account->agency->name}} </span>
                                                    </div>
                                                </div>
                                            </th>

                                         {{--   <td>
                            <span class="badge badge-dot mr-4">
                                 {{$account->agency->national}}
                            </span>
                                            </td>--}}

                                            <td>
                                                <div class="d-flex align-items-center">
                                                <span class="mr-2"
                                                      id="account_{{$account->id}}">{{$account->customer_agency_acc_number}}</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2">{{$account->customer_agency_acc_name}}</span>

                                                </div>
                                            </td>
                                            <td class="text-center">

                                                <a href="#" id="edit_customer_agency_btn{{$account->id}}}"
                                                   class="edit_customer_agency_btn"
                                                   agency_name="{{$account->agency->name}}"
                                                   all_data="{{$account}}"
                                                   agency_id="{{$account->agency_id}}"> <i
                                                            class="fas fa-edit p-5-wizard"></i> </a>

                                                {{--                                            <a href="#" data-toggle="modal" data-target="#delete"><i--}}
                                                {{--                                                        class="fas fa-trash  p-5-wizard"></i> </a>--}}

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            <!-- detail Modal -->
                            <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modal"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header   col-md-12">
                                            <div class=" col-md-10 row ">
                                                <div class="col-md-2 text-right">
                                                    <div class="circle_icon"><i class="fas fa-user"></i></div>
                                                </div>
                                                <div class="col-md-8 " style="margin-top: 5px">
                                                    <h3>{{trans('lang.edit-account')}}</h3>
                                                </div>
                                            </div>


                                            <div class=" text-left">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                        </div>
                                        <form id="form_data">
                                            @csrf
                                            <div class="modal-body">


                                                <div class="theme-input-box">

                                                    <label>{{trans('lang.account-type')}} </label>
                                                    <input type="text" id="edit_agency_name" disabled="disabled" name=""
                                                           value="" class="theme-input">
                                                    <input type="hidden" id="edit_account_id" name="id">
                                                    <input type="hidden" id="edit_agency_id" name="agency_id">
                                                </div>
                                                <div class="theme-input-box">
                                                    <label>{{trans('lang.account-number')}}</label>
                                                    <input type="text" id="edit_customer_agency_acc_number"
                                                           name="customer_agency_acc_number" value=" "
                                                           class="theme-input">
                                                </div>
                                                <div class="theme-input-box">
                                                    <label>{{trans('lang.account-name')}}</label>
                                                    <input type="text" id="edit_customer_agency_acc_name"
                                                           name="customer_agency_acc_name" value=" "
                                                           class="theme-input">
                                                </div>


                                            </div>
                                            <div class="remove-popuo-btn clearfix" style="width: 100%; margin: 0">
                                                <button class="remove-btn cancel-btn"
                                                        data-dismiss="modal">{{trans('lang.close')}}
                                                </button>
                                                <button class="remove-btn" id="edit_customer_agency" type="button"

                                                        style="background-color: #87d682">{{trans('lang.update')}}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- delete model area -->
                            <div id="delete" class="modal fade remove-theme-popup" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal"><i
                                                        class="fas fa-times"></i></button>
                                            <div class="remove-popup">
                                                <h3>{{trans('lang.sure-to-delete')}}</h3>
                                                <div class="remove-popuo-btn clearfix">
                                                    <button class="remove-btn cancel-btn"
                                                            data-dismiss="modal">{{trans('lang.close')}}
                                                    </button>
                                                    <button class="remove-btn"
                                                            data-dismiss="modal">{{trans('lang.confirm')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="card-footer py-4">--}}
                        {{--                            <nav aria-label="...">--}}
                        {{--                                <ul class="pagination justify-content-end mb-0">--}}
                        {{--                                    <li class="page-item disabled">--}}
                        {{--                                        <a class="page-link" href="#" tabindex="-1">--}}
                        {{--                                            <i class="fas fa-angle-left"></i>--}}
                        {{--                                            <span class="sr-only">Previous</span>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item active">--}}
                        {{--                                        <a class="page-link" href="#">1</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item">--}}
                        {{--                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                        {{--                                    <li class="page-item">--}}
                        {{--                                        <a class="page-link" href="#">--}}
                        {{--                                            <i class="fas fa-angle-right"></i>--}}
                        {{--                                            <span class="sr-only">Next</span>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </nav>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("custom_js")
    <script type="text/javascript">
        $('.edit_customer_agency_btn').click(function () {
            var data = JSON.parse($(this).attr('all_data'));
            var agency_name = $(this).attr('agency_name');
            var agency_id = $(this).attr('agency_id');
            $('#detail').modal('show');

            console.log(data);

            $("#edit_agency_name").val(agency_name);
            $("#edit_customer_agency_acc_number").val(data.customer_agency_acc_number);
            $("#edit_customer_agency_acc_name").val(data.customer_agency_acc_name);
            $("#edit_agency_id").val(agency_id);
        });

        $('#edit_customer_agency').click(function () {

            $.easyAjax({
                url: '{{route('wallet.save_new_account')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    $("#account_" + response.data.id).text(response.data.customer_agency_acc_number);
                    $("#edit_customer_agency_btn" + response.data.id).prop("agency_id", response.data.customer_agency_acc_number);
                    $('#detail').modal('hide');

                    {{--                    location.replace("{{route("wallet.my_accounts")}}")--}}
                }
            })
        });

    </script>
@endsection
