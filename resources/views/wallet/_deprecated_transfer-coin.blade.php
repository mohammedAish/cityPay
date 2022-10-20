<!--/transfer-coin',function-->
@extends('wallet.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-coins"></i> Transfer Coin</h2>
        </div>
        <div class="tranfer-coin-box">
            <div class="row">
                <div class="col-xl-7">
                    <div class="transfer-coin-left-box">
                        <div class="transfer-coin-btn">
                            <a class="active" href="JavaScript:Void(0)" data-tab="sent-coin"><i class="fas fa-arrow-alt-circle-up"></i> Sent</a>
                            <a href="JavaScript:Void(0)" data-tab="receive-coin"><i class="fas fa-arrow-alt-circle-down"></i> Receive</a>
                        </div>
                        <div class="transfer-coin-content">
                            <div class="transfer-coin-content-box active" id="sent-coin">
                                <div class="transfer-coin-input transfer-coin-select clearfix">
                                    <div class="dropdown">
                                        <div class="select">
                                            <span><img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"  alt="USD"> USD</span>
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                        <input type="hidden" name="gender">
                                        <ul class="dropdown-menu">
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"  alt="USD"> USD</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/btc.png')}}"  alt="Bitcoin"> BTC</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/ltc.png')}}" alt="Litecoin"> LTC</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/bch.png')}}" alt="Bitcoin Cash"> BCH</li>
                                            <li><img  src="{{asset('/org_assets/dist/img/walletimages/xrp.png')}}"  class="Ripple"> XRP</li>
                                        </ul>
                                    </div>
                                    <i class="fas fa-exchange-alt"></i>
                                    <div class="dropdown">
                                        <div class="select">
                                            <span><img src="{{asset('/org_assets/dist/img/walletimages/btc.png')}}"  alt="Bitcoin"> BTC</span>
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                        <input type="hidden" name="gender">
                                        <ul class="dropdown-menu">
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/btc.png')}}" alt="Bitcoin"> BTC</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/ltc.png')}}"  alt="Litecoin"> LTC</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/bch.png')}}"  alt="Bitcoin Cash"> BCH</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}"  alt="USD"> USD</li>
                                            <li><img src="{{asset('/org_assets/dist/img/walletimages/xrp.png')}}"  alt="Ripple"> XRP</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="transfer-coin-input">
                                    <label>To Address</label>
                                    <input type="" name="" value="1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX" placeholder="">
                                </div>
                                <div class="transfer-coin-input">
                                    <label>Amount to send</label>
                                    <div class="input-two clearfix">
                                        <div class="input-two-box">
                                            <input type="" name="" value="0.000000" placeholder="">
                                            <span>USD</span>
                                        </div>
                                        <i class="fas fa-exchange-alt"></i>
                                        <div class="input-two-box">
                                            <input type="" name="" value="0.000000" placeholder="">
                                            <span>BTC</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="transfer-coin-button">
                                    <button class="theme-btn">Sent Coin</button>
                                </div>
                            </div>
                            <div class="transfer-coin-content-box" id="receive-coin">
                                <div class="payment-invoice-content">
                                    <div class="invoice-warning">
                                        <p><span class="invoice-text"><i class="fas fa-exclamation-circle"></i></span> Please Verify the Address and Amount properly. Sent BTC can not be reversed in any case.</p>
                                    </div>
                                    <div class="invoice-qr-img">
                                        <img id="copy" data-clipboard-text="MgzB63dVsdbshsbhsbsbhsbsdhsdhvs"  src="{{asset('/org_assets/dist/img/walletimages/code-scan.png')}}" data-original-title="" alt="Qr Code">
                                    </div>
                                    <div class="invoice-qr-ammount-box">
                                        <div class="invoice-ammount-box">
                                            <label>Amount</label>
                                            <h2 id="ammount-copy" data-clipboard-text="MgzB63dVsdbshsbhsbsbhsbsdhsdhvs" data-original-title="" title="">0.00001 BTC</h2>
                                        </div>
                                        <div class="invoice-qr-box">
                                            <label>Address</label>
                                            <div class="invoice-payment-url">
                                                <input type="" name="" value="MgzB63dVsdbshsbhsbsbhsbsdhsdhvs" disabled=""><i id="input-copy" data-clipboard-text="MgzB63dVsdbshsbhsbsbhsbsdhsdhvs" class="far fa-copy" data-original-title="" title=""></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transfer-coin-button">
                                        <button class="theme-btn">Receive Coin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="wallet-transaction">
                        <h2 class="dashboard-title">Transaction</h2>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico sent-coin-transaction"><i class="fas fa-arrow-up"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>BTC</h3>
                                <span>Sent</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico recive-coin-transaction"><i class="fas fa-arrow-down"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>LTC</h3>
                                <span>Receive</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico recive-coin-transaction"><i class="fas fa-arrow-down"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>BTC</h3>
                                <span>Receive</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico sent-coin-transaction"><i class="fas fas fa-arrow-up"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>ETH</h3>
                                <span>Sent</span>
                            </div>
                            <div class="wallet-transaction-balance">
                                <h3>$ 405.34</h3>
                                <span>20 Jan 2020</span>
                            </div>
                        </div>
                        <div class="wallet-transaction-box clearfix">
                            <div class="wallet-transaction-ico sent-coin-transaction"><i class="fas fas fa-arrow-down"></i></div>
                            <div class="wallet-transaction-name">
                                <h3>BTH</h3>
                                <span>Sent</span>
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
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- wallet area -->
    <!-- create wallet area -->
    <div id="create-wallet" class="modal fade theme-popup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Send Bitcoin</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="wallet-popup">
                        <form>
                            <div class="wallet-popup-box">
                                <input class="theme-input" type="" name="" placeholder="1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX">
                            </div>
                            <div class="wallet-popup-box">
                                <input class="theme-input" type="" name="" placeholder="1.234567735">
                                <span>BTC</span>
                            </div>
                            <div class="wallet-btn text-right">
                                <button class="theme-btn">Create Wallet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- create wallet area -->
    <!-- logout model area -->
    <div id="logout" class="modal fade remove-theme-popup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <div class="remove-popup">
                        <h3>Are you sure want to logout ?</h3>
                        <div class="remove-popuo-btn clearfix">
                            <button class="remove-btn cancel-btn" data-dismiss="modal">Cancel</button>
                            <button class="remove-btn" data-dismiss="modal">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- logout model area -->
@endsection
