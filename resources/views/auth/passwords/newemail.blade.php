@extends('home.index')
@section('keywords')

    @if(LaravelLocalization::getCurrentLocale()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}"/>
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}"/>
    @endif

@endsection
@section('content')
    <!--Hero Area-->
    <section class="hero-section">
        <div class="hero-area wave-animation">
            <div class="single-hero gradient-overlay">
                <div id="particles-js"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left">
                                        <h2>{{__('lang.forget_password')}}</h2>
                                        <div class="account-form">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <form method="POST" action="{{ route('password.email') }}" class="row">
                                                @csrf
                                                <div class="col-xl-12 col-lg-12">
                                                    <label class="text-white">{{ __('lang.email') }}</label>
                                                    <input type="email"  id="email"
                                                      class="@error('email') is-invalid @enderror"
                                                           name="email"
                                                    value="{{ old('email') }}"
                                                    required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong class="bg-red">{{ $message }}</strong>
                                    </span> @enderror
                                                </div>
                                                <button type="submit"
                                                        class="bttn-mid btn-fill w-100">   {{ __('lang.Send_Password_Reset_Link') }}</button>
                                            </form>
                                            <div class="extra-links">
                                                <a href="{{route('login')}}">{{__('lang.back_to_login')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Hero Area-->

@stop
