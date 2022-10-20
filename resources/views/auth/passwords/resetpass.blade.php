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
            <section class="log-container" style="width: 50%;margin: auto;padding-left: 100px;padding-right: 100px">
                <div class="content">
                    <div class="row log-nav">
                        <div class="col">
                            <div class="log-title active">
                                <i class="fas fa-lock"></i>
                                <span>{{ __('lang.reset_password') }}</span>
                            </div>
                        </div>

                    </div>
                    <section class="row form-type active login">
                        <div class="col">
                            <form class="login-form" method="POST" action="{{route('password.update') }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                @csrf
                                <div class="form-group">
                                    <label for="email">
                                        {{ __('site.email') }}

                                        <sup>*</sup></label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="" autocomplete="email" autofocus
                                           placeholder="{{ __('site.enter email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('lang.new_password') }}
                                        <sup>*</sup></label>
                                    <input placeholder="{{ __('lang.new_enter_password') }}" id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('lang.confirm_password') }}
                                        <sup>*</sup></label>
                                    <input placeholder="{{ __('lang.reenter_password') }}" id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn">
                                    {{ __('lang.reset_password') }}
                                </button>

                            </form>
                        </div>
                    </section>



                </div>
            </section>
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
@endsection
