<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدورات التدريبية</title>

        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/rtl_header.css')}}">
       <link rel="stylesheet" href="{{asset('/org_assets/dist/css/animate.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/font-awesome.min.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/icofont.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/slick.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/magnific-popup.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/barfiller.css')}}" >
        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/coursestyle.css')}}" >

        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/61ff7d8555.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="{{asset('/org_assets/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/courses.min.css')}}">
        @if(LaravelLocalization::getCurrentLocale()=="en")


            <link rel="stylesheet" href="{{asset('/org_assets/dist/css/course_en.css')}}">


        @else

            <link rel="stylesheet" href="{{asset('/org_assets/dist/css/course_ar.css')}}">

        @endif

        <style>
    #example_wrapper .row {
        display: block !important;
    }
</style>

        <script src= "{{asset('/org_assets/dist/js/jquery-2.2.4.min.js')}}"></script>


</head>
<body>

