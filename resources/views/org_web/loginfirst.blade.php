@extends('layouts.org_web.layout')

@section('keywords')
    @if(LaravelLocalization::getCurrentLocale()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}" />
    @endif
@endsection

@section('content')
    <!-- Login Section Starts -->
    <section class="login-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login-image">
                        <img src="{{asset('org_assets/dist/img/courseimg/login-image.jpg')}}" alt="image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login-form">
                        <h4> <span>الرجاء قم بتسجيل الدخول او انشاء حساب للتمتع بخدمات يمن تداول</span></h4>
{{--                        <div class="google-button">--}}
{{--                            <a href="#" class="template-button"><i class="fa fa-google"></i> google</a>--}}
{{--                        </div>--}}
                        <hr>
                        <div class="login-tab">
                            <div class="tab">
                                <ul>
                                    <li class="tab-one active">
                                        <a href="#" class="template-button-2">تسجيل الدخول</a>
                                    </li>
                                    <li class="tab-second">
                                        <a href="#" class="template-button-2">انشاء حساب</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="tab-content margin-top-30">
                            <div class="tab-one-content lost active">
                                <form method="POST" action="{{ route('login') }}">



                                    <div class="form-group">
                                        <label for="signupEmail"><i class="fa fa-envelope"></i>{{trans('lang.email')}}</label>
                                        <input type="email" id="email" class="@error('email') is-invalid @enderror" placeholder="{{trans('lang.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror



                                    <div class="form-group">
                                        <label for="password"><i class="fa fa-lock"></i> {{trans('lang.password')}}</label>
                                        <input type="password" id="password" placeholder="{{trans('lang.password')}}" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    </div>


                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                    <div class="checkbox-forgotpass-area">
                                        <div class="checkbox-part">
                                            <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember"> تذكرني</label>
                                        </div>
                                        <div class="forgotpass-part">
                                            <a href="#">نسيت كلمة المرور ؟</a>
                                        </div>
                                    </div>
                                    <div class="login-button margin-top-20">
                                        <button  type="submit" class="template-button">دخول</button>
{{--                                        <span>هل تملك حساب بالفعل ؟ <a href="login.html">دخول</a></span>--}}
                                    </div>
                                </form>
                            </div>
                            <div class="tab-second-content lost">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="signupName2"><i class="fa fa-user"></i> Your Name</label>
                                        <input type="name" id="signupName2" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="signupEmail2"><i class="fa fa-envelope"></i> Email Address</label>
                                        <input type="email" id="signupEmail2" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="signupPassword2"><i class="fa fa-lock"></i> Password</label>
                                        <input type="password" id="signupPassword2" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="signupConPassword2"><i class="fa fa-lock"></i> Confirm Password</label>
                                        <input type="password" id="signupConPassword2" placeholder="Confirm Password">
                                    </div>
                                    <div class="checkbox-forgotpass-area">
                                        <div class="checkbox-part">
                                            <input type="checkbox" id="signupRemember2">
                                            <label for="signupRemember2"> remember me</label>
                                        </div>
                                        <div class="forgotpass-part">
                                            <a href="#">forgot password?</a>
                                        </div>
                                    </div>
                                    <div class="login-button margin-top-20">
                                        <a href="#" class="template-button">login account</a>
                                        <span>already have an account? <a href="login.html">login</a></span>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
