@extends('layouts.org_web.layout')
@section('keywords')
    <meta name="keywords" content=" {{ isset($header->offers_keywords)?$header->offers_keywords:'تداول' }}"/>
@endsection

@section('content')
    <header class="inner-header no-overlay"
            style="margin-top: 6%;
                    background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url({{asset('/app/public/'.(isset($page_setups->offers_background)?$page_setups->offers_background:'1.jpg'))}});
                    background-size: cover;
                    background-position: bottom;
                    background-repeat: no-repeat;">
        <div class="section-heading">
            @if(current_local()=="en")
                <h1>{{isset($PageSetup->offers_title_en)?$PageSetup->offers_title_en:''}}</h1>
                <p>{{isset($PageSetup->offers_sub_title_en)?$PageSetup->offers_sub_title_en:''}}
                </p>
            @else
                <h1>{{isset($PageSetup->offers_title)?$PageSetup->offers_title:''}}</h1>
                <p>{{isset($PageSetup->offers_sub_title)?$PageSetup->offers_sub_title:''}}
                </p>
            @endif

        </div>
    </header>

    <!-- Main content -->
    <main id="offers">
        <section class="inner-offers">
            <div class="container">
                <div class="row">
                    @foreach($offers as $index=> $offer)
                        <div class="col-sm-12">
                            <section class="offer-container">
                                <div class="offer-img">
                                    <img src="{{asset('/app/public/'.(isset($offer->offer_logo)?$offer->offer_logo:'logo.png'))}}"
                                         alt="">
                                </div>
                                <div class="offer-header">
                                    <div class="offer-amount offer-badge1">
                                        <div class="offer-no">
                                            <span class="no">{{isset($offer->discount_rate)?$offer->discount_rate:''}}%</span>
                                            <span>{{isset($offer->offer_desc_title)?$offer->offer_desc_title:''}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="offer-content">
                                    <h2>{{isset($offer->offer_title)?$offer->offer_title:''}}</h2>
                                    <p>{{isset($offer->offer_small_description)?$offer->offer_small_description:''}}</p>
                                </div>
                                <div class="offer-footer">
                                    <a href="#" class="btn" data-toggle="modal"
                                       data-target="#offerModal{{$index}}">{{$offer->offer_button_text}}</a>
                                </div>

                            </section>
                        </div>



                        <!-- Offer modal -->
                        <div class="modal fade" id="offerModal{{$index}}" data-backdrop="static" tabindex="-1"
                             role="dialog" aria-labelledby="offerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            {{isset($offer->offer_title)?$offer->offer_title:''}}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <section class="offer-container">
                                                    <div class="offer-img">
                                                        <img src="{{asset('/app/public/'.(isset($offer->offer_logo)?$offer->offer_logo:'logo.png'))}}"
                                                             alt="">
                                                    </div>
                                                    <div class="offer-header">
                                                        <div class="offer-amount offer-badge1">
                                                            <div class="offer-no">
                                                                <span class="no">{{isset($offer->discount_rate)?$offer->discount_rate:''}}%</span>
                                                                <span>{{isset($offer->offer_desc_title)?$offer->offer_desc_title:''}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="offer-content">
                                                        <h2> {{isset($offer->offer_title)?$offer->offer_title:''}}</h2>
                                                        <p>
                                                            {{isset($offer->offer_small_description)?$offer->offer_small_description:''}}
                                                        </p>
                                                    </div>
                                                    <div class="offer-footer">
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="offer-details">
                                                    <div class="offer-end-date">
                                                        <h6>
                                                            {{ __('site.offerend_date') }}
                                                        </h6>
                                                        <p>
                                                            <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($offer->finish_date))->toDateString() ?>
                                                        </p>
                                                    </div>
                                                    <div class="offer-description">
                                                        <h5> {{ $offer->offer_desc_title }}</h5>
                                                        <p>
                                                            {{ $offer->offer_desc }}
                                                        </p>
                                                        <a href="{{ $offer->offer_button_link }}"
                                                           class="btn">{{ $offer->offer_button_text }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="offer-side-info">
                                                    <div class="info-item">
                                                        <h5>
                                                            {{ __('site.prev_prie') }}
                                                        </h5>
                                                        <p>
                                                            {{ $offer->old_price }}
                                                            {{ $offer->offer_currency }}
                                                        </p>
                                                    </div>
                                                    <div class="info-item">
                                                        <h5>  {{ __('site.new_prie') }}

                                                        </h5>
                                                        <p>
                                                            {{ $offer->new_price }}
                                                            {{ $offer->offer_currency }}
                                                        </p>
                                                    </div>
                                                    <div class="info-item">
                                                        <h5>
                                                            {{ __('site.discount_rate') }}
                                                        </h5>
                                                        <p>
                                                            {{isset($offer->discount_rate)?$offer->discount_rate:''}}%
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endforeach


                </div>

                <div class="row">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        {{ $offers->render() }}
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>

            </div>
        </section>

    </main>
    <!-- Footer -->
@endsection
