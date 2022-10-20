@extends('layouts.org_web.layout')
@section('keywords')
    @if(current_local()=="en")
        <meta name="keywords" content=" {{ isset($header->blog_keyword_en)?$header->blog_keyword_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->blog_keyword)?$header->blog_keyword:'تداول' }}" />
    @endif
@endsection

@section('content')

   <header class="inner-header" style="margin-top: 6%;
           background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url({{asset('/app/public/'.(isset($page_setups->blog_background)?$page_setups->blog_background:'1.jpg'))}});
           background-size: cover;
           background-position: bottom;
           background-repeat: no-repeat;">
        <div class="section-heading">
            @if(current_local()=="en")
                <h1>{{isset($header->blog_title_en)?$header->blog_title_en:''}}</h1>
                <p>{{isset($header->blog_sub_title_en)?$header->blog_sub_title_en:''}}</p>
            @else
                <h1>{{isset($header->blog_title)?$header->blog_title:''}}</h1>
                <p>{{isset($header->blog_sub_title)?$header->blog_sub_title:''}}</p>
            @endif

        </div>
   </header>

   <!-- Main content -->
    <main>
        <section class="inner blog-posts">
            <div class="container">

                <div class="row">
                 @foreach($categories as $category)
                        <div class="col-sm-4 col-md-4 col-lg-3">

                      <div style="width:100%;@if(isset($cat))@if($category->id== $cat) background: #384147;
                              color: #fff;  @else background-color: {{ $category->color }}; @endif @else background-color:{{ $category->color }}; @endif border-radius:4px;padding:15px;
                           margin:10px 5px; ">
                          <div style="padding-right:10px;padding-left:10px">
                              <a href="{{ route('blog_category',$category->id)  }}" style="text-decoration:none">
                                  <span style="font-size:15px;font-weight:bold;
                                  @if(isset($cat))@if($category->id== $cat)
                                          color: #fff;  @else   color:#fff; @endif @else   color:#fff; @endif

                                  white-space:nowrap;display:block; text-align:center">
                                      {{ $category->title }}
                     </span></a>
                          </div>
                      </div>
                        </div>



                @endforeach
                </div>

                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card-grid">
                            <div class="card-grid-img"><img src="{{asset('/app/public/'.(isset($post->post_image)?$post->post_image:'default.jpeg'))}}" alt=""></div>
                            <div class="card-grid-content">
                                <h5>{{isset($post->post_title)?$post->post_title:''}}</h5>

                                    <span class="badge badge-primary"
                                          style="background:{{isset($post->post_category_id)?$post->category->color:''}}; ">
                                        {{isset($post->post_category_id)?$post->category->title:''}}
                                    </span>

                                <div class="card-user">
                                    <img src="{{asset('/app/public/user-placeholder.jpg')}}" alt="{{isset($post->post_title)?$post->post_title:''}}">
                                    <p>{{isset($post->user_id)?$post->users->name:''}}</p>
                                </div>
                                <p>{{isset($post->post_subtitle)?$post->post_subtitle:''}}</p>
                            </div>
                            <div class="card-grid-footer">
                                <div>
                                    <span>
                 <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?>

                                    </span>
                                    <div class="item">
                                        <i class="fas fa-eye"></i>
                                        <span>
                                            {{ __('site.views') }}
                                            : </span>
                                        <span>{{isset($post->views)?$post->views:'0'}}</span>
                                    </div>
                                </div>

                                <a href="{{route('blog_post',$post->slug )}}" class="line-btn">
                                    {{ __('site.readmore') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        {{ $posts->render() }}
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>

            </div>
        </section>
    </main>
    <!-- Footer -->
   @endsection
