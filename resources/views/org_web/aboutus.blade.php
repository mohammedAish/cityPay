@extends('layouts.org_web.layout')

@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}" />
    @endif
@endsection

@section('content')
    <header class="inner-header no-overlay" style="margin-top: 6%;
    background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url({{asset('/app/public/'.(isset($page_setups->about_company_background)?$page_setups->about_company_background:'1.jpg'))}});
    background-size: cover;
    background-position: bottom;
    background-repeat: no-repeat;">
        <div class="container">
            <div class="section-heading">
                @if(current_local()=="en")
                    <h1>{{isset($page_setups->about_company_title_en)?$page_setups->about_company_title_en:''}}</h1>
                    <p>{!! isset($page_setups->about_company_sub_title_en)?$page_setups->about_company_sub_title_en:'' !!}</p>
                @else
                    <h1>{{isset($page_setups->about_company_title)?$page_setups->about_company_title:''}}</h1>
                    <p>{!! isset($page_setups->about_company_sub_title)?$page_setups->about_company_sub_title:'' !!}</p>
                @endif

            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="about">
        <section class="about-rows">
            <div class="container">
                <div class="row about-info">
                    <div class="col-sm-12 col-lg-6">
                        <div class="circled-img">
                            <img src="{{ asset('/home_page/img/sample.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        @if(current_local()=="en")
                            <h2>{{isset($aboutus->trade_mark_title_en)?$aboutus->trade_mark_title_en:''}}</h2>
                            <p>{!! isset($aboutus->trade_mark_desc_en)?$aboutus->trade_mark_desc_en:'' !!}</p>
                        @else
                            <h1>{{isset($aboutus->trade_mark_title)?$aboutus->trade_mark_title:''}}</h1>
                            <p>{!! isset($aboutus->trade_mark_desc)?$aboutus->trade_mark_desc:'' !!}</p>
                        @endif

                    </div>
                </div>
                <div class="row about-info">
                    <div class="col-sm-12 col-lg-6">
                        @if(current_local()=="en")
                            <h2>{{isset($aboutus->Definition_company_title_en)?$aboutus->Definition_company_title_en:''}}</h2>
                            <p>{!! isset($aboutus->Definition_company_desc_en)?$aboutus->Definition_company_desc_en:'' !!}</p>
                        @else
                            <h2>{{isset($aboutus->Definition_company_title)?$aboutus->Definition_company_title:''}}</h2>
                            <p>{!! isset($aboutus->Definition_company_desc)?$aboutus->Definition_company_desc:'' !!}</p>
                        @endif

                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="circled-img">
                            <img src="{{ asset('/home_page/img/about.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="whyUs">
            <div class="container">
                <div class="section-heading">
                    <h1> {{ __('site.Counters') }} </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    @foreach($counters as $indx => $counter)
                        <div class="why-us-item col-sm-6 col-lg-3">
                            <div class="imgback">
                                <img src="{{asset('/app/public/'.(isset($counter->image)?$counter->image:'logo.png') )}}" alt="">
                            </div>

                            <p id="counter{{$indx}}" style="padding: 0.2rem;">0</p>
                            <p style="padding: 0.2rem;">{{isset($counter->title)?$counter->title:'' }}</p>
                            <script>
                                $({countNum: $('#counter{{$indx}}').text()}).animate({countNum: '{{isset($counter->counter)?$counter->counter:'0' }}'}, {
                                    duration: 8000,
                                    easing:'linear',
                                    step: function() {
                                        $('#counter{{$indx}}').text(Math.floor(this.countNum));
                                    },
                                    complete: function() {
                                        $('#counter{{$indx}}').text(this.countNum);
                                    }
                                });
                            </script>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>

   </main>



    <!-- Footer -->
@endsection
