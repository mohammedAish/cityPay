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


                    <section class="row form-type active login">
                        <div class="col">
                            <form class="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">
                                        {{ __('site.email') }}

                                        <sup>*</sup></label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" autocomplete="email" autofocus
                                           placeholder="{{ __('site.enter email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('site.password') }}
                                        <sup>*</sup></label>
                                    <input placeholder="{{ __('site.enter password') }}" id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="check">
                                    <div class="form-group form-check">
                                        <input name="remember" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="remember">
                                            {{ __('auth.RememberMe') }}
                                        </label>
                                    </div>
                                    <a data-toggle="modal"
                                       data-target="#restorePasswordModal">  {{ __('auth.Forgot Your Password?') }}</a>
                                </div>
                                <button type="submit" class="btn">
                                    {{ __('site.userLogin') }}
                                </button>
                                {{--                                @if (Route::has('password.request'))--}}
                                {{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                {{--                                        {{ __('Forgot Your Password?') }}--}}
                                {{--                                    </a>--}}
                                {{--                                @endif--}}
                            </form>
                        </div>
                    </section>

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
@endsection
