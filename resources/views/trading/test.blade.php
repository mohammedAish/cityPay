@extends('trading.index')

@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords" content=" {{ isset($header->news_keyword_en)?$header->news_keyword_en:'تداول' }}"/>
    @else
        <meta name="keywords" content=" {{ isset($header->news_keyword)?$header->news_keyword:'تداول' }}"/>
    @endif
@endsection

@section('content')
    <header class="inner-header" style="margin-top: 6%;
        background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url({{asset('/app/public/'.(isset($page_setups->news_background)?$page_setups->news_background:'1.jpg'))}});
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;">
        <div class="section-heading">
            @if(current_local()=="en")
                <h1>{{isset($page_setups->news_title_en)?$page_setups->news_title_en:''}}</h1>
                <p>{!! isset($page_setups->news_sub_title_en)?$page_setups->news_sub_title_en:'' !!} </p>
            @else
                <h1>{{isset($page_setups->news_title)?$page_setups->news_title:''}}</h1>
                <p>{!! isset($page_setups->news_sub_title)?$page_setups->news_sub_title:'' !!} </p>
            @endif

        </div>
    </header>


@endsection
