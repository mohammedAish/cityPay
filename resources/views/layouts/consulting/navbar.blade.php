<!-- Navbars -->
<!-- me -->
<nav class="main-nav navbar navbar-expand-xl navbar-light fixed-top" style="background: aliceblue;">
    @include('org_web.msg')
    <div class="container" style="padding-top: 3px; padding-bottom: 3px;">


        <div class="site-top-header-left">


            <div class="site-top-header-box">
                <a class="navbar-brand" href="{{route('index')}}">
                    @php $logo='logo2.png'; @endphp

                    <img src="{{asset('org_assets/dist/img/logo4.png')}}"
                         alt="{{isset($header->website_title)?$header->website_title:"يمن تداول شارت الدولية المحدودة"}}" style="height:60px; ">
                </a>


            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarMenu" style=" margin-left: 80px;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('aboutus')}}">{{ __('site.about_company') }}<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('news')}}">{{ __('site.news') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('services.main')}}">{{ __('site.services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('offers')}}">{{ __('site.offers') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blog')}}">{{ __('site.blog') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('site.ploicies') }}
                    </a>



                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('privacyPolicy')}}">{{ __('site.privacyPolicy') }} </a>
                        <a class="dropdown-item" href="{{route('accessPolicy')}}"> {{ __('site.accessPolicy') }}</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">{{ __('site.contact') }} </a>
                </li>

            </ul>



        </div>


        <div class="site-top-header-right">
            <!--wallet-->
            @if(auth()->id() !==null)
                <div class="message-box-area">
                    <a href="{{route('wallet.dashboard')}}" class="btn" style="background-color: #0b4879">
                        <div class="message-box " >

                            {{trans('lang.my_wallet')}}

                        </div>
                    </a>
                </div>
            @else
                <div class="message-box-area">
                    <a href="{{url('login')}}" class="btn" style="background-color: #0b4879">
                        <div class="message-box " >

                            {{trans('lang.my_wallet')}}

                        </div>
                    </a>
                </div>
            @endif
            <div class="notification-box-area">
                <div class="language-box dropdown-toggle" id="langDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                    <i class="fas fa-globe" style="color: #0b4879;"></i>

                </div>

                <div class="dropdown-menu " aria-labelledby="langDropdown">
                    <a class="dropdown-item" onclick="change_lang('ar')"
                       href="#">{{trans('lang.arabic')}}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="change_lang('en')"
                       href="#">{{trans('lang.english')}}</a>
                </div>

            </div>

            {{--            <div class="notification-box-area">--}}
            {{--                <div class="notification-box">--}}
            {{--                    <i class="fas fa-bell"></i>--}}
            {{--                    <span class="notification-active"></span>--}}
            {{--                </div>--}}
            {{--                <div class="notification-dropdown">--}}
            {{--                    <div class="notification-header">--}}
            {{--                        <h3>{{trans('lang.you_have')}} <strong>3</strong> {{trans('lang.new_notifications')}}.</h3>--}}
            {{--                    </div>--}}
            {{--                    <ul class="notification-list">--}}
            {{--                        <li class="notification-success">--}}
            {{--                            <div class="notification-icon"><i class="fas fa-check-circle"></i></div>--}}
            {{--                            <div class="notification-content">--}}
            {{--                                <h3>Successful transaction of 0.01 BTC</h3>--}}
            {{--                                <h4>15 mins ago</h4>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="notification-pending">--}}
            {{--                            <div class="notification-icon"><i class="fas fa-exclamation-circle"></i></div>--}}
            {{--                            <div class="notification-content">--}}
            {{--                                <h3>4 of Pending Transactions!</h3>--}}
            {{--                                <h4>45 mins ago</h4>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="notification-cancel read-notification">--}}
            {{--                            <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
            {{--                            <div class="notification-content">--}}
            {{--                                <h3>Cancelled Transaction of 20 BTC</h3>--}}
            {{--                                <h4>1 hour ago</h4>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="notification-cancel read-notification">--}}
            {{--                            <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
            {{--                            <div class="notification-content">--}}
            {{--                                <h3>Cancelled Transaction of 5 BTC</h3>--}}
            {{--                                <h4>1 hour ago</h4>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                        <li class="notification-cancel read-notification">--}}
            {{--                            <div class="notification-icon"><i class="fas fa-times-circle"></i></div>--}}
            {{--                            <div class="notification-content">--}}
            {{--                                <h3>Cancelled Transaction of 30 BTC</h3>--}}
            {{--                                <h4>1 hour ago</h4>--}}
            {{--                            </div>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                    <div class="notification-footer">--}}
            {{--                        <a href="JavaScript:Void(0)">{{trans('lang.Read_All_Notifications')}}</a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}




{{--            <div class="message-box-area">--}}
{{--                <a href="#">--}}
{{--                    <div class="message-box">--}}

{{--                        <i class="fas fa-shopping-cart"></i>--}}
{{--                        --}}{{--                        <span class="message-active "></span>--}}

{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}




            @if(auth()->id() !==null)
                <div class="site-top-header-box user-top-detail">
                    <div class="header-site-ico"><img  src="{{asset('org_assets/dist/img/walletimages/user-placeholder.jpg')}}" alt="Profile"></div>
                    <h3>{{auth('customers')->user()->first_name}} <i class="fas fa-chevron-down" style="margin-top: 25px;"></i></h3>
                    <ul class="profile-dropdown">
                        <li><a href="{{route('profile.dashboard')}}"><i class="fas fa-user"></i> {{trans('lang.my_profile')}}</a></li>
                        <li><a href="{{route('wallet.dashboard')}}"><i class="fas fa-wallet"></i> {{trans('lang.my_wallet')}}</a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt"></i>{{trans('lang.logout')}}</a></li>
                    </ul>
                </div>
            @else

                <div class="site-top-header-box user-top-detail">
                    <div class="header-site-ico"><img  src="{{asset('org_assets/dist/img/walletimages/user-placeholder.jpg')}}" alt="Profile"></div>
                    <h3> <i class="fas fa-chevron-down" style="margin-top: 25px;"></i></h3>
                    <ul class="profile-dropdown" style="width: 180px !important;">
                        <li><a href="{{url('login')}}" class="btn" style="background-color: #0b4879 ; color:white;margin: 5px;"><i class="fas fa-user" style=" padding: 5px"></i>تسجيل الدخول</a></li>
                        <li><a href="{{route('userRegister')}}" class="btn" style="background-color: #0b9444;color: white;margin: 5px;"><i class="fas fa-wallet" style=" padding: 5px"></i> انشاء حساب</a></li>
                    </ul>
                </div>

            @endif

        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>


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



