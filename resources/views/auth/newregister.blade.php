@extends('layouts.app')
@section('keywords')

    {{--seo--}}

@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CTPAY</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets_v3/assets/img/favicon.png" rel="icon">
    <link href="assets_v3/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- Vendor CSS Files -->
    <link href="assets_v3/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


    <link href="assets_v3/assets/css/Ltr.css" rel="stylesheet" />
    <link href="assets_v3/assets/css/login-ltr.css" rel="stylesheet" />
</head>

<body dir="rtl">

    <main>
        <section class="container-fluid style-rtl">
            <div class="row justify-content-around">
                <div class="col-md-5 style-container-form ">

                    <form class="style-container-form" action="{{ route('Register') }}">
                        <div class="text-center ">
                            <p class="TitleSigin pt-5">
                                Welcome To
                                <span> <img src="assets_v3/assets/img/logoFooter.png" class="img-fluid imglogo" /></span>
                            </p>
                            <p class="TitleText">Register</p>
                        </div>

                        <div class="form-group ">
                            <div class="inner-addon right-addon">
                                <i class="fas fa-user glyphicon"></i>
                                <input type="email" class="form-control input-style mb-3" placeholder="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inner-addon right-addon">
                                <i class="far fa-envelope glyphicon"></i>
                                <input type="email" class="form-control input-style mb-3" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inner-addon right-addon">
                                <i class="fas fa-key glyphicon"></i>
                                <input type="password" class="form-control input-style mb-3" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="inner-addon right-addon">
                                <i class="fas fa-key glyphicon"></i>
                                <input type="password" class="form-control input-style mb-3" placeholder="confirm password">
                            </div>
                        </div>

                        <button class="btn stylebtnSignin w-100   my-4" type="submit">
                           Register
                        </button>

                        <p class="text-register">
                            If you have an account?
                            <a href="https://ctpay.uk/en/register" class="style-quction-password">Login</a>
                        </p>

                    </form>

                </div>
                <div class="col-md-6   style-respinsvie ">
                    <img src="assets_v3/assets/img/Assetwith.png" class="img-fluid " />
                </div>
            </div>
        </section>




    </main>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="assets_v3/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_v3/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_v3/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_v3/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets_v3/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_v3/assets/vendor/php-email-form/validate.js"></script>


    <script src="assets_v3/assets/js/main.js"></script>

</body>

</html>

@endsection

