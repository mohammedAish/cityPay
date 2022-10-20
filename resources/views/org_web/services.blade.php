@extends('layouts.org_web.layout')

@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords"
              content=" {{ isset($header->services_keyword_en)?$header->services_keyword_en:'تداول' }}"/>
    @else
        <meta name="keywords" content=" {{ isset($header->services_keyword)?$header->services_keyword:'تداول' }}"/>
    @endif
@endsection

@section('content')
    <header class="inner-header" style="margin-top: 6%;
            background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url({{asset('/app/public/'.(isset($page_setups->services_background)?$page_setups->services_background:'1.jpg'))}});
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;">
        <div class="section-heading">
            @if(current_local()=="en")
                <h1>{{isset($page_setups->services_title_en)?$page_setups->services_title_en:''}}</h1>
                <p>{{isset($page_setups->services_sub_title_en)?$page_setups->services_sub_title_en:''}}</p>
            @else
                <h1>{{isset($page_setups->services_title)?$page_setups->services_title:''}}</h1>
                <p>{{isset($page_setups->services_sub_title)?$page_setups->services_sub_title:''}}</p>
            @endif

        </div>
    </header>

    <!-- Main content -->
    <main>
        <section class="inner inner-services">
            <div class="container">
                <div class="row">
                    @foreach($services as $service)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="{{ asset('app/public/'.(isset($service->service_icons)?$service->service_icons:'1.png'))}}"
                                         style="width: 100%;" hight="10%"
                                         alt="{{isset($service->service_title)?$service->service_title:''}}">
                                </div>
                                <div class="card-grid-content">
                                    <h5>{{isset($service->service_title)?$service->service_title:''}}</h5>
                                    <p>{!! isset($service->service_short_desc_title)?$service->service_short_desc_title:'' !!}</p>
                                </div>
                                <div class="card-grid-footer">
                                    <a href="{{route('servicePage',$service->slug)}}"
                                       class="btn">{{ __('site.readmore') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
@endsection
