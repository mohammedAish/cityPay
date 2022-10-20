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
                    <h1>{{'Search For EveryThing'}}</h1>
                @else
                    <h1>{{'ابحث عما تريد'}}</h1>
                @endif

                        <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2"
                        method="get" action="{{ route('search_site') }}">
                            <input class="form-control form-control-sm mr-3 w-50" style="height: 44px;" type="text" placeholder="{{__('site.search')}}"
                                   aria-label="Search" name="word">
                        </form>



            </div>
        </div>
    </header>


    <main>
        <section class="inner " style="top: 0px; margin-bottom:0px;">

            <div class="container">

                <div class="row">


                    @forelse($news as $new)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="{{ asset('app/public/'.(isset($new->new_image)?$new->new_image:'1.jpg'))}}" style="width: 100%;" hight="10%">
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

                                    <a href="{{route('news_post',$new->slug)}}" class="line-btn"> {{ __('site.readmore') }}</a>
                                </div>
                            </div>
                        </div>

                        @empty
                        <h4 class="text-center">

                            @if(current_local()=="en")
                                <h1>{{'No Result For What You Search For'}}</h1>
                            @else
                                <h1>{{'لا يوجد نتيجة لما بحثت عنه'}}</h1>
                            @endif
                        </h4>

                    @endforelse


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
@endsection
