<div class="header-box">
    <div class="header-logo"  style="padding-top: 28px;padding-bottom: 28px">
        <img  src="{{asset('org_assets/dist/img/logo4.png')}}"  alt="logo">
    </div>
    <div class="header-nav-menu">
        <i class="menu-responsive fas fa-bars"></i>
        <ul>
            <li class="active"><a href={{url('trading/dashboard')}}><i class="fas fa-tachometer-alt"></i> {{trans('lang.overview')}}</a></li>
            <li><a href={{route('profile.dashboard')}}><i class="fas fa-user"></i> {{trans('lang.profile')}} </a></li>

            <li ><a href={{url('/trading/trading-accounts')}}><i class="zmdi zmdi-accounts-list"></i>حسابات التداول </a></li>
            <li ><a href={{url('/trading/services')}}><i class="zmdi zmdi-star-circle"></i>ادارة اشتراك الخدمات </a></li>
            <li ><a href="#"><i class="zmdi zmdi-eye"></i>التداول الحي </a></li>
            <li ><a href={{url('/trading/copy-trading')}}><i class="zmdi zmdi-copy"></i>نسخ التداول </a></li>
            <li ><a href="{{url('/trading/cashback')}}"><i class="zmdi zmdi-money"></i>الكاش باك </a></li>
            <li ><a href="#"><i class="zmdi zmdi-chart"></i> التوصيات والتحليلات </a></li>





            <li><a href={{url('/home')}}><i class="fas fa-globe"></i> {{trans('lang.back-to-website')}} </a></li>

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

