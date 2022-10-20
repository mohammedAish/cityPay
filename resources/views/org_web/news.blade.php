@extends('layouts.org_web.layout')

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

    <!-- Main content -->
    <main>
        <section class="inner ">
            <div class="container">
                <div class="row">

                    @foreach($news as $new)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="{{ asset('app/public/'.(isset($new->new_image)?$new->new_image:'1.jpg'))}}"
                                         style="width: 100%;" hight="10%">
                                </div>
                                <div class="card-grid-content">
                                    <h5>{{isset($new->new_title)?$new->new_title:''}}</h5>
                                    <p>{{isset($new->new_subtitle)?$new->new_subtitle:''}}</p>
                                </div>
                                <div class="card-grid-footer">
                                    <div>
                                        <span>
               <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($new->created_at))->diffForHumans() ?>

                                        </span>
                                        <div class="item">
                                            <i class="fas fa-eye"></i>
                                            <span>
                                                 {{ __('site.views') }}
                                                : </span>
                                            <span>{{isset($new->views)?$new->views:'0'}}</span>
                                        </div>
                                    </div>

                                    <a href="{{route('news_post',$new->slug)}}"
                                       class="line-btn"> {{ __('site.readmore') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="row">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        {{ $news->render() }}
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>


            </div>
        </section>
    </main>
    <!-- Footer -->
@endsection
