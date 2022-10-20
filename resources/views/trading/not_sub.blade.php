@extends('trading.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">

        <div class="wallet-balance-area clearfix">

            <div class="row col-md-12">

                <div class="wallet-balance-box d-flex flex-column align-items-center justify-content-center  " style="width: 100% ; height: 80vh !important;">

                    <h3>انت لست مشترك في الخدمة </h3>
                    <h3>اشترك اولا  </h3>
                    <div class="profile-btn" style="margin: 20px; ">
                        <button class="theme-btn" style="background-color: green">اشتراك</button>
                    </div>

                    {{--                    <div class="my-wallet-address">--}}
                    {{--                        <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>--}}
                    {{--                        <i class="far fa-copy"></i>--}}
                    {{--                    </div>--}}
                </div>

            </div>
        </div>


    </div>


@endsection
