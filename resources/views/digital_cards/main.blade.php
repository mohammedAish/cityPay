@extends('layouts.org_web.layout')
@section('content')


    <!-- Categorry Section Starts -->
    <section class="category-section" style="margin-top: 6%">
        <div class="container">
            <div class="popular-course-slider slickSlider mt-4">
                @foreach($CardsProviders as $CardsProvider)
                <a href="{{route('cards.category',$CardsProvider->id)}}" class="category-card m-2">
                    <img  src="{{config('app.url').$CardsProvider->img_path}}" width="150px;"  class="rounded-circle p-2 p-2" alt="img">

                </a>
                @endforeach

            </div>


        </div>
    </section>
    <section>

        <div class="container">
            <div class="row col-md-12">
            <div class="col-lg-2 col-md-4 " >
                <div class="single-course-item">
                    <a href="#">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                        </div>
                    </a>
                    <div class="course-content margin-top-20 text-center">
                        <div class="course-title">
                            <h4>قوقل بلاي </h4>
                        </div>


                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-big">$ 400.00</span>
                            </div>

                        </div>
                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-cross">$ 500.00</span>
                            </div>

                        </div>
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
            </div>
            <div class="col-lg-2 col-md-4 " >
                <div class="single-course-item">
                    <a href="#">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                        </div>
                    </a>
                    <div class="course-content margin-top-20 text-center">
                        <div class="course-title">
                            <h4>قوقل بلاي </h4>
                        </div>


                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-big">$ 400.00</span>
                            </div>

                        </div>
                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-cross">$ 500.00</span>
                            </div>

                        </div>
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
            </div>
            <div class="col-lg-2 col-md-4 " >
                <div class="single-course-item">
                    <a href="#">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                        </div>
                    </a>
                    <div class="course-content margin-top-20 text-center">
                        <div class="course-title">
                            <h4>قوقل بلاي </h4>
                        </div>


                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-big">$ 400.00</span>
                            </div>

                        </div>
                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-cross">$ 500.00</span>
                            </div>

                        </div>
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
            </div>
            <div class="col-lg-2 col-md-4 " >
                <div class="single-course-item">
                    <a href="#">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                        </div>
                    </a>
                    <div class="course-content margin-top-20 text-center">
                        <div class="course-title">
                            <h4>قوقل بلاي </h4>
                        </div>


                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-big">$ 400.00</span>
                            </div>

                        </div>
                        <div class=" margin-top-10 text-center">
                            <div class="course-price">
                                <span class="span-cross">$ 500.00</span>
                            </div>

                        </div>
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
            </div>
                <div class="col-lg-2 col-md-4 " >
                    <div class="single-course-item">
                        <a href="#">
                            <div class="course-image">
                                <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                            </div>
                        </a>
                        <div class="course-content margin-top-20 text-center">
                            <div class="course-title">
                                <h4>قوقل بلاي </h4>
                            </div>


                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                </div>

                            </div>
                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-cross">$ 500.00</span>
                                </div>

                            </div>
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
                </div>
                <div class="col-lg-2 col-md-4 " >
                    <div class="single-course-item">
                        <a href="#">
                            <div class="course-image">
                                <img src="{{asset('/org_assets/dist/img/DC/playstaion.jpg')}}"  alt="image" width="100%">
                            </div>
                        </a>
                        <div class="course-content margin-top-20 text-center">
                            <div class="course-title">
                                <h4>قوقل بلاي </h4>
                            </div>


                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                </div>

                            </div>
                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-cross">$ 500.00</span>
                                </div>

                            </div>
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
                </div>

            </div>
            @foreach($CardsProviders as $CardsProvider)
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h4> <span>{{$CardsProvider->name}}</span></h4>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="row col-md-12">
                @foreach($CardsProvider->digitalCards as $card )

                <div class="col-lg-2 col-md-4 " >
                    <div class="single-course-item">
                        <a href="{{route('cards.detail',$card->id)}}">
                            <div class="course-image">
                                <img src="{{config('app.url').$card->img_path}}"  alt="image" width="100%">
                            </div>
                        </a>
                        <div class="course-content margin-top-20 text-center">
                            <div class="course-title">
                                <h4>{{$card->name}}</h4>
                            </div>


                            <div class=" margin-top-10 text-center">
                                <div class="course-price">
                                    <span class="span-big">{{$card->price}}</span>
                                </div>

                            </div>

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
                </div>

                @endforeach

            </div>
            @endforeach

        </div>

    </section>


@endsection
