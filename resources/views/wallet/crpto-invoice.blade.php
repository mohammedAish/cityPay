<!--route rpto-invoice-->
@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2>ايداع للمحفظة </h2>
        </div>

        <div class="transfer-coin-content-box active" >
            <div class="payment-invoice-content ">
                <div class="invoice-warning">
                    <p><span class="invoice-text"><i class="fas fa-exclamation-circle"></i></span> Please Verify the Address and Amount properly. Sent BTC can not be reversed in any case.</p>
                </div>
                <div class="invoice-qr-img">
                    <img id="copy" data-clipboard-text="MgzB63dVsdbshsbhsbsbhsbsdhsdhvs" src="{{asset('org_assets/dist/img/walletimages/code-scan.png')}}" data-original-title="" alt="Qr Code">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.transfer-coin-btn > a').click(function() {
                var tab_id = $(this).attr('data-tab');

                $('.transfer-coin-btn > a').removeClass('active');
                $('.transfer-coin-content-box').removeClass('active');

                $(this).addClass('active');
                $("#" + tab_id).addClass('active');
            });
            $('.dropdown').click(function () {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-menu').slideToggle(300);
            });
            $('.dropdown').focusout(function () {
                $(this).removeClass('active');
                $(this).find('.dropdown-menu').slideUp(300);
            });
            $('.dropdown .dropdown-menu li').click(function () {
                $(this).parents('.dropdown').find('span').text($(this).text());
                $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
            });
        });
    </script>
@endsection
