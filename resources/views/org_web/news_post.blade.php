@extends('layouts.org_web.layout')

@section('keywords')
    <meta name="keywords" content="{{ isset($neww->keywords)?$neww->keywords:'ytifs' }}" />
@endsection

@section('content')
    <header class="post-header" style="margin-top: 6%">
        <div class="container">
            <section class="post-info">
                <a href="{{route('news')}}" class="back-btn">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ __('site.news') }}</span>
                </a>
                <section class="post-details">
                    <h1>{{ $neww->new_title }}</h1>
                    <h5>{{ $neww->new_subtitle }}</h5>
                    <div class="post-user-time">
                        <div class="user">
                            <img src="{{asset('/org_assets/dist/img/user-placeholder.jpg')}}" alt="">
                            <h6>
                            {{ $neww->user->name }}
                            </h6>
                        </div>
                        <div class="time">
                            <i class="fas fa-clock"></i>
                            <span>
                                <span>   <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($neww->created_at))->diffForHumans() ?> </span> -
                                <span>
                                  <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($neww->created_at))->toDateString() ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </header>

   <!-- Main content -->
    <main class="post-container">
        <div class="container post-body">
            <div class="row">
                <div class="col-sm-12">
                    <section class="post-likes">
                        <img src="{{asset('/org_assets/dist/img/emojis/fire.svg')}}" alt="">
                        <span class="no">{{ $neww->views }}</span>
                        <span class="title">{{ __('site.views') }}</span>
                    </section>
                </div>
                <div class="col-sm-12">
                    <div class="share-links">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href={{Request::fullUrl()}}&display=popup" class="item facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>{{ __('site.share') }}</span>
                        </a>
                        <a href="http://twitter.com/share?text={{ $neww->new_title }}&url={{ Request::fullUrl() }}&hashtags={{ $neww->keywords }}" class="item twitter">
                            <i class="fab fa-twitter"></i>
                            <span>{{ __('site.twitt') }}</span>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{$neww->new_title}}" class="item whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <span>{{ __('site.whatsApp') }}</span>
                        </a>
                        <a href="https://telegram.me/share/url?url={{ Request::fullUrl() }}&text={{ $neww->new_title }}" target="_blank" class="item telegram">
                            <i class="fab fa-telegram"></i>
                            <span>{{ __('site.telegramm') }}</span>
                        </a>
                        <a href="fb-messenger://share?link={{ Request::fullUrl() }}&app_id=appid" class="item facebook">
                            <i class="fab fa-facebook-messenger"></i>
                            <span>{{ __('site.messengerr') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <section class="post-content">
                       <p>
                           {!!  $neww->new_content  !!}
                       </p>
                    </section>
                    <section class="post-footer">
                        <section class="post-shortlink">
                            <span>    {{ __('site.short_link') }}
                                : </span>
                            <span class="url"><a href="{{ $neww->short_link }}">
                                    {{ $neww->short_link }}
                                </a></span>
                            <button id="copy-link" class="btn">{{ __('site.copy') }}</button>
                            <div class="alert alert-success" role="alert">
                                {{ __('site.copy_success') }}
                            </div>
                        </section>
                        @if(\Illuminate\Support\Facades\Auth::check())
                    {{--    <section class="rate-author">
                            <h5>{{ __('site.author_review') }}</h5>
                            <div class="rate">
                                <div id="upVote" class="rate-type">
                                    <i class="fas fa-caret-up"></i>
                                    <span>{{__('site.postive')}}</span>
                                </div>
                                <div class="rate-result">
                                        <span class="no" id="rate_no" data-rateValue="{{ isset($author_review->count)?$author_review->count:0 }}">
                                            {{ isset($author_review->count)?$author_review->count:0 }}</span>
                                    <span class="title">{{ __('site.point') }}</span>
                                </div>
                                <div id="downVote" class="rate-type down">
                                    <i class="fas fa-caret-down"></i>
                                    <span>{{ __('site.negative') }}</span>
                                </div>

                                <input type="hidden" name="writer_id" value="{{isset($neww->user_id)?$neww->user_id:0}}">
                            </div>
                        </section>--}}

                        @else
                            <div class="alert alert-success">
                                <h6>
                                    {{ __('site.review_must_account') }}
                                </h6>
                            </div>
                        @endif


                        @if(\Illuminate\Support\Facades\Auth::check())
                           {{-- <section class="post-reactions">
                                <h5>
                                    {{ __('site.think_about_post') }}
                                </h5>
                                <form class="emojis" id="emoji" method="post">
                                    {{ csrf_field() }}
                                    <div class="emoji">
                                        <input type="radio" name="emoji" value="angry" data-init="{{  $review->where('review_type','angry')->first()!==null  ?$review->where('review_type','angry')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/angry.svg')}}" alt="">
                                        <span class="emoji-no">{{  $review->where('review_type','angry')->first()!==null  ?$review->where('review_type','angry')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.angry') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji" value="crying" data-init="{{  $review->where('review_type','crying')->first()!==null  ?$review->where('review_type','crying')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/crying.svg')}}" alt="">
                                        <span class="emoji-no">{{  $review->where('review_type','crying')->first()!==null ?$review->where('review_type','crying')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.crying') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji"  value="kiss" data-init="{{  $review->where('review_type','kiss')->first()!==null  ?$review->where('review_type','kiss')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/kiss.svg')}}" alt="">
                                        <span class="emoji-no">{{  $review->where('review_type','kiss')->first() !==null ?$review->where('review_type','kiss')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.kiss') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji"  value="cool" data-init="{{  $review->where('review_type','cool')->first()!==null  ?$review->where('review_type','cool')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/cool.svg')}}" alt="">
                                        <span class="emoji-no">{{ $review->where('review_type','cool')->first() !==null ?$review->where('review_type','cool')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.cool') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji"  value="shock" data-init="{{  $review->where('review_type','shock')->first()!==null  ?$review->where('review_type','shock')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/shock.svg')}}" alt="">
                                        <span class="emoji-no">{{  $review->where('review_type','shock')->first() !==null ?$review->where('review_type','shock')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.wow') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji"  value="grinning" data-init="{{  $review->where('review_type','grinning')->first()!==null  ?$review->where('review_type','grinning')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/grinning.svg')}}" alt="">
                                        <span class="emoji-no">{{  $review->where('review_type','grinning')->first() !==null ?$review->where('review_type','grinning')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.grinning') }}</span>
                                    </div>
                                    <div class="emoji">
                                        <input type="radio" name="emoji"  value="smile" data-init="{{  $review->where('review_type','smile')->first()!==null  ?$review->where('review_type','smile')->first()->count:'0' }}">
                                        <img src="{{asset('/org_assets/dist/img/emojis/smile.svg')}}" alt="">
                                        <span class="emoji-no">{{ $review->where('review_type','smile')->first() !==null ?$review->where('review_type','smile')->first()->count:'0' }}</span>
                                        <span class="emoji-title">{{ __('site.smile') }}</span>
                                    </div>


                                    <input type="hidden" name="neww_id" value="{{ $neww->id }}">

                                    <input type="hidden" name="review_for" value="news">

                                <!--    <div class="row" style="margin-top: 34px; margin-right: 17px;">
                                    <div class="form-group" style="    text-align: center; display: inline-block;">
                                        <label for="confirm_password">أثبت أنك لست روبوت ؟  <sup>*</sup></label>
                                        @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    <div class="g-recaptcha2"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                            </div>
                                        @endif

                                        </div>
                                    </div>
-->
                                </form>

                            </section>--}}

                            @else
                      <div class="alert alert-success">
                          <h6>
                              {{ __('site.review_post_must_account') }}
                          </h6>
                      </div>
                        @endif


                    </section>
                </div>
            </div>

            <div class="row post-comment-section">
                <section class="col-sm-12">
                    <form class="new-comment" action="#" method="post">
                        {{ csrf_field() }}
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="form-group">
                            <label for="comment">{{ __('site.enter your comment') }} </label>
                            <textarea name="comment" class="form-control"></textarea>
                        </div>

                        @else
                            <div class="form-group">
                                <label for="user_name">{{ __('site.name') }} </label>
                                <input type="text" name="user_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('site.email') }} </label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="comment"> {{ __('site.comment') }} </label>
                                <textarea name="comment" class="form-control"></textarea>
                            </div>
                            @endif
                        <div class="form-group">
                            <label for="confirm_password">{{ __('site.not_robot') }}  <sup>*</sup></label>
                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                <div class="g-recaptcha"
                                     data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                </div>
                            @endif

                        </div>
                        <input type="hidden" name="neww_id" value="{{ $neww->id }}">
                        <input type="hidden" name="comment_for" value="news">

                        <button type="submit" class="btn">{{ __('site.Send') }}</button>
                    </form>
                </section>
                <section class="col-sm-12 comments">
                    <h4>
                        <i class="fas fa-comment-alt"></i>
                        <span>{{ __('site.comments') }}</span>
                    </h4>
                   {{-- <section class="list">
                       @if(isset($comments)&& count($comments)>0)
                        @foreach($comments as$comment)
                        <section class="comment-card">
                            <div class="row author">
                                 <div class="col-auto">
                                    <img src="{{asset('/org_assets/dist/img/user-placeholder.jpg')}}" alt="">
                                </div>
                                <div class="col">
                                    <p class="author-name">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            {{ isset($comment->user->name)?$comment->user->name:__('site.unknown') }}
                                            @else
                                            {{ $comment->user_name }}

                                        @endif

                                    </p>
                                    <p class="date">
                                        <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="comment-loc">
                                    {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>
                        </section>
                           @endforeach

                           <div class="row">
                               <div class="col-lg-4">
                               </div>
                               <div class="col-lg-4">
                                   {{ $comments->render() }}
                               </div>
                               <div class="col-lg-4">
                               </div>
                           </div>

                           @else
                            <div class="text-center">
                                <h6>
                                    {{ __('site.no_comments') }}
                                </h6>
                            </div>
                           @endif


                    </section>--}}
                </section>
            </div>

        </div>
    </main>
    <!-- Footer -->
@endsection


@section('scripts')
    <script>
        $(document).on('change', '[name="emoji"]' , function(e) {
            e.preventDefault();
            var review_type = $('[name="emoji"]:checked').val();
            var  neww_id = $('[name="neww_id"]').val();
            var  review_for = $('[name="review_for"]').val();
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('review_post') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'review_type':review_type
                    ,'neww_id': neww_id
                    ,'review_for':review_for
                },
                success: function(data) {
                    console.log(data);
                    if(data.status=="success")
                    {
                        new Noty({
                            layout: 'topLeft',
                            text: data.data,
                            killer: true,
                            type:'success',
                            timeout: 5000,
                        }).show();
                    }
                    else
                    {
                        var content='<ul>';
                        keys = $.map(data, function(v, i){
                            content+='<li>';
                            content+=v;
                            content+='<li>';
                        });
                        content+='</ul>';
                        //The message added to Response object in Controller can be retrieved as following.
                        new Noty({
                            layout: 'topLeft',
                            text: content,
                            killer: true,
                            type:'error',
                            timeout: 5000,
                        }).show();
                    }

                },

            });
        });

        $(document).on('click', '#upVote' , function(e) {
            review_author(e);
        });
        $(document).on('click', '#downVote' , function(e) {
            review_author(e);
        });

        function review_author(e)
        {
            e.preventDefault();
            var review_no = $('#rate_no').html();
            var  neww_id = $('[name="neww_id"]').val();
            var  writer_id = $('[name="writer_id"]').val();
            var  review_for = $('[name="review_for"]').val();
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('review_author') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'review_no':review_no
                    ,'neww_id': neww_id
                    ,'writer_id': writer_id
                    ,'review_for': review_for
                },
                success: function(data) {
                    if(data.status=="success")
                    {
                        new Noty({
                            layout: 'topLeft',
                            text: data.data,
                            killer: true,
                            type:'success',
                            timeout: 5000,
                        }).show();
                    }
                    else
                    {
                        var content='<ul>';
                        keys = $.map(data, function(v, i){
                            content+='<li>';
                            content+=v;
                            content+='<li>';
                        });
                        content+='</ul>';
                        //The message added to Response object in Controller can be retrieved as following.
                        new Noty({
                            layout: 'topLeft',
                            text: content,
                            killer: true,
                            type:'error',
                            timeout: 5000,
                        }).show();
                    }

                },

            });
        }


    </script>



@endsection
