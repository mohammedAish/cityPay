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
                                    <div class="hero-left">
                                        <h2>Forgot Password</h2>
                                        <div class="account-form">
                                            <form action="#" method="post" class="row">
                                                @csrf
                                                <input type="hidden" name="email" value="">


                                                <div class="col-xl-12 col-lg-12">
                                                    <label class="text-white">Verification Code</label>
                                                    <input type="text" name="code" id="pincode-input" class="magic-label">
                                                </div>
                                                <button type="submit" class="bttn-mid btn-fill w-100"> Verify Code</button>
                                            </form>
                                            <div class="extra-links">
                                                <a href="#">Try to send again</a>
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





