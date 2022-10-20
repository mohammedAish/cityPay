@extends('layouts.org_web.layout')

@section('keywords')
    <meta name="keywords" content=" {{ isset($serviceItem->service_keyword)?$header->service_keyword:'تداول' }}"/>
@endsection

@section('content')

    <header class="inner-header no-overlay service-header service4" style="margin-top:6%;
            background: linear-gradient(to bottom, rgba(11,72,121,0.25), rgba(11,72,121,0.75)),url({{asset('/app/public/'.(isset($serviceItem->service_background)?$serviceItem->service_background:'1.jpg'))}});
            background-size: cover;
            background-position: bottom;">
        <div class="container">
            <div class="section-heading">
                <h1>{{isset($serviceItem->service_title)?$serviceItem->service_title:''}}</h1>
                <p>{!! $serviceItem->service_short_desc_title !!}</p>
                <button class="btn">

                    {{ __('site.subscribe') }}
                </button>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="inner-service-page">
        <section class="clients light">
            <div class="container">
                <div class="section-heading">
                    <h1>{{isset($serviceItem->service_sub_title)?$serviceItem->service_sub_title:''}}</h1>
                </div>
                <div class="row">
                    <p class="text-center">{!! isset($serviceItem->service_desc)?$serviceItem->service_desc:'' !!}</p>
                </div>
            <!--    <div class="slickSlider autoplay-slider">
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                </div>
                -->
            </div>
        </section>
        <section class="">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {{ __('site.service_features') }}
                    </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>

                <div class="row features">

                    @if(isset($service_features) && count($service_features)>0)
                        @foreach($service_features as $index =>$service_feature)
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card-grid">
                                    <div class="card-grid-content">
                                        <div class="feature">
                                            <span>{{ ++$index }}</span>
                                            <img src="{{asset('/org_assets/dist/img/svg/star-green.svg')}}" alt="">
                                        </div>
                                        <h5>{!! isset($service_feature->feature_title)?$service_feature->feature_title:'' !!}</h5>
                                        <p>{!! isset($service_feature->feature_desc)?$service_feature->feature_desc:'' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    @else

                        <h5>
                            {{ __('site.nofeatures') }}
                        </h5>

                    @endif


                </div>
            </div>
        </section>
        @if(! auth()->user())
            <section class="light login-service">
                <div class="container">
                    <div class="section-heading">
                        <h1>
                            {!! $serviceItem->login_title !!}
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">
                                {!! $serviceItem->login_desc !!}
                            </p>
                        </div>
                        <div class="col-sm-12 text-center btns">
                            <button class="btn" data-toggle="modal"
                                    data-target="#loginModal">{{ __('site.userLogin') }}</button>
                            <button class="btn register-btn" data-toggle="modal"
                                    data-target="#registerModal">{{ __('site.userRegister') }}</button>
                        </div>
                    </div>
                </div>
            </section>
    @endif

    <!-- login modal -->
        <div class="modal fade formModal" id="loginModal" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('site.userLogin') }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('org_assets/dist/img/svg/login.svg') }}">
                        <section class="login">
                            <form class="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">
                                        {{ __('site.email') }}

                                        <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="{{ __('site.enter email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('site.password') }}
                                        <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="{{ __('site.enter password') }}" required>
                                </div>
                                <div class="check">
                                    <div class="form-group form-check">
                                        <input name="remember-me" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="remember-me">
                                            {{ __('auth.RememberMe') }}
                                        </label>
                                    </div>
                                    <a data-toggle="modal"
                                       data-target="#restorePasswordModal">  {{ __('auth.Forgot Your Password?') }}</a>
                                </div>
                                <button type="submit" class="btn">
                                    {{ __('site.userLogin') }}
                                </button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- register modal -->
        <div class="modal fade formModal" id="registerModal" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('site.userRegister') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('org_assets/dist/img/svg/login.svg') }}">
                        <section class="register">
                            <form action="{{route('userRegister_post')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">{{ __('site.first_name') }} <sup>*</sup></label>
                                    <input type="text" class="form-control" name="first_name"
                                           placeholder="{{ __('site.Please enter your first_name ') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name"> {{ __('site.last_name') }} <sup>*</sup></label>
                                    <input type="text" class="form-control" name="last_name"
                                           placeholder=" {{ __('site.enter userName') }} " required>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('site.email') }} <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="{{ __('site.enter email') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="country">{{ __('site.country') }}</label>

                                        <select name="countries" id="countries" class="form-control countries_select">
                                            <option value="">اختر الدولة</option>
                                            @foreach ($countries as $id=>$name)
                                                <option value="{{  $id }}">{{$name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  {{--  <div class="col-sm-12 col-md-4 form-group">
                                        <label for="country">
                                            {{ __('site.usertype') }}
                                        </label>
                                        <select class="countries_select form-control" name="customer_type">
                                            <option value="customer" selected>{{__('site.userAccount')}}</option>
                                            <option value="consultant">{{__('site.marking')}}</option>
                                        </select>
                                    </div>--}}
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="phone_number">{{ __('site.phone') }}</label>
                                        <input type="tel" class="form-control" name="phone_number"
                                               placeholder="{{ __('site.enter your phone') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="whatsUp_Number">{{ __('site.whatsUp Number') }}</label>
                                        <input type="tel" class="form-control" name="whatsUp_Number"
                                               placeholder="{{ __('site.enter your whatsApp') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="facebook_Account"> {{ __('site.facebook Account') }}</label>
                                        <input type="url" class="form-control" name="facebook_Account"
                                               placeholder="{{ __('site.enter facebook_Account') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('site.password') }} <sup>*</sup></label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="{{ __('site.enter password') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('site.pass_confirm') }} <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="{{ __('site.pass_con_again') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">{{ __('site.not_robot') }} <sup>*</sup></label>
                                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                                        <div class="g-recaptcha"
                                             data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                        </div>
                                    @endif

                                </div>

                                <div class="check">
                                    <div class="form-group form-check">
                                        <input name="agree" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="forgot-password">
                                            {{ __('site.agree') }} <a
                                                    href="{{ route('privacyPolicy') }}">{{ __('site.rules') }}</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn">{{ __('site.userRegister') }}</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Footer -->
@endsection
