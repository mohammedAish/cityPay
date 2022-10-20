@extends('layouts.org_web.layout')

@section('keywords')

    <meta name="keywords" content=" {{ isset($header->home_keywords)?trans('lang.'.$header->home_keywords):'تداول' }}"/>


@endsection

@section('content')


    <!-- Header -->
    <header class="main-page-header" style="margin-top: 6%;">
        <section id="headerCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $key => $slider)
                    <li data-target="#headerCarousel" data-slide-to="{{$key}}"
                        class="{{$key == 0? 'active':''}}"></li>
                @endforeach

            </ol>
            <div class="carousel-inner">

                @foreach($sliders as $key => $slider )
                    <div class="carousel-item {{$key==0 ? 'item'.++$key.' active ':'item'.(++$key)}}"
                         style="background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.25)),
                             url({{asset('app/public/'.$slider->image)}}); background-size: cover;
                             background-repeat: no-repeat;
                             background-position: center;">
                        <div class="container">
                            <h1>{{isset($slider->title)?$slider->title:''}}</h1>
                            <p>{{isset($slider->description)?$slider->description:''}}</p>
                            <a href="{{isset($slider->button_link)?$slider->button_link:''}}" class="btn">
                                {{isset($slider->button_text)?$slider->button_text:''}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">{{ __('site.previous') }}</span>
            </a>
            <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{{ __('site.next') }}</span>
            </a>
        </section>
    </header>
    <!-- Main content -->
    <main>
        <!-- العروض -->
        <section class="container">
            <div class="section-heading">
                <h1>{{ __('site.offers') }} </h1>
                <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
            </div>
            <section class="slickSlider offerSlider">

                @foreach($offers as $offer)
                    <div class="offer-slider-item">
                        <section class="offer-container">
                            <div class="offer-img">
                                <img src="{{asset('/app/public/'.(isset($offer->offer_logo)?$offer->offer_logo:'logo.png'))}}"
                                     alt="">
                            </div>
                            <div class="offer-header">
                                <div class="offer-amount offer-badge1">
                                    <div class="offer-no">
                                        <span class="no"> {{isset($offer->discount_rate)?$offer->discount_rate:''}}%</span>
                                        <span> {{isset($offer->offer_desc_title)?$offer->offer_desc_title:''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="offer-content">
                                <h2>{{isset($offer->offer_title)?$offer->offer_title:''}}</h2>
                                <p>{{isset($offer->offer_small_description)?$offer->offer_small_description:''}}</p>
                            </div>
                            <div class="offer-footer">
                                <a href="{{isset($offer->offer_button_link)?$offer->offer_button_link:''}}"
                                   class="btn">{{isset($offer->offer_button_text)?$offer->offer_button_text:''}}</a>
                            </div>
                        </section>
                    </div>
                @endforeach

            </section>
        </section>
        <!-- لماذا يمن تداول -->
        <section class="whyUs">
            <div class="container">
                <div class="section-heading">
                    <h1> {{ __('site.whyUs') }} </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    @foreach($why_us as $why_us_item)
                        <div class="why-us-item col-sm-6 col-lg-3">
                            <div class="imgback">
                                <img src="{{asset('/app/public/'.(isset($why_us_item->icon)?$why_us_item->icon:'logo.png') )}}"
                                     alt="">
                            </div>
                            <p>{{isset($why_us_item->description)?$why_us_item->description:'' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- الشهادات -->
        <section class="certificates">
            <div class="container">
                <div class="section-heading">
                    <h1>{{ __('site.certificates') }}</h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="slickSlider cert-slider">
                    @foreach($certificates as $certificate)
                        <div class="cert-slider-item">
                            <img src="{{asset('/app/public/'.(isset($certificate->certificate_image)?
                            $certificate->certificate_image:'cert.png'))}}" class="d-block w-100"
                                 alt="{{ $certificate->certificate_name }}">
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- من نحن -->
        <section class="whoUs">
            <div class="container">
                <div class="section-heading">
                    <h1>{{ __('site.about_company') }}</h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="{{asset('/org_assets/dist/img/svg/team.svg')}}" alt="">
                                <h3>{{ __('site.who_us') }} </h3>
                                <p>{!! isset($SettingSite->who_us)?trans('lang.'.$SettingSite->who_us):'who us text here' !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="{{asset('/org_assets/dist/img/svg/target.svg')}}" alt="">
                                <h3>{{ __('site.mission') }}</h3>
                                <p>{!! isset($SettingSite->mission_en)?trans('lang.'.$SettingSite->mission):'mission text here' !!}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="{{asset('/org_assets/dist/img/svg/success.svg')}}" alt="">
                                <h3>{{ __('site.vision') }}</h3>
                                <p>{!! isset($SettingSite->vision)?trans('lang.'.$SettingSite->vision):'vision text here' !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- الخدمات -->
        <section class="services">
            <div class="container">
                <div class="section-heading">
                    <h1>{{ __('site.services') }}</h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row slickSlider services-slider">
                    @foreach($service_categories as  $service )
                        <div class="slider-item">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="circled-img">
                                        <img src="{{asset('/app/public/'.(isset($service->service_background)?$service->service_background:'logo.png'))}}"
                                             alt="{{isset($service->service_title)?$service->service_title:''}}"
                                             width="100%">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="item-content">
                                        <h2>{{isset($service->service_title)?$service->service_title:''}}</h2>
                                        <p>{!! isset($service->service_short_desc_title)?$service->service_short_desc_title:''!!}</p>
                                        <a href="{{route('servicePage',$service->slug)}}" class="btn">
                                            {{ __('site.readmore') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- المستجدات -->
        <section class="news light">
            <div class="container">
                <div class="section-heading">
                    <h1>{{ __('site.news') }}</h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    @foreach($news as $new)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="{{asset('/app/public/'.(isset($new->new_image)?$new->new_image:'default.jpeg'))}}"
                                         alt="">
                                </div>
                                <div class="card-grid-content">
                                    <h5>{{isset($new->new_title)?$new->new_title:''}}</h5>
                                    <p>{{isset($new->new_subtitle)?$new->new_subtitle:''}}</p>
                                </div>
                                <div class="card-grid-footer">
                                    <span>
                                  <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($new->created_at))->diffForHumans() ?>
                                    </span>
                                    <a href="{{route('news_post',$new->slug)}}"
                                       class="line-btn">  {{ __('site.readmore') }}  </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>


            </div>
        </section>
        <!-- العملاء -->
        <section class="clients ">
            <div class="container">
                <div class="section-heading">
                    <h1>{{ __('site.partners') }}</h1>
                    <!-- <h1>نحن شركاء للشركات العالمية</h1> -->
                </div>
                <div class="slickSlider autoplay-slider">
                    @foreach($partners as $partner)
                        <div class="client-logo">
                            <img src="{{asset('/app/public/'.(isset($partner->partner_logo)?$partner->partner_logo:'default.jpeg'))}}"
                                 alt="">
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- شركات الوساطه -->
        <section class="clients light">
            <div class="container">
                <div class="section-heading">
                    <h1> {{ __('site.firms') }}
                    </h1>
                </div>
                <div class="slickSlider autoplay-slider">
                    @foreach($brokerage_firms as $brokerage_firm)
                        <div class="client-logo">
                            <a href="{{ $brokerage_firm->brokerage_firms_link }}">
                                <img src="{{asset('/app/public/'.(isset($brokerage_firm->brokerage_firms_logo)?$brokerage_firm->brokerage_firms_logo:'default.jpeg'))}}"
                                     alt="">
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- الدفع -->
        <section class="clients">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {{ __('site.companiespayment') }}
                    </h1>
                </div>
                <div class="slickSlider autoplay-slider">
                    @foreach($payment_companies as $payment_company)
                        <div class="client-logo">
                            <img src="{{asset('/app/public/'.(isset($payment_company->payment_company_logo)?$payment_company->payment_company_logo:'default.jpeg'))}}"
                                 alt="">
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->

@endsection
