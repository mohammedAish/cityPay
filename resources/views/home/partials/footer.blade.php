@php
    $rnm = Request::route()->getName();
    $sp = explode('.',$rnm);

    $arr= ['user','express','invoice']
@endphp

@if(!in_array($sp[0],$arr))

    <footer class="footer-area section-padding-2 theme-bg wave-animation pb-0">
        <div class="container">
            <div class="row mb-0 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="footer-widget">
                        <a href=""><img src="{{get_image(config('constants.logoIcon.path') .'/logo.png')}}" alt=""></a>
                        <p>{{__($shortAbout->value->web_footer)}}</p>
                        <div class="social">
                            @foreach($socials as $data)
                                <a href="{{$data->value->url}}" target="_blank" class="cl-facebook"
                                   title="{{$data->value->title}}">@php echo $data->value->icon @endphp</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="footer-widget ">
                                <div class="m-app">
                                    <a href=""><i class="fab fa-apple"></i>@lang('App Store')</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-widget ">
                                <div class="m-app">
                                    <a href=""><i class="fa fa-play"></i>@lang('Google Play')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
<!--        <div class="footer-bottom-section" style="border-top: 1px solid #fff; padding-top 10px">
            <div class="container">
                <div class="row py-4 justify-content-around">
                    <div class="col-xl-6  cl-white copyright ">
                        <p class="mb-0 text-md-center text-xl-left">@lang('Copyright') &copy; {{date('Y')}}
                            - {{__($general->sitename)}}
                            . @lang('All Rights Reserved.')</p>
                    </div>
                    <div class="col-xl-6  cl-white copyright ">
                        <div class="footer-widget footer-nav text-md-center float-xl-right mb-0">

                        </div>
                    </div>

                </div>
            </div>
        </div>-->
    </footer>




@else

    <!--Footer Area-->
<!--    <footer class="footer-area py-4 theme-bg wave-animation" style="border-top: 1px solid #fff;">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-xl-6  cl-white copyright ">
                    <p class="mb-0 text-md-center text-xl-left">@lang('Copyright') &copy; {{date('Y')}}
                        - {{__($general->sitename)}}
                        . @lang('All Rights Reserved.')</p>
                </div>
                <div class="col-xl-6  cl-white copyright ">
                    <div class="footer-widget footer-nav text-md-center float-xl-right mb-0">

                    </div>
                </div>

            </div>
        </div>
    </footer>&lt;!&ndash;/Footer Area&ndash;&gt;-->
@endif

