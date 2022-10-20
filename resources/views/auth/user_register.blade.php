@extends('layouts.org_web.layout')

@section('keywords')
    @if(LaravelLocalization::getCurrentLocale()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}"/>
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}"/>
    @endif
@endsection

@section('content')
    <!-- Main content -->

    <main class="log" style="margin-top: 6%;">
        <div class="container">
            <div class="reg-container">
                @if (Session::has('flash_notification'))
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                @include('flash::message')
                            </div>
                        </div>
                    </div>
                @endif
                <section class="row form-type register">
                    <div class="col">
                        <form action="{{route('userRegister_post')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">{{ __('lang.first_name') }} <sup>*</sup></label>
                                <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}"
                                       placeholder="{{ __('lang.Please_enter_your_first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="userName"> {{ __('lang.last_name') }} <sup>*</sup></label>
                                <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}"
                                       placeholder=" {{ __('lang.enter_last_name') }} " required>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('site.email') }} <sup>*</sup></label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}"
                                       placeholder="{{ __('site.enter email') }}" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label for="countries">{{ __('site.country') }}</label>

                                    <select name="countries" id="countries" class="form-control">
                                        <option value=""> {{trans('lang.choose_country')}}</option>

                                        @foreach ($countries as $id=>$name)
                                            <option value="{{  $id }}">{{$name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label for="phone_number">{{ __('site.phone') }} <sup>*</sup></label>
                                    <input type="tel" class="form-control" name="phone"
                                           placeholder="{{ __('site.enter your phone') }}" required>
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label for="whatsapp_acc">{{ __('site.whatsUp Number') }}</label>
                                    <input type="tel" class="form-control" name="whatsapp_acc"
                                           placeholder="{{ __('site.enter your whatsApp') }}">
                                </div>
                                <div class="col-sm-12 col-md-4 form-group">
                                    <label for="facebook_acc"> {{ __('site.facebook Account') }}</label>
                                    <input type="url" class="form-control" name="facebook_acc"
                                           placeholder="{{ __('site.enter facebook_Account') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('site.password') }} <sup>*</sup></label>
                                <input id="password" type="password" class="form-control" name="password"
                                       autocomplete="off" placeholder="{{ __('site.enter password') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">{{ __('site.pass_confirm') }} <sup>*</sup></label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       autocomplete="off" placeholder="{{ __('site.pass_con_again') }}" required>
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
                                <div class="form-group form-check d-flex flex-row">
                                    <input name="agree" type="checkbox" class="form-check-input" style="width: 50px;">
                                    <label class="form-check-label" for="forgot-password">
                                        {{ __('site.agree') }} <a
                                                href="{{ route('privacyPolicy') }}">{{ __('site.rules') }}</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn">{{ __('site.userRegister') }}</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>


        <!-- Restore password modal -->
        <div class="modal fade" id="restorePasswordModal" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="restorePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('site.resetpass') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('/org_assets/dist/img/svg/restoreEmail.svg')}}">
                        <form class="forget-form" action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('site.uremail') }}</label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="{{ __('site.enter your email') }}"
                                       autofocus value="{{old('email')}}">
                            </div>
                            <button type="submit" class="btn">{{ __('site.Send') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Footer -->



    <script>
        $(document).ready(function () {
            $('.countries_select').select2({
                placeholder: "اختر",
                allowClear: true
            });
            $('.select2').addClass('form-control');
        });
    </script>
    <style>
        .reg-container {
            padding: 2% 15%;
            border-radius: 5px;
            text-align: right;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1)
        }
    </style>
@endsection
