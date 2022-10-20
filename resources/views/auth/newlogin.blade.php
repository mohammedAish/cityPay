<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CTPAY</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets_v3/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets_v3/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_v3/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_v3/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_v3/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_v3/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_v3/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets_v3/assets/css/Ltr.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_v3/assets/css/login-ltr.css') }}" rel="stylesheet" />

</head>

<body>

    <main>

    <section class="container-fluid  style-rtl">

    <div class="row justify-content-around">
    <div class="col-md-5 style-container-form ">
        
    <form method="POST" class="style-container-form" action="{{ route('login') }}">
    @csrf
                    <div class="text-center ">
                            <p class="TitleSigin pt-5">
                                Welcome To
                                <span> <img src="{{ asset('assets_v3/assets/img/logoFooter.png') }}" class="img-fluid imglogo" /></span>
                            </p>
                            <p class="TitleText">Login</p>

                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        </div>

                        <div class="form-group pt-4">
                        <div class="inner-addon right-addon">
                        <i class="far fa-envelope glyphicon"></i>
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" class="form-control input-style mb-4" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="inner-addon right-addon">
                        <i class="fas fa-user-lock glyphicon"></i>
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control input-style mb-4" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-between">
                          
                        @if (Route::has('password.request'))
                                    <a class="text-register" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    <a href="https://ctpay.uk/en/register" class="style-quction-password">Register</a>
                                @endif

                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="defaultUnchecked">
                                        {{ __('Remember Me') }}
                                    </label>
                               
                         
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn stylebtnSignin w-100   my-4">
                                    {{ __('Login') }}
                                </button>
                                
                            </div>
                            
                        </div> 
                    
                </div>
            
        </form>

        <div class="col-md-6  pt-5 style-respinsvie ">
                    <img src="{{ asset('assets_v3/assets/img/Login.png') }}" class="img-fluid " />

                </div>
    </div>
    
</div>
</section>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<script src="{{ asset('assets_v3/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets_v3/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets_v3/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets_v3/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets_v3/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets_v3/assets/vendor/php-email-form/validate.js') }}"></script>


<script src="{{ asset('assets_v3/assets/js/main.js') }}"></script>

</body>

</html>


