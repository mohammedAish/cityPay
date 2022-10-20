@extends('wallet.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-tachometer-alt"></i> {{trans('lang.Dashboard')}}</h2>
        </div>
        <div class="wallet-balance-area clearfix">
            <div class="row col-md-12">
                <div class="wallet-balance-box wallet1" style="width: 100%">
                    <div class="wallet-balance-ico">
                        <img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}" alt="Bicoin">
                    </div>
                    <h3>{{trans('lang.balance')}}</h3>
                    <h4>500.00 USD</h4>
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
                <h3>{{trans('lang.theDeposit')}}</h3>
                <h4>877393,12 USD</h4>

            </div>
            <div class="wallet-balance-box wallet5">
                <div class="wallet-balance-ico">
                    <img src="{{asset('/org_assets/dist/img/walletimages/xrp.png')}}" alt="Ripple">
                </div>
                <h3>{{trans('lang.loyal')}}</h3>
                <h4>323.0421 USD</h4>

            </div>
            <div class="wallet-balance-box wallet6">
                <div class="wallet-balance-ico">
                    <img src="{{asset('/org_assets/dist/img/walletimages/dash.png')}}" alt="Dash">
                </div>
                <h3>{{trans('lang.cashback')}}</h3>
                <h4>3.042189 USD</h4>

            </div>
            </div>
        </div>
        <!-- <div class="my-wallet-area clearfix">
           <div class="my-wallet-box create-new-box" data-toggle="modal" data-target="#create-wallet">
              <div class="my-wallet-ico"><i class="fas fa-plus"></i></div>
              <h3>Create New Wallet</h3>
           </div>
           <div class="my-wallet-box">
              <div class="my-wallet-name">
                 <h3>BTC Wallet Address</h3>
              </div>
              <div class="my-wallet-address">
                 <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>
                 <i class="far fa-copy"></i>
              </div>
              <div class="my-wallet-balance">
                 <h3>Balance :- <span> 1.234567735 BTC</span></h3>
              </div>
           </div>
           <div class="my-wallet-box">
              <div class="my-wallet-name">
                 <h3>LTC Wallet Address</h3>
              </div>
              <div class="my-wallet-address">
                 <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>
                 <i class="far fa-copy"></i>
              </div>
              <div class="my-wallet-balance">
                 <h3>Balance :- <span> 1.234567735 LTC</span></h3>
              </div>
           </div>
           <div class="my-wallet-box">
              <div class="my-wallet-name">
                 <h3>ETH Wallet Address</h3>
              </div>
              <div class="my-wallet-address">
                 <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>
                 <i class="far fa-copy"></i>
              </div>
              <div class="my-wallet-balance">
                 <h3>Balance :- <span> 1.234567735 ETH</span></h3>
              </div>
           </div>
           <div class="my-wallet-box">
              <div class="my-wallet-name">
                 <h3>BTC Wallet Address</h3>
              </div>
              <div class="my-wallet-address">
                 <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>
                 <i class="far fa-copy"></i>
              </div>
              <div class="my-wallet-balance">
                 <h3>Balance :- <span> 1.234567735 BTC</span></h3>
              </div>
           </div>
           <div class="my-wallet-box">
              <div class="my-wallet-name">
                 <h3>BTC Wallet Address</h3>
              </div>
              <div class="my-wallet-address">
                 <span>1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX</span>
                 <i class="far fa-copy"></i>
              </div>
              <div class="my-wallet-balance">
                 <h3>Balance :- <span> 1.234567735 BTC</span></h3>
              </div>
           </div>
        </div> -->
            <div class="wallet-box-main clearfix">
                <div class="wallet-box-left">
                    <div class="wallet-balance">
                        <h2 class="dashboard-title"> عمليات قيد الانتظار</h2>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico wallet-Withdrawal"><i class="fas fa-info"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>{{trans('lang.Withdrawal')}}</h3>
                                <span>مصر  | باي يال</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="wallet-box-right">
                    <div class="wallet-transaction">
                        <h2 class="dashboard-title"> {{trans('lang.Last_Transaction')}}</h2>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico"><i class="fas fa-arrow-up"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>{{trans('lang.Deposit')}}</h3>
                                <span>اليمن | بنك اليمن والكويت</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico wallet-Withdrawal"><i class="fas fa-arrow-down"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>{{trans('lang.Withdrawal')}}</h3>
                                <span>مصر  | باي يال</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico wallet-sync"><i class="fas fa-sync-alt"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>تحويل </h3>
                                <span> الى حساب محمد علي في باي بال</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

    </div>


    <!-- wallet area -->
    <!-- create wallet area -->
{{--    <div id="create-wallet" class="modal fade theme-popup" role="dialog">--}}
{{--        <div class="modal-dialog">--}}
{{--            <!-- Modal content-->--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title">Create Wallet</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="wallet-popup">--}}
{{--                        <form>--}}
{{--                            <div class="wallet-popup-box">--}}
{{--                                <label>Address</label>--}}
{{--                                <input class="theme-input" type="" name="" placeholder="1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX">--}}
{{--                            </div>--}}
{{--                            <div class="wallet-popup-box">--}}
{{--                                <label>Amount</label>--}}
{{--                                <input class="theme-input" type="" name="" placeholder="1.234567735">--}}
{{--                                <select>--}}
{{--                                    <option>BTC</option>--}}
{{--                                    <option>ETH</option>--}}
{{--                                    <option>LTC</option>--}}
{{--                                    <option>BCH</option>--}}
{{--                                    <option>USDT</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="wallet-btn text-right">--}}
{{--                                <button class="theme-btn">Create Wallet</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- create wallet area area -->
    <!-- remove wallet area -->
{{--    <div id="remove-wallet" class="modal fade remove-theme-popup" role="dialog">--}}
{{--        <div class="modal-dialog">--}}
{{--            <!-- Modal content-->--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>--}}
{{--                    <div class="remove-popup">--}}
{{--                        <h3>Are you sure want to remove ?</h3>--}}
{{--                        <div class="remove-popuo-btn clearfix">--}}
{{--                            <button class="remove-btn cancel-btn" data-dismiss="modal">Cancel</button>--}}
{{--                            <button class="remove-btn" data-dismiss="modal">Remove</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- remove wallet area -->--}}
{{--    <!-- logout model area -->--}}
{{--    <div id="logout" class="modal fade remove-theme-popup" role="dialog">--}}
{{--        <div class="modal-dialog">--}}
{{--            <!-- Modal content-->--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>--}}
{{--                    <div class="remove-popup">--}}
{{--                        <h3>Are you sure want to logout ?</h3>--}}
{{--                        <div class="remove-popuo-btn clearfix">--}}
{{--                            <button class="remove-btn cancel-btn" data-dismiss="modal">Cancel</button>--}}
{{--                            <button class="remove-btn" data-dismiss="modal">Logout</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- logout model area -->
@endsection
