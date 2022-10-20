<div class="wallet-area-right">
    <div class="wallet-top-header  clearfix">
        <div class="wallet-top-header-left">
            <div class="wallet-top-header-box">
                <div class="header-wallet-ico" style="color: #87d682;"><i class="zmdi zmdi-balance-wallet  "
                                                                          style="font-size: 45px;color: #e21d38"></i>
                </div>

                <h5 style="color: #e21d38; padding-top: 10px"><a href="{{url('wallet/dashboard')}}"
                                                                 style="color: #e21d38;">{{trans('lang.my_wallet')}}</a>
                </h5>
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
                        <h4 style="font-size: 25px;display: inline"><i class="fas fa-globe "></i></h4> <i
                                class="fas fa-caret-down"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <div class="dropdown-menu">
                        <ul class="language-dropdown">

                            <li>
                                <a onclick="change_lang('en')" class="lang-br lang-select" data-lang="en">
                                    <h4 style="display: inline"><img class="flag-img"
                                                                     src="{{asset('org_assets/dist/img/walletimages/flag/us.png')}}"
                                                                     alt="USA"></h4>English
                                </a>
                            </li>
                            <li>
                                <a onclick="change_lang('ar')" class="lang-br lang-select" data-lang="ar">
                                    <h4 style="display: inline"><img class="flag-img"
                                                                     src="{{asset('org_assets/dist/img/walletimages/flag/ae.png')}}"
                                                                     alt="عربي"></h4>عربي
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="wallet-top-header-box user-top-detail">
                <div class="header-wallet-ico"><img id="prfile_image_nav"
                                                    src="{{isset(auth()->user()->img_profile)?url(auth()->user()->img_profile):''}}"
                                                    alt=""></div>
                <h3>{{auth('customers')->user()->first_name}} <i class="fas fa-chevron-down"
                                                                 style="padding-top:25px "></i></h3>
                <ul class="profile-dropdown">
                    <li><a href="{{route('profile.dashboard')}}"><i
                                    class="fas fa-user"></i> {{trans('lang.my_profile')}}</a></li>
                    <li><a href="{{url('wallet/dashboard')}}"><i class="fas fa-wallet"></i> {{trans('lang.my_wallet')}}
                        </a></li>
                    <li><a href="{{route("logout")}}"><i class="fas fa-sign-out-alt"></i>{{trans('lang.logout')}}</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>


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
