@extends('layouts.org_web.layout')
@section('content')

    <!-- Course Video Section Starts -->
    <section class="course-video-section padding-bottom-110">
        <div class="container" style="margin-top: 6%;">
            <div class="row">
                <div class="col-lg-8 p-0 order-2 order-lg-1">
                    <div class="course-video-part">
                        <video controls>
                            <source src="{{asset('/org_assets/dist/videos/lessonSample.mp4')}}"  type="video/mp4"/>
                        </video>
                    </div>

                    <div class="course-video-tab padding-top-60">
                        <div class="tab">
                            <ul>
                                <li class="tab-one active">
                                    <span>{{trans('lang.overview')}}</span>
                                </li>
{{--                                <li class="tab-two">--}}
{{--                                    <span>Q&A</span>--}}
{{--                                </li>--}}
                                <li class="tab-three">
                                    <span>{{trans('lang.note')}}</span>
                                </li>
                                <li class="tab-four">
                                    <span>{{trans('lang.Comments')}}</span>
                                </li>
                            </ul>
                            <div class="hr-line"></div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-one-content tab-content-bg overview-content lost active">
                                <div class="video-tab-title">
                                    <h5>عن الكورس </h5>
                                </div>
                                <p class="margin-top-20"> هنا وصف عن الكورس </p>
                                <div class="video-tab-title margin-top-30">
                                    <h5>{{trans('lang.what_will_u_learn')}}</h5>
                                </div>
                                <div class="content-list-items margin-top-20">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> ماذا تتعلم من الكورس هذا</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="video-tab-title margin-top-30">
                                    <h5>بالارقام</h5>
                                </div>
                                <div class="content-list-items margin-top-20">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> {{trans('lang.level')}} : مبتدئ </span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> {{trans('lang.lectures')}} : 50</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> {{trans('lang.students')}} : 1050</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> {{trans('lang.duration')}} : 3</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i>{{trans('lang.language')}} : عربي</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-tab-title margin-top-30">
                                    <h5>الشهادة</h5>
                                </div>
                                <p class="margin-top-20">ستحصل على شهادة بعد هذا الكورس</p>
                                <div class="video-tab-title margin-top-30">
                                    <h5>description</h5>
                                </div>
                                <p class="margin-top-20">This course is aimed at teaching photographers what it takes to improve your techniques to earn more money.You'll start with the basics and tackle how a camera operates, the types of cameras and lenses available, and equipment you'll need for accomplishing your goals. </p>
                                <span class="uppercase-font">UPDATED WITH A 273-PAGE NOTEBOOK & NEW LESSONS</span>
                                <p class="margin-top-20">This online photography course will teach you how to take amazing images and even sell them, whether you use a smartphone, mirrorless or DSLR camera. </p>
                                <ul class="caret-list">
                                    <li><i class="fa fa-caret-right"></i> What do all these packages, tools, libraries and frameworks do?</li>
                                    <li><i class="fa fa-caret-right"></i> What IS a library and what's the difference to a framework?</li>
                                    <li><i class="fa fa-caret-right"></i> Which framework should you learn? Angular, React.js or Vue.js?</li>
                                    <li><i class="fa fa-caret-right"></i> What about jQuery?</li>
                                </ul>
                                <div class="video-tab-title margin-top-30">
                                    <h5>what you will learn</h5>
                                </div>
                                <ul class="caret-list">
                                    <li><i class="fa fa-caret-right"></i> Understand how cameras work and what gear you need</li>
                                    <li><i class="fa fa-caret-right"></i> Master shooting in manual mode and understanding your camera</li>
                                    <li><i class="fa fa-caret-right"></i> Know what equipment you should buy no matter what your budget</li>
                                    <li><i class="fa fa-caret-right"></i> Follow our practical demonstrations to see how we shoot in real-world scenarios</li>
                                </ul>
                            </div>

                            <div class="tab-two-content tab-content-bg q-a-content lost">
                                <div class="header-search">
                                    <form action="#">
                                        <input type="text" placeholder="Search Question">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="video-tab-title margin-top-30">
                                    <h5>10 questions in this course</h5>
                                </div>
                                <div class="hr-line"></div>
                                <div class="single-question">
                                    <div class="question-image">
                                        <img  src="{{asset('/org_assets/dist/img/courseimg/question-image.png')}}"  alt="image">
                                    </div>
                                    <div class="question-content">
                                        <h6>how to install wordpress in cpanel?</h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                        <div class="content-bottom">
                                            <h6>john doe</h6>
                                            <span>5 min ago</span>
                                            <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-question">
                                    <div class="question-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/question-image.png')}}"  alt="image">
                                    </div>
                                    <div class="question-content">
                                        <h6>how to install wordpress in cpanel?</h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                        <div class="content-bottom">
                                            <h6>john doe</h6>
                                            <span>5 min ago</span>
                                            <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-question">
                                    <div class="question-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/question-image.png')}}"  alt="image">
                                    </div>
                                    <div class="question-content">
                                        <h6>how to install wordpress in cpanel?</h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                        <div class="content-bottom">
                                            <h6>john doe</h6>
                                            <span>5 min ago</span>
                                            <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-question">
                                    <div class="question-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/question-image.png')}}"  alt="image">
                                    </div>
                                    <div class="question-content">
                                        <h6>how to install wordpress in cpanel?</h6>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                        <div class="content-bottom">
                                            <h6>john doe</h6>
                                            <span>5 min ago</span>
                                            <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-three-content tab-content-bg note-content lost">
                                <div class="header-search">
                                    <form action="#">
                                        <input type="text" placeholder="Create New Note">
                                        <button type="submit"><i class="fa fa-plus"></i></button>
                                    </form>
                                </div>
                                <span>Click the "Create a new note" box, the "+" button, or press "N" to make your first note.</span>
                            </div>

                            <div class="tab-four-content tab-content-bg announcement-content lost">
                                <div class="announcement-top">
                                    <div class="top-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-2.png')}}"  alt="image">
                                    </div>
                                    <div class="top-name">
                                        <h6>john doe</h6>
                                        <span>product designer</span>
                                    </div>
                                </div>
                                <h5>My 7 Favorite Learning & Growth Techniques</h5>
                                <p class="margin-top-20">Hey! <br>A lot of you have asked me for my personal approach towards learning, how I learn new things and how I overcome motivational issues.In this article and video, I share my seven favorite techniques,</p>

                                <p class="margin-top-20">"hacks" and thoughts on those topics - and I hope they are helpful to you as well!</p>

                                <p class="margin-top-20">Unfortunately this will result in delayed responses by me in the Q&A section and to direct messages. This is only for the next week and once back I will be back to 100%.</p>

                                <p class="margin-top-20">I will continue to do my best to respond to as many questions as possible but only one person, regularly I spend 4-5 hours daily on this and with over 440000 students as you can image that its a lot of work.</p>
                                <div class="announcement-comment margin-top-30">
                                    <div class="comment-image">
                                        <img  src="{{asset('/org_assets/dist/img/courseimg/course-instructor-3.png')}}"  alt="image">
                                    </div>
                                    <div class="header-search">
                                        <form action="#">
                                            <input type="text" placeholder="Create New Note">
                                            <button type="submit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0 order-1 order-lg-2">
                    <div class="video-playlist-sidebar">
                        <h4>WordPress Development</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">introduction</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 01
                                                </a>
                                                <span>02:50</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 02
                                                </a>
                                                <span>03:20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">basic knowledge</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 01
                                                </a>
                                                <span>02:50</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 02
                                                </a>
                                                <span>03:20</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 03
                                                </a>
                                                <span>04:10</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 04
                                                </a>
                                                <span>07:20</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 05
                                                </a>
                                                <span>08:40</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">theme development</a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 01
                                                </a>
                                                <span>02:50</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 02
                                                </a>
                                                <span>03:20</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 03
                                                </a>
                                                <span>04:10</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 04
                                                </a>
                                                <span>07:20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <a href="#" role="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">plugin development</a>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 01
                                                </a>
                                                <span>02:50</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 02
                                                </a>
                                                <span>03:20</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 03
                                                </a>
                                                <span>04:10</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 04
                                                </a>
                                                <span>07:20</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 05
                                                </a>
                                                <span>08:40</span>
                                            </div>
                                            <div class="single-course-video">
                                                <a href="#" class="button-video">
                                                    <i class="fa fa-play-circle"></i> lesson 06
                                                </a>
                                                <span>08:40</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section Starts -->
    <section class="cta-section gradient-bg padding-top-60 padding-bottom-30">
        <div class="cta-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="image" class="plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title margin-bottom-40">
                        <h2>enhance your skills with <span>best online course</span></h2>
                    </div>
                    <div class="cta-button">
{{--                        <a href="#" class="template-button margin-right-20">start teaching</a>--}}
                        <a href="#" class="template-button-2">start learning</a>
                    </div>
                </div>
                <div class="col-xl-4 offset-xl-2 col-lg-6">
                    <div class="cta-image">
                        <img src="{{asset('/org_assets/dist/img/courseimg/cta-image.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
