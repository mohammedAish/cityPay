@extends('layouts.org_web.layout')

@section('keywords')
    <meta name="keywords" content=" {{ isset($serviceItem->service_keyword)?$header->service_keyword:'تداول' }}" />
@endsection

@section('content')

    <header class="inner-header no-overlay service-header service4" style="margin-top:6%;
        background: linear-gradient(to bottom, rgba(11,72,121,0.25), rgba(11,72,121,0.75)),url({{asset('/app/public/'.(isset($serviceItem->service_background)?$serviceItem->service_background:'1.jpg'))}});
        background-size: cover;
        background-position: bottom;">
        <div class="container">
            <div class="section-heading">
                <h1>{{$service->name}}</h1>
                <p>{!! $service->short_description !!}</p>
                <button class="btn">

                    {{ __('site.subscribe') }}
                </button>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="inner-service-page">
        <section class="clients light">
            <div class="container">
                <div class="section-heading">
                    <h1>{{$service->name}}</h1>
                </div>
                <div class="row">
                    <p class="text-center">{{$service->description}}</p>
                </div>
            <!--    <div class="slickSlider autoplay-slider">
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                </div>
                -->
            </div>
        </section>
        <section class="">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {{ __('site.service_features') }}
                    </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>

{{--                <div class="row features">--}}

{{--                    @if(isset($service) && count($service_features)>0)--}}
{{--                        @foreach($service_features as $index =>$service_feature)--}}
{{--                            <div class="col-sm-12 col-md-6 col-lg-4">--}}
{{--                                <div class="card-grid">--}}
{{--                                    <div class="card-grid-content">--}}
{{--                                        <div class="feature">--}}
{{--                                            <span>{{ ++$index }}</span>--}}
{{--                                            <img src="{{asset('/org_assets/dist/img/svg/star-green.svg')}}" alt="">--}}
{{--                                        </div>--}}
{{--                                        <h5>{!! isset($service_feature->feature_title)?$service_feature->feature_title:'' !!}</h5>--}}
{{--                                        <p>{!! isset($service_feature->feature_desc)?$service_feature->feature_desc:'' !!}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}


{{--                    @else--}}

{{--                        <h5>--}}
{{--                            {{ __('site.nofeatures') }}--}}
{{--                        </h5>--}}

{{--                    @endif--}}


{{--                </div>--}}
            </div>
        </section>

        <section class="light login-service">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {!! $service->login_title !!}
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">
                            {!! $service->login_desc !!}
                        </p>
                    </div>
                    <div class="col-sm-12 text-center btns">
                        <button class="btn" data-toggle="modal" data-target="#loginModal">{{ __('site.userLogin') }}</button>
                        <button class="btn register-btn" data-toggle="modal" data-target="#registerModal">{{ __('site.userRegister') }}</button>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- Footer -->
@endsection
