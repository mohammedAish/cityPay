@extends('layouts.org_web.layout')
@section('content')
    <!-- Preview video Modal -->
    <header class="inner-header coursePage" style="margin-top: 6%">
        <video autoplay muted loop>
            <source src="{{asset('/org_assets/dist/img/videos/sample.mp4')}}" type="video/mp4">
        </video>
        <div class="section-heading">
            <h1>{{$course_info->name}}</h1>
            <p>{!! $course_info->description !!}</p>
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center mb-3">
                <p class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
                    <span class="mx-1">{{trans('lang.student')}}  {{$course_info->total_students}}    {{trans('lang.enrolled')}} </span>
                    {{--                    <span class="mx-1">4.5 (25,428 تقييمات)</span>--}}
                </p>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center mb-3">
                <a href="{{route('courses.checkout',$course_info->id)}}"
                   class="btn register-btn m-1"> {{trans('lang.buy_this_course')}}</a>
                <a class="btn favourite m-1">{{trans('lang.Add_to_favorite')}}</a>
            </div>

        </div>
    </header>

    <!-- Main content -->
    <main>
        <section class="inner courseContent" style="margin-top: 3%">
            <div class="container">
                <div class="row">
                    <div class="card-col col-sm-12 col-md-3 mb-5">
                        <div class="card py-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item price d-flex align-items-center justify-content-center">
                                    <span class="current">{{$course_info->currency->symbol}}{{$course_info->price}}</span>
                                    <span class="past">$100</span>
                                    <span class="discount">50% خصم</span>
                                </li>
                                <li class="list-group-item text-center mb-2">30-يوم ضمان استعادة الأموال</li>
                                <li class="list-group-item text-center font-weight-bold my-2">
                                    اللغة: {{$course_info->language}}</li>
                                <li class="list-group-item text-center"> أخر
                                    تحديث:{{$course_info->updated_at->diffForHumans()}} </li>
                            </ul>
                            <p class="border-top p-3 mt-4 font-weight-bold">يتضمن الكورس هذا مايلي:</p>
                            <ul class="list-group list-group-flush px-3">
                                <li class="list-group-item">
                                    <i class="far fa-file-video"></i>
                                    <span>{{$course_info->duration}} hours on-demand video</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="far fa-newspaper"></i>
                                    <span>10 articles</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-file-download"></i>
                                    <span>5 downloadable resources</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-infinity"></i>
                                    <span>Full lifetime access</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-pencil-alt"></i>
                                    <span>Assignments</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-certificate"></i>
                                    <span>Certificate of Completion</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="content-col col-sm-12 col-md-9">
                        <div class="row">
                            <div class="col-12">
                                <!-- ما ستتعلمه -->
                                <section id="learn" class="colored-bg p-3">
                                    <h4>
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>سوف تتعلم مايلي</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">


                                            <i class="fa fa-check"></i>
                                            <span>{!! $course_info->what_learn !!}</span>

                                        </div>
                                    </div>
                                </section>
                                <!-- المتطلبات -->
                                <section id="require" class="p-3">
                                    <h4>
                                        <i class="fas fa-clipboard-list"></i>
                                        <span>المتطلبات</span>
                                    </h4>

                                    <span>{!! $course_info->requirements !!}</span>

                                </section>
                                <!-- الوصف -->
                                <section id="desc" class="p-3">
                                    <h4>
                                        <i class="fas fa-align-justify"></i>
                                        <span>الوصف</span>
                                    </h4>
                                    <p>{!! $course_info->description !!}</p>
                                </section>
                                <section id="content" class="p-3">

                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header colored-bg" id="headingOne">
                                                <h2 class="mb-0 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
                                                    <button class="btn btn-link btn-block text-left" type="button"
                                                            data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                        {{--                                                        <i class="fas fa-angle-up"></i>--}}
                                                        <span>المحتوى التعليمي</span>
                                                    </button>

                                                    <span class="duration">
                                                    <span>{{count($course_info->courseSubjects )}} محاضرة</span>
{{--                                                    <i class="fa fa-circle"></i>--}}
                                                        {{--                                                    <span>15 دقيقة</span>--}}
                                                </span>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                 data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach($course_info->courseSubjects as $subject)
                                                            <li class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center justify-content-between">
                                                        <span class="lesson_title"
                                                              onclick="changeVideo('{{$subject->subject_path}}')"
                                                              data-toggle="modal" data-target="#previewVideo">
                                                            <i class="fas fa-play-circle"></i>
                                                            <span class="open_video"
                                                            >{{$subject->name}}</span>
                                                        </span>
                                                                <span>{{ convertToHoursMins($subject->duration)}}</span>
                                                                {{--                                                                <span>{{$subject->is_free}}</span>--}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- المراجعات -->

                                <!-- التعليقات -->
                                <section id="comments" class="post-body p-3 mx-3">
                                    <div class="row post-comment-section m-0 p-0 border-0">
                                        <section class="col-sm-12 actionRequired">
                                            <form id="new-comment" class="new-comment m-0" action="">
                                                @csrf
                                                <input type="hidden" name="commentable_id" value="{{$course_info->id}}">
                                                <div class="form-group ">
                                                    <label for="comment">اكتب تعليقك</label>
                                                    <textarea name="comment" class="form-control"></textarea>
                                                </div>
                                                <button type="button" id="sendComment" class="btn">ارسل</button>
                                            </form>
                                        </section>


                                        <section class="w-100 m-0 comments">
                                            <h4>
                                                <i class="fas fa-comment-alt"></i>
                                                <span>التعليقات</span>
                                            </h4>
                                            <section class="list">
                                                <section class="nested-comment my-0 border-bottom">
                                                    <section class="comment-card">
                                                        <div class="row author">
                                                            <div class="col">
                                                                <p class="author-name">اسم صاحب التعليق</p>
                                                                <p class="date">20/05/2020 - 03:15</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،
                                                                    لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك
                                                                    أن تولد مثل هذا النص أو العديد من النصوص الأخرى
                                                                    إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. هذا
                                                                    النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <div class="action mx-3 mb-3">
                                                        <a class="btn" data-toggle="collapse" href="#collapse4"
                                                           role="button" aria-expanded="false"
                                                           aria-controls="collapse4">الرد على التعليق</a>
                                                    </div>
                                                    <section class="collapse nested mt-1" id="collapse4">
                                                        <section class="comment-card border">
                                                            <div class="row author">
                                                                <div class="col">
                                                                    <p class="author-name">اسم صاحب التعليق</p>
                                                                    <p class="date">20/05/2020 - 03:15</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس
                                                                        المساحة، لقد تم توليد هذا النص من مولد النص
                                                                        العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد
                                                                        من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى
                                                                        يولدها التطبيق. هذا النص هو مثال لنص يمكن أن
                                                                        يستبدل في نفس المساحة</p>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="comment-card border">
                                                            <div class="row author">
                                                                <div class="col">
                                                                    <p class="author-name">اسم صاحب التعليق</p>
                                                                    <p class="date">20/05/2020 - 03:15</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس
                                                                        المساحة، لقد تم توليد هذا النص من مولد النص
                                                                        العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد
                                                                        من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى
                                                                        يولدها التطبيق. هذا النص هو مثال لنص يمكن أن
                                                                        يستبدل في نفس المساحة</p>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <form class="mt-3 p-3" action="">
                                                            <div class="form-group">
                                                                <label for="comment">اكتب ردك على التعليق</label>
                                                                <textarea name="comment"
                                                                          class="form-control"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn">ارسل</button>
                                                        </form>
                                                    </section>
                                                </section>
                                                <a id="loadMore" class="btn">المزيد من التعليقات</a>
                                            </section>
                                        </section>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>



    {{--    <div class="modal fade" id="video_model" tabindex="-1" role="dialog" aria-labelledby="modal"--}}
    {{--         aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header   col-md-12">--}}
    {{--                    <div class=" text-left">--}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                            <span aria-hidden="true">&times;</span>--}}
    {{--                        </button>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <div class="modal-body" id="model_operation_body">--}}
    {{--                    <div style="padding:56.25% 0 0 0;position:relative;">--}}
    {{--                        <iframe id="model_video_url" src=""--}}
    {{--                                frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen--}}
    {{--                                style="position:absolute;top:0;left:0;width:100%;height:100%;"--}}
    {{--                                title="Vue Authentication- Preventing flickering (10_12)_2.mp4"></iframe>--}}
    {{--                    </div>--}}
    {{--                    <script src="https://player.vimeo.com/api/player.js"></script>--}}
    {{--                </div>--}}
    {{--                <div class="modal-footer">--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}



    <section class="modal fade" id="previewVideo" tabindex="-1" role="dialog" aria-labelledby="previewVideoLabel"
             aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-0 border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    {{--                    <video--}}
                    {{--                            id="my-video"--}}
                    {{--                            --}}{{--                            class="video-js"--}}
                    {{--                            class="video-js vjs-big-play-centered"--}}
                    {{--                            controls="true"--}}
                    {{--                            preload="auto"--}}
                    {{--                            responsive="true"--}}
                    {{--                            fluid="true"--}}
                    {{--                            aspectRatio="16:9"--}}
                    {{--                            data-setup="{}"--}}
                    {{--                            data-vimeo-id="562934321"--}}
                    {{--                    >--}}
                    {{--                        <source src="https://player.vimeo.com/video/562934321?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"--}}
                    {{--                                type="video/mp4"/>--}}
                    {{--                    </video>--}}

                    <div style="padding:56.25% 0 0 0;position:relative;">
                        <iframe id="my-video" src=""
                                frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                title="Vue Authentication- Preventing flickering (10_12)_2.mp4"></iframe>
                    </div>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                </div>
            </div>
        </div>
    </section>


@endsection


@section("scripts")
    {{--    <script src="{{ asset('js/video.min.js') }}"></script>--}}
    {{--    <script src="dist/js/videojs.js"></script>--}}

    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // var video = document.getElementById('my-video');
            // var player = new Vimeo.Player(video);


        });
    </script>

    <script>
        $(document).on("click", '#sendComment', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            $('#model_video_url').attr('src', url);
            $('#video_model').modal('show');

            $.easyAjax({
                url: '{{route('courses.add-comment')}}',
                container: '#new-comment',
                type: "POST",
                data: $('#new-comment').serialize(),
                success: function (response) {
                    console.log(response)
                }
            })

        });
    </script>
@endsection

