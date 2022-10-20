@extends('layouts.org_web.layout')

@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}" />
    @endif
@endsection

@section('content')
    <header class="inner-head" style="margin-top:6%;">
        <div class="container">
            <h1>
            {{ __('site.accessPolicy') }}
            </h1>
        </div>
    </header>


   <!-- Main content -->
    <main class="colored-bg policy">
        <div class="container">
            <!-- مقدمة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                    {{ __('site.introduction') }}
                    </h4>
                </div>
                <div class="col-sm-12 col-md">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->introduction_en)?$access_policy->introduction_en:'' !!}</p>
                    @else
                        <p>{!! isset($access_policy->introduction)?$access_policy->introduction:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- الهدف -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.target') }}

                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->target_en)?$access_policy->target_en:'' !!}</p>
                    @else
                        <p>{!! isset($access_policy->target)?$access_policy->target:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- استخدام موقع YTIF -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.uses_website') }}
                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->uses_website_en)?$access_policy->uses_website_en:'' !!}</p>
                    @else
                        <p>{!! isset($access_policy->uses_website)?$access_policy->uses_website:'' !!}</p>
                    @endif

                </div>
            </section>
            <!-- مايلي يشمل موقع YTIFS -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4> {{ __('site.what_contain') }}</h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        {!! isset($access_policy->included_website_en)?$access_policy->included_website_en:'' !!}
                    @else
                        {!! isset($access_policy->included_website)?$access_policy->included_website:'' !!}
                    @endif
                </div>
            </section>
            <!-- إشراك العملاء -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.customerss') }}
                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->subscribe_customer_en)?$access_policy->subscribe_customer_en:'' !!} </p>
                    @else
                        <p>{!! isset($access_policy->subscribe_customer)?$access_policy->subscribe_customer:'' !!} </p>
                    @endif

                </div>
            </section>
            <!-- الحلول البديلة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.Alternative solutions') }}
                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->Alternative_solutions_en)?$access_policy->Alternative_solutions_en:'' !!}</p>
                    @else
                        <p>{!! isset($access_policy->Alternative_solutions)?$access_policy->Alternative_solutions:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- الامتثال للمعايير -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.Compliance with standards') }}
                        </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($access_policy->Compliance_standards_en)?$access_policy->Compliance_standards_en:'' !!}</p>
                    @else
                        <p>{!! isset($access_policy->Compliance_standards)?$access_policy->Compliance_standards:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- اتصل بنا -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        {{ __('site.contact') }}
                         </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <p>

                        {{__('site.havequetion')}}
                    </p>
                    <ul>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>{{isset($access_policy->phone)?$access_policy->phone:''}}</span>
                        </li>
                        <li>
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/{{isset($access_policy->whatsApp)?$access_policy->whatsApp:''}}" class="icon-link">{{isset($access_policy->whatsApp)?$access_policy->whatsApp:''}}</a>
                        </li>
                        <li>
                            <i class="fas fa-at"></i>
                            <a href="mailto:{{isset($access_policy->default_email)?$access_policy->default_email:''}}">{{isset($access_policy->default_email)?$access_policy->default_email:''}}</a>
                        </li>
                    </ul>
                </div>
            </section>
        </div>

    </main>
    <!-- Footer -->
    @endsection
