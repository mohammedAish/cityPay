@extends('layouts.org_web.layout')


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
                    @foreach($parentServices as $parentService)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="{{config('app.url').$parentService->img_path}}"
                                         style="width: 100%;" hight="10%"
                                         alt="{{$parentService->name}}">
                                </div>
                                <div class="card-grid-content">
                                    <h5>{{$parentService->name}}</h5>
                                    <p>{{$parentService->short_description}}</p>
                                </div>
                                @if($parentService->id == 2)
                                    <div class="card-grid-footer">
                                        <a href="#{{--{{route('cards.main')}}--}}"
                                           class="btn">{{ __('site.readmore') }}</a>
                                    </div>
                                    @elseif($parentService->id == 3)
                                    <div class="card-grid-footer">
                                        <a href="{{route('consultants.main')}}"
                                           class="btn">{{ __('site.readmore') }}</a>
                                    </div>
                                    @elseif($parentService->id == 4)
                                <div class="card-grid-footer">
                                    <a href="{{route('courses.main')}}"
                                       class="btn">{{ __('site.readmore') }}</a>
                                </div>
                                    @else
                                    <div class="card-grid-footer">
                                        <a href="{{route('sub_services',$parentService->id)}}"
                                           class="btn">{{ __('site.readmore') }}</a>
                                    </div>
                                 @endif

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
@endsection
