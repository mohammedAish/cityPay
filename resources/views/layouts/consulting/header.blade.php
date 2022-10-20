<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدورات التدريبية</title>
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/rtl_header.css')}}">

    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61ff7d8555.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/animate.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/font-awesome.min.css')}}" >
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/icofont.css')}}" >
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/slick.css')}}" >
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/magnific-popup.css')}}" >
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/coursestyle.css')}}" >


    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/courses.min.css')}}">
    @if(LaravelLocalization::getCurrentLocale()=="en")

        <style>
            body{
                direction: ltr;
                text-align: left;
                font-family: "Almarai", sans-serif !important;
            }



            .btns{
                margin-left: 140px !important;

            }
            .margin{
                margin-left: 150px !important;
            }
            .accordion-wrapper .card .card-header a:after{
                margin-left: 320px;
            }
            .wallet-top-header-box{
                margin-left: 150px !important;
            }


        </style>

    @else

        <style>
            body{
                direction: rtl;
                text-align: right;
                font-family: "Almarai", sans-serif !important;

            }




            .btns{
                margin-right: 140px !important;

            }
            .margin{
                margin-right: 150px !important;
            }
            .accordion-wrapper .card .card-header a:after{
                margin-right: 320px;
            }
            .wallet-top-header-box{
                margin-right: 150px !important;
            }
            .course-page-content .header-search {
                float: left !important;
            }



        </style>



    @endif
    <style>
        .accordion-wrapper .card .card-header a{
            text-decoration: none;
        }
        .accordion-wrapper .card .card-body .single-course-video span, .accordion-wrapper .card .card-body .single-course-video a{
            text-decoration: none;
        }

        .wallet-top-header-box.user-top-detail {
            cursor: pointer;
            position: relative;
            margin-left: 20px;
        }
        .wallet-top-header-box.user-top-detail ul {
            position: absolute;
            top: 100%;
            margin: 16px 0px 0px;
            width: 150px !important;
            right: 0px;
            background-color: #fff;
            z-index: 1;
            box-shadow: 0px 0px 8px #ccc;
            display: none;
            text-align: center;
        }

        wallet-top-header-box .header-wallet-ico {
            font-size: 30px;
            position: absolute;
            top: 0px;
            left: 0px;
            color: #ccc;
        }
        .wallet-top-header-box .header-wallet-ico img {
            height: 35px;
            width: 35px;
            border-radius: 100%;
        }

        .profile-dropdown::before {
            bottom: 100%;
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-color: rgba(194, 225, 245, 0);
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px;
        }

        .wallet-top-header-box  a{
            color: #0c3850;
            text-decoration: none;
            text-align: center !important;

            padding-bottom: 3px;
            width: 100%;
        }



    </style>
        <script  src="{{asset('/org_assets/dist/js/jquery-2.2.4.min.js')}}"></script>



</head>


<body>
