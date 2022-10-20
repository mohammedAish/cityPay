<div class="header-box">
    <div class="header-logo">
        <a href={{url('/')}}>
        <img  src="{{asset('org_assets/dist/img/ctp.png')}}"  alt="logo">
        </a>
    </div>
    <div class="header-nav-menu">
        <i class="menu-responsive fas fa-bars"></i>
        <ul>
            <li class="active"><a href={{url('/wallet/dashboard')}}><i class="fas fa-tachometer-alt"></i> {{trans('lang.Dashboard')}}</a></li>
            <li><a href={{url('/account/profile/dashboard')}}><i class="fas fa-user"></i> {{trans('lang.profile')}} </a></li>

            <li ><a href={{url('/wallet/my_accounts')}}><i class="fas fa-building"></i>{{trans('lang.my-financial-accounts')}}</a></li>

{{--
            <li ><a href={{route('cards.list_categories')}}><i class="fas fa-ticket-alt"></i> {{trans('lang.digital_cards')}}</a></li>
--}}
            <li ><a href={{url('/wallet/deposit')}}><i class="fas fa-plus"></i> {{trans('lang.deposit')}}</a></li>
            <li ><a href={{url('/wallet/withdraw2')}}><i class="fas fa-minus"></i> {{trans('lang.withdraw')}}</a></li>

            <li ><a href={{url('/wallet/currencies')}}><i class="fas fa-money-bill-alt"></i>{{trans('lang.currency-exchange')}}</a></li>
            <li ><a href={{url('/wallet/paying_order')}}><i class="fas fa-file-invoice"></i>{{trans('lang.pay-purchase-bills')}}</a></li>
            <li ><a href={{url('/wallet/pull_earning')}}><i class="fas fa-hands-helping"></i>{{trans('lang.freelancing-withdraw')}}</a></li>
            <li><a href={{route("list_deposit_withdraws")}}><i class="fas fa-history"></i>  {{trans('lang.transactions')}} </a></li>
{{--
            <li><a href={{route("cards.my_cards")}}><i class="fas fa-credit-card"></i>  {{trans('lang.my-digital-cards')}} </a></li>
--}}
            <li><a href={{url('/')}}><i class="fas fa-globe"></i> {{trans('lang.back-to-website')}} </a></li>

        </ul>


        <div class="theme-color-swith">
            <a href="JavaScript:Void(0)" onclick="changeMode()">Dark Mode</a>
            <label class="switch">
                <input type="checkbox" id="theme-change" >
                <span class="slider round"></span>
            </label>
        </div>
    </div>
</div>

