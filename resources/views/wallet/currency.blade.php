@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2 class="mb-5"> {{trans('lang.currencies-exchange')}} </h2>
            <div class="row">

            </div>
            <div class="container mt-0">
                <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">{{trans('lang.currencies-exchange')}} </h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{trans('lang.currency')}}</th>
                                    <th scope="col">{{trans('lang.exchange_price')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <img src='{{$currency->img_path}}'
                                                     alt="{{$currency->code}}" class=" mx-auto d-block" width="28px">


                                                <div class="media-body">
                                                    <span class="mb-0 mr-5 text-sm">{{$currency->name}} </span>
                                                </div>
                                            </div>
                                        </th>


                                        </td>

                                        <td>
                                        <span class="badge badge-dot mr-4">
                                       {{$currency->exchange_price}}

                                      </span>
                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>

                            </table>

                            <!-- edit Modal -->
                            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modal"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header   col-md-12">
                                            <div class=" col-md-10 row ">
                                                <div class="col-md-2 text-right">
                                                    <div class="circle_icon"><i class="fas fa-edit"></i></div>
                                                </div>
                                                <div class="col-md-8 " style="margin-top: 5px">
                                                    <h3>تعديل بيانات الحساب</h3>
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
                                            <div class="transfer-coin-input ">
                                                <label> نوع الحساب </label>

                                                <div class="dropdown" style="width: 90%">
                                                    <div class="select">
                                                        <span> باي بال</span>
                                                        <i class="fas fa-caret-down"></i>
                                                    </div>
                                                    <input type="hidden" name="gender">
                                                    <ul class="dropdown-menu ">

                                                        <li class="list-group-item disabled" style="width: 95%"><h3
                                                                    class="text-right" style="padding: 10px;">
                                                                البنوك الألكترونية
                                                            </h3>
                                                        </li>


                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/visa.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>Visa </h3>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>Visa </h3>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>Visa </h3>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>Visa </h3>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>

                                                        <li class="list-group-item disabled" style="width: 95%"><h3
                                                                    class="text-right" style="padding: 10px;">
                                                                المحافظ المحلية
                                                            </h3></li>


                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>فلوسك </h3>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:45%;">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>ام فلوس </h3>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width: 45%">
                                                            <div class="row col-md-12">
                                                                <div class="col-md-4">
                                                                    <img
                                                                            src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"
                                                                            alt="USD" style="max-width: 40px;">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="method">
                                                                        <h3>بايير </h3>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="transfer-coin-input ">

                                                <label> بيانات الحساب :</label>
                                                <div class="input-two clearfix">


                                                    <div class="input-two-box " style="width: 90%">
                                                        <input type="" name="" value="545454545" placeholder=""
                                                               style="width: 100%">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="remove-popuo-btn clearfix" style="width: 100%; margin: 0">
                                            <button class="remove-btn cancel-btn" data-dismiss="modal">اغلاق</button>
                                            <button class="remove-btn" data-dismiss="modal"
                                                    style="background-color: #87d682">تأكيد
                                            </button>
                                        </div>
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
                                                <h3>هل انت متأكد من حذف الحساب ؟</h3>
                                                <div class="remove-popuo-btn clearfix">
                                                    <button class="remove-btn cancel-btn" data-dismiss="modal">اغلاق
                                                    </button>
                                                    <button class="remove-btn" data-dismiss="modal">تأكيد</button>
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
