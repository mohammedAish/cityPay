@extends('home.index')
@section('keywords')

 
    <!--Hero Area -->
    <section class="hero-section" style="background-image: url('{{asset('org_assets/dist/home/images')}}/map.jpg');">
        <div class="hero-area">
            <div id="particles-js"></div>
            <div class="single-hero">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-11 centered">
                            <div class="hero-sub">
                                <div class="table-cell">
                                    <div class="hero-left">
                                        <h4>SEND - RECEIVE - SHOPING - WORLDWIDE</h4>
                                        <h1>SEND & RECEIVE MONEY JUST IN A SECOND AROUND THE GLOBE</h1>
                                        <p>MULTI CURRENCY - DEVELOPER FRIENDLY - READY </p>
                                        <a href="{{route('userRegister')}}" class="bttn-mid btn-fill"><i class="fas fa-user"></i>{{trans('lang.register')}}</a>
                                        <a href="{{url('/login')}}" class="bttn-mid btn-emt"><i class="fas fa-key"></i>{{trans('lang.login')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <!--/Hero Area -->

    <section id="about" class="about-area">
        <div class="about-content mid-bg-gray wow fadeInUp" data-wow-delay="0.4s">
            <div class="about-content-inner-2">
                <div class="section-title mb-10">
                    <h4>WHAT WE DO</h4>
                    <h2>About Us</h2>
                </div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias, aliquam commodi deleniti dicta ducimus ea eligendi est exercitationem expedita facilis harum inventore iste iusto maiores maxime molestias obcaecati provident quod ratione similique soluta suscipit totam unde voluptatem. Delectus enim et incidunt placeat tempora. Blanditiis corporis eius eveniet ipsa minima molestias nobis placeat, provident saepe sint! Ab asperiores atque consequuntur est, eveniet, illum nulla quidem quos reiciendis rerum veniam veritatis vitae voluptatibus. Accusamus enim minus mollitia non porro quidem ullam. Eligendi ipsam iste laborum maxime placeat reprehenderit? Animi delectus deleniti, error explicabo illum natus omnis suscipit temporibus! Adipisci dignissimos distinctio doloribus, ea est harum inventore laborum,
                </p>
            </div>
        </div>
        <div class="about-left wow fadeInUp section-padding" data-wow-delay="0.4s">
            <div class="left-img-wrap">
                <img src="{{asset('org_assets/dist/img/about2.jpg')}}" alt="about" style="width: 100%;">
            </div>
        </div>
    </section>  

    <!--feature Area -->
    <section id="how-it-work" class="feature-area section-padding-2 work gradient-overlay" style="background-image: url('{{asset('org_assets/dist/home/images')}}/work_bg_img.jpg');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title cl-white">
                        <h2>How The System Works</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

            </div>


            <div class="row justify-content-center">

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="single-feature-2 bottom-after  ">
                        <i class="fas fa-wallet"></i>
                        <h4>wallet</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="single-feature-2 bottom-before ">
                        <i class="fas fa-wallet"></i>
                        <h4>wallet</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="single-feature-2   ">
                        <i class="fas fa-wallet"></i>
                        <h4>wallet</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>


            </div>
        </div>
    </section>  
    <!--/feature Area -->



    <!--Section -->
    <section id="services" class="section-padding-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 centered">
                    <div class="section-title">
                        <h2>title</h2>
                        <p>short_details</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center centered">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-box">
                        <i class="fab fa-btc"></i>
                        <h3>title</h3>
                        <p>sub_title</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-box">
                        <i class="fab fa-btc"></i>
                        <h3>title</h3>
                        <p>sub_title</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-box">
                        <i class="fab fa-btc"></i>
                        <h3>title</h3>
                        <p>sub_title</p>

                    </div>
                </div>

            </div>
        </div>
    </section>  

    <!--/Section-->  

    <!-- Team Area -->
    <section  class="team-area gradient-overlay section-padding-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title cl-white">
                        <h4>title</h4>
                        <h2>short_details</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single-team-4">
                        <img src="{{asset('org_assets/dist/home/images/default.png')}}" alt="name">
                        <div class="team-content cl-black">
                            <h4>name</h4>
                            <p>designation</p>
                            <div class="social">
                                <a href="#" class="cl-facebook"> <i class="fab fa-facebook-f"></i></a>

                                <a href="#" class="cl-twitter"><i class="fab fa-twitter"></i></a>

                                <a href="#" class="cl-linkedin"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  

    <!-- /Team Area -->




    <!-- How it works Area -->


    <section id="why-choose-us" class="section-padding-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 centered">
                    <div class="section-title">
                        <h2>title</h2>
                        <p>short_details</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center centered">

                <div class="col-md-6 col-sm-10 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single-box">
                        <i class="fas fa-hockey-puck"></i>
                        <h3>title</h3>
                        <p>sub_title</p>

                    </div>
                </div>
            </div>
        </div>
    </section>   


    <!-- /How it works Area -->



    <!-- Review Area -->
    <section id="testimonial" class="review-area section-padding gradient-overlay cl-white">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h2>title</h2>
                        <p>short_details</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.4s">

                    <div class="testimonials owl-carousel">
                        <div class="single-review">
                            <div class="reviewer-thumb">
                                <img src="{{asset('org_assets/dist/home/images/default.png')}}" alt="author">
                                <h3>author</h3>
                                <span>designation</span>
                            </div>
                            <p>quote</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>  
    </section>   
    <!-- /Review Area -->


    <!-- Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="faq-contents">
                        <ul class="accordion">
                            <li>
                                <a href="#"><i class="far fa-hand-point-right"></i>  or were this. Perfectly did suspicion daughters but his intention.</a>
                                <p>Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating. Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.</p>
                            </li>
                            <li>
                                <a href="#"><i class="far fa-hand-point-right"></i>  or were this. Perfectly did suspicion daughters but his intention.</a>
                                <p>Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating. Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.</p>
                            </li>

                            <li>
                                <a href="#"><i class="far fa-hand-point-right"></i>  or were this. Perfectly did suspicion daughters but his intention.</a>
                                <p>Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating. Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.</p>
                            </li>

                            <li>
                                <a href="#"><i class="far fa-hand-point-right"></i>  or were this. Perfectly did suspicion daughters but his intention.</a>
                                <p>Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating. Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.Doubtful two bed way pleasure confined followed. Shew up ye away no eyes life or were this. Perfectly did suspicion daughters but his intention. Started on society an brought it explain. Position two saw greatest stronger old. Pianoforte if at simplicity do estimating.</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>   
    <!-- /Section -->





    <!--We Accept Brands Area -->
    <section class=" section-padding pm gradient-overlay cl-white"  style="background-image: url({{ get_image(config('constants.frontend.bgimage.path') .'/'. 'pm_bg_img.jpg') }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 centered">
                    <div class="section-title">
                        <h2>Payment We Accept</h2>
                    </div>
                </div>
            </div>
            <div class="owl-theme owl-carousel payment-slider">
                <div class="single-brands">
                    <a href="#" title="name"><img src="{{asset('org_assets/dist/home/images/pm_bg_img.jpg')}}" alt="img"></a>
                </div>

            </div>


        </div>
    </section>   
    <!--/Brands Area-->


    <!--Blog Area -->
    <section class="blog-area section-padding-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h4>Announcement</h4>
                        <h2>Recent Announcement</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single-blog-2">
                        <div class="single-blog-img">
                            <img src="{{asset('org_assets/dist/home/images/pm_bg_img.jpg')}}" alt="img">
                            <a href="#"><i class="fas fa-expand"></i></a>
                        </div>
                        <div class="single-blog-content">
                            <div class="blog-meta">
                                <span><a href=""><i class="far fa-calendar-alt"></i>15-6-2020</a></span>
                            </div>
                            <h3><a href="#">32</a></h3>
                            <p>kskskmdk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
    <!--/Blog Area-->


@endsection


@section('import-css')



@endsection





