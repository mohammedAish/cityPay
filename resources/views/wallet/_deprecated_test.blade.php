<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>



    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if(LaravelLocalization::getCurrentLocale()=="ar")
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/wallet_rtl_style.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/walletstyle.css')}}">


    @endif

    {{--        for responsive classes purpose --}}
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/responsive.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('/org_assets/dist/cdnjs.cloudflare.com/ajax/libs/Chart.assets/js/2.9.3/Chart.html')}}">--}}

    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/owl.carousel.min.css')}}">
    <link href="{{ asset('/org_assets/plugins/froiden-helper/helper.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/wizardstyle.css')}}">
    {{--      Almarai  font link--}}
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    {{--      awasomefont link--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"/>
    {{--        iconic link--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
          integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
          crossorigin="anonymous"/>


    <title>{{trans('lang.my_wallet')}}</title>
    <meta name="Keywords"
          content="crypto wallet, best crypto wallet, cryptocurrency wallet, online cryptocurrency wallet, multi cryptocurrency wallet">
    <meta name="Description"
          content="Create a multiple crypto wallet to send and receive crypto coins through various cryptocurrencies such as Bitcoin, Ethereum, Litecoin, etc. Check more features">
    <meta name="theme-color" content="#001c71">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description"
          content="Create a multiple crypto wallet to send and receive crypto coins through various cryptocurrencies such as Bitcoin, Ethereum, Litecoin, etc. Check more features">
    <meta name="twitter:title" content="Crypto Wallet User Panel | Cryptocurrency Wallet">
    <meta name="twitter:image" content="assets/images/meta-banner.html">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Crypto Wallet User Panel | Cryptocurrency Wallet">
    <meta property="og:description"
          content="Create a multiple crypto wallet to send and receive crypto coins through various cryptocurrencies such as Bitcoin, Ethereum, Litecoin, etc. Check more features">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="Crypto Wallet User Panel">
    <meta property="og:image" content="assets/images/meta-banner.html">
    <meta property="og:image:secure_url" content="assets/images/meta-banner.html">
    <style type="text/css">
        @media screen and (max-width: 767px) {
            .wallet-transaction {
                margin: 30px 0 0 !important;
            }
        }


    </style>

    <script src="{{asset('/org_assets/dist/js/jquery-3.5.0.min.js')}}"></script>

</head>
<body >

<!-- wallet area -->
<div class="wallet-area">

    <div class="header-box">
        <div class="header-logo">
            <img  src="{{asset('org_assets/dist/img/walletimages/logo.png')}}"  alt="logo">
        </div>
        <div class="header-nav-menu">
            <i class="menu-responsive fas fa-bars"></i>
            <ul>
                <li class="active"><a href={{url('/wallet/dashboard')}}><i class="fas fa-tachometer-alt"></i> {{trans('lang.Dashboard')}}</a></li>
                <li><a href={{url('/account/profile/dashboard')}}><i class="fas fa-user"></i> {{trans('lang.profile')}} </a></li>

                <li ><a href={{url('/wallet/my_accounts')}}><i class="fas fa-user"></i>{{trans('lang.my-financial-accounts')}}</a></li>


                <li ><a href={{url('/wallet/deposit')}}><i class="fas fa-arrow-down"></i> {{trans('lang.deposit')}}</a></li>
                <li ><a href={{url('/wallet/withdraw2')}}><i class="fas fa-arrow-up"></i> {{trans('lang.withdraw')}}</a></li>
                <li ><a href={{url('/wallet/transfer')}}><i class="fas fa-sync-alt"></i> {{trans('lang.transfer-money')}}</a></li>
                <li ><a href={{url('/wallet/currencies')}}><i class="fas fa-money-bill-alt"></i>{{trans('lang.currency-exchange')}}</a></li>
                <li ><a href={{url('/wallet/pay_invoice')}}><i class="fas fa-file-invoice"></i>{{trans('lang.pay-purchase-bills')}}</a></li>
                <li ><a href={{url('/wallet/freelancing')}}><i class="fas fa-hands-helping"></i>{{trans('lang.freelancing-withdraw')}}</a></li>
                {{--            <li><a href={{url('/wallet/my_accounts')}}><i class="fa fa-search-dollar"></i> حساباتي المالية</a></li>--}}
                {{--            <li><a href={{url('/wallet/lovers_accounts')}}><i class="fas fa-heart"></i> حسابات احبائي</a></li>--}}

                {{--            <li class="dropdown" style="width: 100%">--}}

                {{--                <a href="#" class="dropdown-btn-invoice ">  سداد المشتريات--}}
                {{--                    <i class="fas fa-file-invoice"></i>--}}

                {{--                </a>--}}
                {{--                <i class="fa fa-caret-down"  style="color:#96a1b7;"></i>--}}
                {{--                <div class="sidebar-invoice" >--}}
                {{--                    <ul>--}}
                {{--                        <li style="width: 100%; padding-bottom:0; padding-right: 0;padding-left: 0;">--}}

                {{--                            <a href="{{url('/wallet/pay_invoice')}}">--}}
                {{--                                <i class="fas fa-file-invoice" style="position:unset;margin: 5px"></i>--}}
                {{--                                طلب سداد</a> </li>--}}
                {{--                        <li style="width: 100% ; padding-bottom:0; padding-right: 0;padding-left: 0;">--}}

                {{--                            <a href="{{url('/wallet/transfer')}}">--}}
                {{--                                <i class="fas fa-list" style="position:unset;margin: 5px"></i>--}}
                {{--                                قائمة الطلبات </a> </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
                {{--            </li>--}}



                {{--            <li><a href={{url('/wallet/loyalty')}}><i class="fas fa-handshake"></i> {{trans('lang.loyalty')}} </a></li>--}}
                {{--            <li><a href={{url('/wallet/cashback')}}><i class="fas fa-cash-register"></i> {{trans('lang.cashbacks')}} </a></li>--}}
                <li><a href={{url('/wallet/history')}}><i class="fas fa-history"></i>  {{trans('lang.transactions')}} </a></li>
                <li><a href={{url('/')}}><i class="fas fa-globe"></i> {{trans('lang.back-to-website')}} </a></li>

            </ul>

            {{--        <div class="color-switcher">--}}
            {{--            <div class="toggle-button"><i class="fas fa-cog"></i></div>--}}
            {{--            <div class="color-theme-menu">--}}
            {{--                <h4>Color Switcher</h4>--}}
            {{--                <ul id="color-ul" class="clearfix">--}}
            {{--                    <li class="color-li"><a class="theme-defalt" title="theme" href="#"></a></li>--}}
            {{--                    <li class="color-li"><a class="theme-orrange" title="theme" href="#"></a></li>--}}
            {{--                    <li class="color-li"><a class="theme-cyan" title="theme" href="#"></a></li>--}}
            {{--                    <li class="color-li"><a class="theme-green" title="theme" href="#"></a></li>--}}
            {{--                    <li class="color-li"><a class="theme-purple" title="theme" href="#"></a></li>--}}
            {{--                    <li class="color-li"><a class="purple-pink" title="theme" href="#"></a></li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            <div class="theme-color-swith">
                <a href="JavaScript:Void(0)" onclick="changeMode()">Dark Mode</a>
                <label class="switch">
                    <input type="checkbox" id="theme-change" >
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="wallet-area-right">
        <div class="wallet-top-header clearfix">
            <div class="wallet-top-header-left">
                <div class="wallet-top-header-box">
                    <div class="header-wallet-ico" style="color: #87d682;"><i class="zmdi zmdi-balance-wallet  " style="font-size: 45px"></i>
                    </div>
                    <span>T5458525</span>

                    <h3 style="color: #87d682;"><span>{{auth()->user()->balanceFloat}}</span> {{trans('lang.dollar')}}</h3>
                </div>
                <!-- <div class="wallet-top-header-box">
                   <div class="header-wallet-ico" style="color: #7ad9e3;"><i class="fab fa-bitcoin"></i></div>
                   <span>Pending Balance</span>
                   <h3 style="color: #7ad9e3;"><span>87.749575978</span> BTC</h3>
                   </div> -->
            </div>
            <div class="wallet-top-header-right">
                <div class="wallet-language-box">

                    <div class="dropdown">
                        <div class="select">
                            <h4 style="font-size: 25px;display: inline"><i class="fas fa-globe "></i> </h4> <i class="fas fa-caret-down"></i>
                        </div>
                        <input type="hidden" name="gender">
                        <div class="dropdown-menu">
                            <ul class="language-dropdown">

                                <li>
                                    <a href="#" class="lang-br lang-select" data-lang="en">
                                        <h4 style="display: inline"><img class="flag-img" src="{{asset('org_assets/dist/img/walletimages/flag/us.png')}}" alt="USA">  </h4>English
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="lang-br lang-select" data-lang="ar">
                                        <h4 style="display: inline"><img class="flag-img" src="{{asset('org_assets/dist/img/walletimages/flag/ae.png')}}" alt="Arabic"></h4>Arabic
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                {{--    <div class="notification-box-area">--}}
                {{--        <div class="notification-box">--}}
                {{--            <i class="fas fa-bell"></i>--}}
                {{--            <span class="notification-active"></span>--}}
                {{--        </div>--}}
                {{--        <div class="notification-dropdown">--}}
                {{--            <div class="notification-header">--}}
                {{--                <h3>{{trans('lang.you_have')}} <strong>3</strong> {{trans('lang.new_notifications')}}.</h3>--}}
                {{--            </div>--}}
                {{--            <ul class="notification-list">--}}
                {{--                <li class="notification-success">--}}
                {{--                    <div class="notification-icon"><i class="fas fa-check-circle"></i></div>--}}
                {{--                    <div class="notification-content">--}}
                {{--                        <h3>Successful transaction of 0.01 BTC</h3>--}}
                {{--                        <h4>15 mins ago</h4>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="notification-pending">--}}
                {{--                    <div class="notification-icon"><i class="fas fa-exclamation-circle"></i></div>--}}
                {{--                    <div class="notification-content">--}}
                {{--                        <h3>4 of Pending Transactions!</h3>--}}
                {{--                        <h4>45 mins ago</h4>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="notification-cancel read-notification">--}}
                {{--                    <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
                {{--                    <div class="notification-content">--}}
                {{--                        <h3>Cancelled Transaction of 20 BTC</h3>--}}
                {{--                        <h4>1 hour ago</h4>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="notification-cancel read-notification">--}}
                {{--                    <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
                {{--                    <div class="notification-content">--}}
                {{--                        <h3>Cancelled Transaction of 5 BTC</h3>--}}
                {{--                        <h4>1 hour ago</h4>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--                <li class="notification-cancel read-notification">--}}
                {{--                    <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
                {{--                    <div class="notification-content">--}}
                {{--                        <h3>Cancelled Transaction of 30 BTC</h3>--}}
                {{--                        <h4>1 hour ago</h4>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                {{--            </ul>--}}
                {{--            <div class="notification-footer">--}}
                {{--                <a href="JavaScript:Void(0)">{{trans('lang.Read_All_Notifications')}}</a>--}}
                {{--            </div>--}}
                {{--        </div>--}}
                {{--    </div>--}}

                <div class="wallet-top-header-box user-top-detail">
                    <div class="header-wallet-ico"></div>
                    <h3>{{auth('customers')->user()->first_name}} <i class="fas fa-chevron-down" style="padding-top:25px "></i></h3>
                    <ul class="profile-dropdown">
                        <li><a href="#"><i class="fas fa-user"></i> {{trans('lang.my_profile')}}</a></li>
                        <li><a href="#"><i class="fas fa-wallet"></i> {{trans('lang.my_wallet')}}</a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt"></i>{{trans('lang.logout')}}</a></li>
                    </ul>
                </div>

            </div>
        </div>


        <div class="wallet-box-scroll">
            <div class="wallet-bradcrumb">
                <h3>{{trans('lang.Withdraw-money-from-freelancing-platforms')}} </h3>
            </div>

            <div class="tranfer-coin-box">

                <div class="transfer-coin-content-box col-xl-12 row ">
                    <div class="col-xl-7">
                        <form method="" action="#">


                            <div class="transfer-coin-input col-md-12 row">
                                <label class="col-md-3"> {{trans('lang.freelancing-Platforms')}}</label>

                                <div class="dropdown col-md-8">
                                    <div class="select">
                                        <span> {{trans('lang.choose-platform')}}</span>
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" name="gender">
                                    <ul class="dropdown-menu">

                                        <li class="text-center"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                            <h3>خمسات </h3>

                                        </li>
                                        <li class="text-center"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                            <h3>فري لانسر </h3>

                                        </li>
                                        <li class="text-center"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                            <h3>اب وورك </h3>

                                        </li>
                                        <li class="text-center"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                            <h3>مستقل </h3>

                                        </li>

                                    </ul>
                                </div>
                            </div>


                            <div class="transfer-coin-input col-md-12 row">

                                <label class="col-md-3"> {{trans('lang.amount')}}</label>
                                <div class="input-two col-md-8 ">
                                    <div class="input-two-box " style="float: right;width: 100%;margin-right: 35px;margin-left: 35px;">
                                        <input type="" name="" value="50" placeholder="">
                                        <span>USD</span>
                                    </div>
                                </div>
                            </div>

                            <div class="transfer-coin-button">
                                <button class="theme-btn">{{trans('lang.send-withdraw-order')}}</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-xl-5">
                        <div class="invoice-warning">
                            <h3 style="margin-bottom: 30px"><span class="invoice-text"><i
                                        class="fas fa-exclamation-circle" style="color: red"></i></span>
                                {{trans('lang.Instructions-freelancing')}}

                            </h3>
                            <table class="table  ">
                                <thead>

                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="text-right">سجل الدخول الى حساب خمسات</td>

                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td class="text-right">قم بتحويل الميلغ لحساب يمن تداول الذي هو 6556455455</td>

                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td class="text-right">ترقب قبول طلبك من قائمة الطلبات</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>


                </div>


            </div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"></script>
        <script src="{{asset('/org_assets/dist/js/bootstrap.min.js')}}"></script>
        {{--<script src="{{asset('/org_assets/dist/js/jquery.steps.js')}}"></script>--}}


        <script src="{{asset('/org_assets/dist/js/jquery-ui.min.js')}}"></script>
        {{--<script src="{{asset('/org_assets/dist/js/wizard.js')}}"></script>--}}
        <script src="{{asset('/org_assets/dist/js/custom.js')}}"></script>

        <script src="{{ asset('/org_assets/plugins/froiden-helper/helper.js') }}"></script>
        <script src="{{ asset('/org_assets/plugins/toast-master/js/jquery.toast.js') }}"></script>


        <script src="{{asset('/org_assets/dist/cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js')}}"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

        <script>

            $(document).ready(function () {



                $('.transfer-coin-btn > a').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('.transfer-coin-btn > a').removeClass('active');
                    $('.transfer-coin-content-box').removeClass('active');

                    $(this).addClass('active');
                    $("#" + tab_id).addClass('active');
                });


            });

            $(document).ready(function () {
                $('#example').DataTable(
                    {

                        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                        "iDisplayLength": 5,
                        "paging": false,


                    }
                );
                $('#example2').DataTable(
                    {

                        "paging": false,


                    }
                );
                $('#example3').DataTable(
                    {

                        "paging": false,


                    }
                );


            });


            $(document).ready(function () {
                $('.transfer-coin-btn > a').click(function () {
                    var tab_id = $(this).attr('data-tab');

                    $('.transfer-coin-btn > a').removeClass('active');
                    $('.transfer-coin-content-box').removeClass('active');

                    $(this).addClass('active');
                    $("#" + tab_id).addClass('active');
                });
                $('.lang-select').click(function (event) {
                    event.preventDefault();
                    var url = document.URL;
                    var lang = $(this).data("lang");
                    var current_lang = "{{LaravelLocalization::setLocale()}}";
                    if (lang != current_lang) {
                        var url = url.replace(current_lang, lang);
                        location.replace(url);
                    }

                });
                $(document).on("click", '.dropdown', function () {
                    $(this).attr('tabindex', 1).focus();
                    $(this).toggleClass('active');
                    $(this).find('.dropdown-menu').slideToggle(300);
                });
                $(document).on("focusout", '.dropdown', function () {
                    $(this).removeClass('active');
                    $(this).find('.dropdown-menu').slideUp(300);
                });

                $(document).on("click", '.dropdown .dropdown-menu li', function () {

                    $(this).parents('.dropdown').find('span').text($(this).text());
                    $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
                });


            });


            function checkAll(bx) {
                var cbs = document.getElementsByTagName('input');
                for (var i = 0; i < cbs.length; i++) {
                    if (cbs[i].type == 'checkbox') {
                        cbs[i].checked = bx.checked;
                    }
                }
            }

            function get_first_objectVal(obj) {
                return obj[Object.keys(obj)[0]]
            }

        </script>

        <script>
            function change_lang(lang_id) {
                jQuery(function ($) {
                    jQuery.ajax({
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                        },
                        url: '{{ URL::to("/change_language")}}',
                        type: "POST",
                        data: {"languages_id": lang_id, "_token": "{{ csrf_token() }}"},
                        success: function (res) {
                            window.location.replace(res);
                            // window.location.reload();
                        },
                    });
                });
            }
        </script>

    </div>
</div>
</body>

</html>
