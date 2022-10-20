@extends('home.index')
@section('keywords')

    {{--seo--}}

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
                                    <div class="hero-left margin-10 padding-10">
                                        @if (session('resent'))
                                            <div class="alert " role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                        @endif
                                        <div class="account-form m-5">
                                            <form method="POST" action="{{ route('verification.resend') }}" class="row">
                                                @csrf
                                                <p> {{ __(' Before log in , please check your email for a verification link,') }}
                                                    {{ __(' If you did not receive the email') }},</p>
                                                <br>
                                                <button type="submit"
                                                        class="bttn-mid btn-fill w-100"> {{ __('click here to request another') }}</button>
                                            </form>
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
