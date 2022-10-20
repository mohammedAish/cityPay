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
            <h1>{{ __('site.rules') }}</h1>
        </div>
    </header>


   <!-- Main content -->
    <main class="colored-bg policy">
        <div class="container">
            <!-- معلومات عامة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>{{ __('site.General_Information') }} </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->public_information_en)?$privacy_policy->public_information_en:'' !!}</p>
                    @else
                        <p>{!! isset($privacy_policy->public_information)?$privacy_policy->public_information:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- الحق في الوصول إلى البيانات وتصحيحها وحذفها والاعتراض على معالجة البيانات -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4> {{ __('site.right1') }}
                       </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->access_for_data_en)?$privacy_policy->access_for_data_en:'' !!}</p>

                    @else
                        <p>{!! isset($privacy_policy->access_for_data)?$privacy_policy->access_for_data:'' !!}</p>

                    @endif
                </div>
            </section>
            <!-- إدارة البيانات الشخصية -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>{{ __('site.personal_data') }}</h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->manage_personal_data_en)?$privacy_policy->manage_personal_data_en:'' !!}</p>
                    @else
                        <p>{!! isset($privacy_policy->manage_personal_data)?$privacy_policy->manage_personal_data:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- المعلومات التي نجمعها -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>{{ __('site.collcted_data') }}</h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->information_collect_en)?$privacy_policy->information_collect_en:'' !!}</p>
                    @else
                        <p>{!! isset($privacy_policy->information_collect)?$privacy_policy->information_collect:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- كيف نستخدم معلوماتك -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>{{ __('site.data_usage') }}</h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->how_Uses_data_en)?$privacy_policy->how_Uses_data_en:'' !!}</p>
                    @else
                        <p>{!! isset($privacy_policy->how_Uses_data)?$privacy_policy->how_Uses_data:'' !!}</p>
                    @endif
                </div>
            </section>
            <!-- مشاركة معلوماتك -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>{{ __('site.data_share') }}</h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    @if(current_local()=="en")
                        <p>{!! isset($privacy_policy->sharing_data_en)?$privacy_policy->sharing_data_en:'' !!}</p>
                    @else
                        <p>{!! isset($privacy_policy->sharing_data)?$privacy_policy->sharing_data:'' !!}</p>
                    @endif
                </div>
            </section>
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h6>{{ __('site.query') }} </h6>
                </div>
                <div class="col-sm-12 col-md-8">
                    <p><a href="mailto:{{isset($privacy_policy->For_inquiries)?$privacy_policy->For_inquiries:''}}">{{isset($privacy_policy->For_inquiries)?$privacy_policy->For_inquiries:''}}</a></p>


                </div>
            </section>
        </div>

    </main>
    <!-- Footer -->
    @endsection
