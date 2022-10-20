<!--route wallet.loyalty-->
@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2 class="mb-5"> <i class="fas fa-handshake"> </i> نقاط برنامج الولاء 200 نقطة    </h2><div class="row">

            </div>
            <div class="col-md-12 mb-12">
                <div class="timeline_div">
                    <div class="road"><label></label>
                        <span>0 نقطة</span>
                        <div class="user_here" style="left: calc(24% + 0% );">
                            <i class="fa fa-arrow-up"></i><br>0.0000 نقطة</div>
                    </div><div class="road"><label>عميل برونزي</label>
                        <span>280 نقطة</span></div><div class="road">
                        <label>عميل فضي</label><span>560 نقطة</span>
                    </div>
                </div>
                <div class="clearfix"><hr></div><br><br>
                <div class="col-md-12 mb-12">
                </div>
                <div class="clearfix"><hr></div><br><br>
                <div class="col-md-12 mb-12">
                </div>
            </div>
                <div class="wallet-balance-area clearfix">
                    <div class="row col-md-12">
                        <div class="wallet-balance-box wallet1" style="width: 100%">
                            <div class="wallet-balance-ico">
                                <img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}" alt="Bicoin">
                            </div>
                            <h3>اجمالي نقاط الولاء</h3>
                            <h4>200 نقطة </h4>
                            {{--                    <div class="my-wallet-address">--}}
                            {{--                        <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>--}}
                            {{--                        <i class="far fa-copy"></i>--}}
                            {{--                    </div>--}}
                        </div>


                    </div>

                    <div class="row col-md-12">


                        <div class="wallet-balance-box wallet4">
                            <div class="wallet-balance-ico">
                                <img src="{{asset('/org_assets/dist/img/walletimages/bch.png')}}" alt="Bitcoin Cash">
                            </div>
                            <h3>نقاط الولاء من شراء الكورسات</h3>
                            <h4>50 نقطة</h4>

                        </div>
                        <div class="wallet-balance-box wallet5">
                            <div class="wallet-balance-ico">
                                <img src="{{asset('/org_assets/dist/img/walletimages/xrp.png')}}" alt="Ripple">
                            </div>
                            <h3>نقاط الولا من شراء الاستشارات</h3>
                            <h4>50 نقطة </h4>

                        </div>
                        <div class="wallet-balance-box wallet6">
                            <div class="wallet-balance-ico">
                                <img src="{{asset('/org_assets/dist/img/walletimages/dash.png')}}" alt="Dash">
                            </div>
                            <h3>نقاط الولاء من شراء البطاقات الرقمية</h3>
                            <h4>100 نقطة </h4>

                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

@endsection
