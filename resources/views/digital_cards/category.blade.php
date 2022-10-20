@extends('layouts.org_web.layout')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section" style="margin-top: 6%;">
        <div class="breadcrumb-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/logo0.png')}}" style="width: 70px; !important;" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$Cards_cat->name}}  </h2>
                    <div class="breadcrumb-link margin-top-10">
                        {{--                        <span><a href="index.html">home</a> / cart page</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h4> <span>{{$Cards_cat->description}} </span></h4>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row col-md-12">
                @foreach($Cards_cat->digitalCards as $card)
                <div class="col-lg-2 col-md-4 " >
                    <a href="{{route('cards.detail',$card->id)}}">
                    <div class="single-course-item">

                            <div class="course-image">
                                <img src="{{config('app.url').$card->img_path}}"  alt="image" width="100%">
                            </div>

                        <div class="course-content margin-top-20 text-center">
                            <div class="course-title">
                                <h4>{{$card->name}} </h4>
                            </div>


                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-big">{{$card->price}}</span>
                                </div>

                            </div>
{{--                            <div class=" margin-top-10 text-center">--}}
{{--                                <div class="course-price">--}}
{{--                                    <span class="span-cross">$ 500.00</span>--}}
{{--                                </div>--}}

{{--                            </div>--}}
                            <div class="preview-button margin-top-5">

                                <a href="#" class="template-button margin-left-10" style="width: 100%;">
                                    <i class="fas fa-shopping-cart"></i>
                                    اضافة الى السلة

                                </a>
                            </div>
                            {{--                <div class="preview-button margin-top-10">--}}
                            {{--                    <a href="#" class="template-button margin-left-10" style="width: 100%;"> التفاصيل </a>--}}
                            {{--                </div>--}}
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach


            </div>

        </div>

    </section>


@endsection
