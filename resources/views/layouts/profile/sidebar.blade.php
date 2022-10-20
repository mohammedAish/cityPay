<div class="header-box">
    <div class="header-logo" style="padding-top: 28px;padding-bottom: 28px">
        <a href="{{url('/')}}">
            <img  src="{{asset('org_assets/dist/img/logo4.png')}}"  alt="logo">
        </a>
    </div>
    <div class="header-nav-menu">
        <i class="menu-responsive fas fa-bars"></i>
        <ul>
            <li class="active"><a href={{route('profile.dashboard')}}><i class="fas fa-tachometer-alt"></i> {{trans('lang.overview')}}</a></li>
            <li><a href={{route('profile_info')}}><i class="fas fa-cog"></i> {{trans('lang.account-setting')}} </a></li>

            <li ><a href={{url('/wallet/dashboard')}}><i class="fas fa-wallet"></i>{{trans('lang.my_wallet')}}</a></li>



            <li class="dropdown" style="width: 100%">

                <a href="#" class="dropdown-btn-invoice ">  {{trans('lang.orders')}}
                    <i class="fas fa-list"></i>

                </a>
                <i class="fa fa-caret-down"  style="color:#96a1b7;"></i>
                <div class="sidebar-invoice" >
                    <ul>
                        <li style="width: 100%; padding-bottom:0; padding-right: 0;padding-left: 0;">

                            <a href="{{route('profile.my_courses')}}">
                                <i class="fas fa-chalkboard-teacher" style="position:unset;margin: 5px"></i>
                                {{trans('lang.my-courses')}}</a> </li>
                        <li style="width: 100% ; padding-bottom:0; padding-right: 0;padding-left: 0;">

                            <a href="{{route('profile.my_cons')}}">
                                <i class="fas fa-hands-helping" style="position:unset;margin: 5px"></i>
                                {{trans('lang.my-consultants')}} </a> </li>
<!--                        <li style="width: 100% ; padding-bottom:0; padding-right: 0;padding-left: 0;">

                            <a href="{{route('cards.my_cards')}}">
                                <i class="fas fa-square" style="position:unset;margin: 5px"></i>
                                {{trans('lang.my-digital-cards')}}</a> </li>-->
                    </ul>
                </div>
            </li>


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
