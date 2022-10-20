<!DOCTYPE html>
@if (app()->getLocale() == 'ar')

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CTPAY</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets_v3/assets/img/favicon.png" rel="icon">
    <link href="assets_v3/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets_v3/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets_v3/assets/css/style.css" rel="stylesheet">

</head>

<body dir="rtl">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top style-rtl" >
        <div class="container-fluid d-flex justify-content-around ">

            <h1 class="logo ">
                <a href="index.html">
                    <img src="assets_v3/assets/img/logo.png" class="img-fluid " alt="">
                </a>
            </h1>

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">الرئيسية</a></li>
                    <li><a class="nav-link scrollto" href="#Aboutus">عنا</a></li>
                    <li><a class="nav-link scrollto" href="#services">خدماتنا</a></li>
                    <li><a class="nav-link scrollto " href="#howsysteme">كيف تعمل</a></li>
                    <li><a class="nav-link scrollto" href="#Whychooseus">لماذا تختارنا</a></li>
                    <li><a class="nav-link scrollto" href="#paymant">نقبل الدفع</a></li>

                    <li><a class="nav-link scrollto" href="#contact">اتصل بنا</a></li>
                    <li class="dropdown w-25">
                        <a href="#">
                            <span>
                                <i class="fas fa-globe"></i>
                            </span> <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>

                            <li class="navLang">
                                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                    <img src="assets_v3/assets/img/icons/Language.png" /> AR
                                </a>
                            </li>
                            <li class="navLang">
                                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                    <img src="assets_v3/assets/img/icons/Engilsh.png" /> EN
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="align-items-center style-rtl">

        <div class="container ">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <p class="Title-banner" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        حقق العالمية ، واجمع اصولك في مكان واحد

                    </p>
                    <p class="bio-banner" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        محفظة سيتي باي هي علامة تجارية مملوكة بالكامل لشركة يتداول المالية المحدودة ، وهي شركة بريطانية مسجلة في إنجلترا وويلز ، توفرها لجميع العملاء لتنفيذ المعاملات المهنية المؤهلة من خلال المحفظة. ،

                    </p>
                    <div class="d-flex">
                        <ul class="btn-banner">
                            <li>
                                <a href="#about" class="btn-register " data-aos="fade-left" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                    <i class="fas fa-user px-2"></i>
                                    إنشاء حساب
                                </a>
                            </li>
                            <li>

                                <a href="#about" class="btn-login " data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                    <i class="fas fa-key px-2"></i>
                                    تسجيل الدخول
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets_v3/assets/img/Assetbanner.png" class="img-fluid " alt="" data-aos="zoom-out-down" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                </div>
            </div>

        </div>

    </section><!-- End Hero -->



    <main id="main" class="style-rtl">
        <div class="icon-boxes  ">
            <div class="container position-relative">
                <div class="row gy-4 mt-1 ">

                    <div class="col-md-3  my-3 crad-reponisve " data-aos="flip-left"data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">
                             <img src="assets_v3/assets/img/icons/send.png" class="img-fluid icon" />
                             <h4 class="title pt-3">ارسل</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/payment-method.png" class="img-fluid icon" />

                            <h4 class="title pt-3">استقبل</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/arrow.png" class="img-fluid icon" />

                            <h4 class="title pt-3">إيداع</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/transfer-money.png" class="img-fluid icon" />

                            <h4 class="title pt-3">تحويل</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                </div>
            </div>
        </div>
        <!-- ======= Featured Services Section ======= -->
        <!-- ======= About Section ======= -->
        <section id="Aboutus" class="about">
            <div class="container ">
                <div class="section-title ">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        ماذا تعرف عنا
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets_v3/assets/img/aboutTs.png" class="img-fluid" alt="" data-aos="zoom-out-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">

                        <div class="section-header">
                            <h2 class="titl-aboutus" data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                عن الشركة
                            </h2>
                            <p class="bio-aboutus" data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                محفظة سيتي باي هي علامة تجارية مملوكة بالكامل لشركة يتداول المالية المحدودة ، وهي شركة بريطانية مسجلة في إنجلترا وويلز ، توفرها لجميع العملاء لتنفيذ المعاملات المهنية المؤهلة من خلال المحفظة. ، وكذلك ضمان خدمة عالية الجودة ، و معاملة ناجحة وآمنة .
                            </p>
                        </div>


                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <section id="services" class="services ">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        خدماتنا
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        جميع أصولك الرقمية في مكان واحد ، تحكم بشكل كامل في رصيدك<br />
                        واجعل مدفوعاتك اسهل عن طريق محفظتك الخاصة.
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6  d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="far fa-credit-card"></i>
                            <h4>
                                اصدار البطاقات الرقمية
                            </h4>
                            <p>
                                احصل على بطاقة رقمية لدفع اسرع للمتاجر الرقمية
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6   align-items-stretch mt-4 " data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box ">
                            <i class="fas fa-money-bill-wave"></i>
                            <h4>
                                سحب الارباح
                            </h4>
                            <p>
                                ارباحك على النت اسبحها كاش
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-money-check"></i>
                            <h4>
                                تغذية حسابات التداول
                            </h4>
                            <p>
                                وفر على نفسك العناء واهتم فقط بالصفقات لجني الأرباح
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-university"></i>
                            <h4>
                                تغذية البنوك الالكترونية
                            </h4>
                            <p>
                                رصيدك الإلكتروني في أي بنك الإلكتروني تحكم به بمحفظة واحده
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6  align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-chart-line"></i>
                            <h4>
                                اسعار الصرف
                            </h4>
                            <p>
                                تابع اسعار صرف العملات الاجنبية اولا باول
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-shopping-cart"></i>
                            <h4>
                                التسوق عبر الانترنت
                            </h4>
                            <p>
                                سدد فواتير مشترياتك واشتراكاتك على الانترنت بدون عناء
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Services Section -->
        <section id="howsysteme" class="onfocus">
            <div class="container-fluid p-0" data-aos="fade-up">

                <div class="row g-0">
                    <div class="col-lg-6 video-play position-relative" data-aos="flip-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                    </div>
                    <div class="col-lg-6" >
                        <div class="content d-flex flex-column justify-content-center h-100" data-aos="flip-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                            <h3 class="title-image-system py-2">
                                <i class="bi bi-check-circle px-2"></i>
                                كيف يعمل النظام
                            </h3>
                            <p class="bio-section-titel-image px-5">
                                الطريقة السهلة لتحويل العملات الأجنبية باستخدام نظام ستي باي مهمة سهلة. تمتع بالتحكم الكامل
                                <br />
                                والمقتنيات من خلال تخزينها على جهازك الخاص مع النظام.

                            </p>
                            <div class="row">
                                <div class="col-md-3  box-systemes  my-1 card-systeme-responsive">
                                    <i class="far fa-address-card icons-step text-white"></i>
                                    <h4>
                                        فعل حسابك
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-arrow-up icons-step text-white"></i>
                                    <h4>
                                        اودع
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-wallet icons-step text-white"></i>
                                    <h4>
                                        المحفظة
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="far fa-file-alt icons-step text-white"></i>
                                    <h4>
                                        العمليات
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-lock icons-step text-white"></i>
                                    <h4>
                                        الأمان
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-arrow-circle-down icons-step text-white"></i>
                                    <h4>
                                        استلم
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End On Focus Section -->


        <section id="Whychooseus" class="testimonials mt-3 ">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        لماذا تختارنا
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        هدفنا هو تقديم خدمة محفظة جيدة وموثوقة للمستخدم مع ضمان معاملات آمنة ومأمونة.
                    </p>
                </div>

                <div class="testimonials-slider swiper" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide ">
                            <div class="testimonial-item ">
                                <div class="single-box">
                                    <i class="fas fa-fingerprint"></i>
                                    <h4>
                                        سهولة
                                    </h4>
                                    <p>
                                        يعمل نظامنا بجميع وسائل الدفع بكل سهوله التي يتمتع بنظام إيداع وسحب سهل
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <h4>
                                        قبول جميع المدفوعات
                                    </h4>
                                    <p>
                                        اجمع رصيدك الإلكتروني من جميع محافظ المدفوعات الرقمية واجعله في نظام واحد
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-hockey-puck"></i>
                                    <h4>
                                        رسوم منخفضة
                                    </h4>
                                    <p>
                                        تدعم محفظة سيتي باي نظام حديث وباستخدام هذه الخدمة تحصل على أفضل رسوم تحويل في جميع أنحاء العالم.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="far fa-copy"></i>
                                    <h4>
                                        معتمد
                                    </h4>
                                    <p>
                                        نحن شركة معتمدة تمارس أنشطة قانونية تمامًا. نحن معتمدون وآمنون.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-lock"></i>
                                    <h4>
                                        أمن
                                    </h4>
                                    <p>
                                        نعمل باستمرار على تحسين نظامنا ومستوى الأمان لدينا لتقليل أي مخاطر محتملة
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-globe-asia"></i>
                                    <h4>
                                        عالمي
                                    </h4>
                                    <p>
                                        نحن شركة دولية تعمل على مستوى العالم ولدينا عملاء من مختلف أنحاء العالم
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->
        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                        <div class="content px-xl-5">
                            <h4 class="Titel-Asked " data-aos="fade-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                <strong style="color:#e51d39;">الأسئلة </strong>
                                الشائعة
                            </h4>
                        </div>
                        <div class="accordion accordion-flush px-xl-5" id="faqlist">

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1100">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- # Faq item-->
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div><!-- # Faq item-->




                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 pt-5 order-lg-2 img" data-aos="zoom-out-right" data-aos-delay="200" data-aos-duration="1200">
                        <img src="assets_v3/assets/img/querwith.png" class="img-fluid" />
                    </div>
                </div>

            </div>
        </section><!-- End F.A.Q Section -->
        <!-- ======= Testimonials Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        ماذا يقول عنا العملاء
                    </h2>
                </div>

                <div class="clients-slider swiper" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Testimonials Section -->



        <section id="Blogs" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        المقالات والاعلانات
                    </h2>
                </div>

                <div class="Blogs-slider swiper" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i>
                                                مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i>
                                                Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i>
                                                12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        أقرا المزيد
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i>
                                                مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i>
                                                Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i>
                                                12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        أقرا المزيد
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i>
                                                مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i>
                                                Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i>
                                                12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        أقرا المزيد
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>







        <section id="paymant" class=" my-3">
            <div class="container">


                <div class="row justify-content-around">
                    <div class="col-md-4 pt-4 pt-lg-0 content">
                        <div class="section-header">
                            <h2 class="titl-aboutus" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                                نقبل الدفع بـ
                            </h2>
                            <p class="bio-aboutus" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                نحن ندعم العمل مع أكثر من وسيلة لتحويل استلام أموالك
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6" style="flex-wrap:wrap!important;">
                        <div class="d-flex flex-row">
                            <div class="logo-company-top-right">
                                <img src="assets_v3/assets/img/icons/1.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="500" />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/2.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="600"  />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/3.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="700" />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/4.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="800" />
                            </div>
                            <div class="logo-company-top-left">
                                <img src="assets_v3/assets/img/icons/5.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="900" />
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="logo-company-bottom-right ">
                                <img src="assets_v3/assets/img/icons/6.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/7.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1100" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/8.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1200" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/9.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1300" />
                            </div>
                            <div class="logo-company-bottom-left">
                                <img src="assets_v3/assets/img/icons/10.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1400" />
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>

        <!-- ======= Cta Section ======= -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        تواصل معنا
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        ابعث رسالتك وملاحظاتك لفريق الدعم في
                        <b class="name-web">CTPAY</b>
                        <br />
                        وسيتم التواصل معك بأسرع وقت
                    </p>
                </div>

                <div class="row">


                    <div class="col-lg-7 my-sm-3  d-flex align-items-stretch" data-aos="zoom-in-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">الاسم بالكامل</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <label class="required">البريد الالكتروني</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="required">العنوان</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="required">تقديم استفسار أو اقتراح أو شكوى</label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-contactus">أرسل رسالة</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-5 my-sm-3 d-flex align-items-stretch" data-aos="zoom-in-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4 class="title-contactus">الموقع :</h4>
                                <p>128 City Road, London, EC1V 2NX</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>البريد الإلكتروني :</h4>
                                <p>support@ctpay.uk</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>رقم الهاتف :</h4>
                                <p>+447451273774</p>
                            </div>

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.2357497086928!2d-0.0886604!3d51.5272357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ca671a6cfb7%3A0x9320c88f0a927f3f!2zMTI4IENpdHkgUmQsIExvbmRvbiBFQzFWIDJOWNiMINin2YTZhdmF2YTZg9ipINin2YTZhdiq2K3Yr9ip!5e0!3m2!1sar!2s!4v1662109627809!5m2!1sar!2s" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer" class="style-rtl">

        <div class="footer-top">

            <div class="container">

                <div class="row ">
                    <div class="col-lg-3 style-right">

                        <a href="index.html">
                            <img src="assets_v3/assets/img/logoFooter.png" alt="">
                        </a>
                        <h4 class="Title-Links">
                            الشركة
                        </h4>
                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#hero" class="scrollto">
                                    عنا
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#Whychooseus" class="scrollto">
                                    لماذا تختارنا
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#services" class="scrollto">
                                    خدماتنا
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#paymant" class="scrollto">
                                    نقبل الدفع بـ
                                </a>
                            </li>

                        </ul>


                    </div>
                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            انضم إلينا
                        </h4>

                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#Blogs" class="scrollto">
                                    المقالات والاعلانات
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#clients" class="scrollto">
                                    آراء العملاء
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#contact" class="scrollto">
                                    اتصل بنا
                                </a>
                            </li>

                            <li class="Footer-Links">
                                <a href="#howsysteme" class="scrollto">
                                    كيف يعمل النظام
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            سياستنا
                        </h4>

                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#faq" class="scrollto">
                                    الأسئلة الشائعة
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('agreement')}}">
                                    اتفاقية المستخدم
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('privacy')}}">
                                    سياسة الامان والخصوصية
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('licenses')}}">
                                    التراخيص
                                </a>
                            </li>


                        </ul>

                    </div>

                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            تواصل معنا
                        </h4>
                        <div class="social-links pt-1">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                        <h4 class="Title-Links pt-2">
                            انتظروا تحميل التطبيق
                        </h4>
                        <ul class="Links pt-3" style="display:inline-flex!important;">
                            <li class="Footer-Links mx-1">
                                <a href="#">
                                    <img width="120" height="40" src="assets_v3/assets/img/icons/app-1.png" />

                                </a>
                            </li>
                            <li class="Footer-Links mx-1">
                                <a href="#">
                                    <img width="120" height="40" src="assets_v3/assets/img/icons/app-2.png" />

                                </a>
                            </li>
                        </ul>

                    </div>
                </div>




            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span style="color:#e51d39!important;">CRPAY</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>





    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 120, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 400, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: true, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });
    </script>

    <script src="assets_v3/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_v3/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_v3/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_v3/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets_v3/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_v3/assets/vendor/php-email-form/validate.js"></script>


    <script src="assets_v3/assets/js/main.js"></script>

</body>

</html>
@else
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CTPAY</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets_v3/assets/img/favicon.png" rel="icon">
    <link href="assets_v3/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets_v3/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets_v3/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets_v3/assets/css/Ltr.css" rel="stylesheet" />

</head>

<body dir="rtl">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top style-rtl">
        <div class="container-fluid d-flex justify-content-around ">

            <h1 class="logo ">
                <a href="index.html">
                    <img src="assets_v3/assets/img/logo.png" class="img-fluid " alt="">
                </a>
            </h1>

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#Aboutus">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="#howsysteme">Evidence</a></li>
                    <li><a class="nav-link scrollto" href="#Whychooseus">Why choose us</a></li>
                    <li><a class="nav-link scrollto" href="#paymant">Paymant</a></li>

                    <li><a class="nav-link scrollto" href="#contact">Contact us</a></li>
                    <li class="dropdown w-25">
                        <a href="#">
                            <span>
                                <i class="fas fa-globe"></i>
                            </span> <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>


                            <li class="navLang">
                                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                    <img src="assets_v3/assets/img/icons/Language.png" /> AR
                                </a>
                            </li>
                            <li class="navLang">
                                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                    <img src="assets_v3/assets/img/icons/Engilsh.png" /> EN
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="align-items-center style-rtl">

        <div class="container ">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <p class="Title-banner" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Go global, collect your assets in one place
                    </p>
                    <p class="bio-banner" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        CityPay Wallet is a wholly owned brand of Tadawul Financial Limited, a British company registered in England and Wales, which makes it available to all clients to carry out qualified professional transactions through the wallet. ,

                    </p>
                    <div class="d-flex">
                        <ul class="btn-banner">
                            <li>
                                <a href="#about" class="btn-register " data-aos="fade-left" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                    <i class="fas fa-user px-2"></i> Register
                                </a>
                            </li>
                            <li>

                                <a href="#about" class="btn-login " data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                    <i class="fas fa-key px-2"></i> Login
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets_v3/assets/img/Assetbanner.png" class="img-fluid " alt="" data-aos="zoom-out-down" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                </div>
            </div>

        </div>

    </section>
    <!-- End Hero -->



    <main id="main" class="style-rtl">
        <div class="icon-boxes  ">
            <div class="container position-relative">
                <div class="row gy-4 mt-1 ">

                    <div class="col-md-3  my-3 crad-reponisve " data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">
                            <img src="assets_v3/assets/img/icons/send.png" class="img-fluid icon" />
                            <h4 class="title pt-3">Send</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/payment-method.png" class="img-fluid icon" />

                            <h4 class="title pt-3">Received</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/arrow.png" class="img-fluid icon" />

                            <h4 class="title pt-3">Deposit</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                    <div class="col-md-3 my-3 crad-reponisve" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="icon-box-services ">

                            <img src="assets_v3/assets/img/icons/transfer-money.png" class="img-fluid icon" />

                            <h4 class="title pt-3">Transformation</h4>
                        </div>
                    </div>
                    <!--End Icon Box -->

                </div>
            </div>
        </div>
        <!-- ======= Featured Services Section ======= -->
        <!-- ======= About Section ======= -->
        <section id="Aboutus" class="about">
            <div class="container ">
                <div class="section-title ">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        know about us
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="assets_v3/assets/img/aboutTs.png" class="img-fluid" alt="" data-aos="zoom-out-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">

                        <div class="section-header">
                            <h2 class="titl-aboutus" data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                About us
                            </h2>
                            <p class="bio-aboutus" data-aos="fade-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                                CityPay Wallet is a wholly owned brand of Tadawul Financial Limited, a British company registered in England and Wales, which makes it available to all clients to carry out qualified professional transactions through the wallet. As well as ensuring high
                                quality service, a successful and safe transaction.
                            </p>
                        </div>


                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <section id="services" class="services ">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Our Services
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        All your digital assets in one place, take complete control of your balance
                        <br /> And make your payments easier through your own wallet.
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6  d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="far fa-credit-card"></i>
                            <h4>
                                Issuance of Digital Cards

                            </h4>
                            <p>
                                Get a digital card for faster payment to digital stores
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6   align-items-stretch mt-4 " data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box ">
                            <i class="fas fa-money-bill-wave"></i>
                            <h4>
                                Profit Withdrawal
                            </h4>
                            <p>
                                Your online earnings, withdraw them as cash
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-money-check"></i>
                            <h4>
                                Feed Trading Accounts
                            </h4>
                            <p>
                                Save yourself the trouble and only take care of deals to make profits
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-university"></i>
                            <h4>
                                Electronic Bank Feed
                            </h4>
                            <p>
                                Your electronic balance in any electronic bank is controlled by one wallet
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6  align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-chart-line"></i>
                            <h4>
                                Exchange Prices
                            </h4>
                            <p>
                                Keep track of foreign exchange rates first hand
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="single-box">
                            <i class="fas fa-shopping-cart"></i>
                            <h4>
                                Online shopping

                            </h4>
                            <p>
                                Pay your bills for purchases and subscriptions online without hassle
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Services Section -->
        <section id="howsysteme" class="onfocus">
            <div class="container-fluid p-0" data-aos="fade-up">

                <div class="row g-0">
                    <div class="col-lg-6 video-play position-relative" data-aos="flip-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                    </div>
                    <div class="col-lg-6">
                        <div class="content d-flex flex-column justify-content-center h-100" data-aos="flip-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                            <h3 class="title-image-system py-2">
                                <i class="bi bi-check-circle px-2"></i> How does the system work ?
                            </h3>
                            <p class="bio-section-titel-image px-5">
                                The easy way to convert foreign currency using CityPay system is an easy task. Enjoy complete control and collectibles by storing on your own device with the system.

                            </p>
                            <div class="row">
                                <div class="col-md-3  box-systemes  my-1 card-systeme-responsive">
                                    <i class="far fa-address-card icons-step text-white"></i>
                                    <h4>
                                        Account Verification
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-arrow-up icons-step text-white"></i>
                                    <h4>
                                        Deposit
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-wallet icons-step text-white"></i>
                                    <h4>
                                        Wallet
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="far fa-file-alt icons-step text-white"></i>
                                    <h4>
                                        Transactions
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-lock icons-step text-white"></i>
                                    <h4>
                                        Safety
                                    </h4>
                                </div>
                                <div class="col-md-3 box-systemes  my-1 card-systeme-responsive">
                                    <i class="fas fa-arrow-circle-down icons-step text-white"></i>
                                    <h4>
                                        Receive
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End On Focus Section -->


        <section id="Whychooseus" class="testimonials mt-3 ">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Why Choose Us
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        Our goal is to provide a good and reliable wallet service to the user <br /> while ensuring safe and secure transactions.
                    </p>
                </div>

                <div class="testimonials-slider swiper" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide ">
                            <div class="testimonial-item ">
                                <div class="single-box">
                                    <i class="fas fa-fingerprint"></i>
                                    <h4>
                                        Easy
                                    </h4>
                                    <p>
                                        Our system works with all payment methods with ease, which has an easy deposit and withdrawal system
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <h4>
                                        Accept all payments

                                    </h4>
                                    <p>
                                        Collect your electronic balance from all digital payment wallets and make it in one system
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-hockey-puck"></i>
                                    <h4>
                                        Low Fees
                                    </h4>
                                    <p>
                                        CtPay Wallet supports a modern system and by using this service you get the best transfer fees worldwide.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="far fa-copy"></i>
                                    <h4>
                                        Certified
                                    </h4>
                                    <p>
                                        We are a fully legal certified company. We are certified and secure.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-lock"></i>
                                    <h4>
                                        Secure
                                    </h4>
                                    <p>
                                        We are constantly working to improve our system and our security level to reduce any potential risks
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="single-box">
                                    <i class="fas fa-globe-asia"></i>
                                    <h4>
                                        Global
                                    </h4>
                                    <p>
                                        We are an international company that operates globally and we have clients from all over the world
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Testimonials Section -->
        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                        <div class="content px-xl-5">
                            <h4 class="Titel-Asked " data-aos="fade-left" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                <strong style="color:#e51d39;">Questions </strong> Common
                            </h4>
                        </div>
                        <div class="accordion accordion-flush px-xl-5" id="faqlist">

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1100">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                        <h3 class="Title-qur-home">
                                            <i class="bi bi-question-circle question-icon"></i>
                                            حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء
                                        </h3>
                                    </button>
                                </h3>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <p class="Title-qur-home-bio">
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->




                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 pt-5 order-lg-2 img" data-aos="zoom-out-right" data-aos-delay="200" data-aos-duration="1200">
                        <img src="assets_v3/assets/img/querwith.png" class="img-fluid" />
                    </div>
                </div>

            </div>
        </section>
        <!-- End F.A.Q Section -->
        <!-- ======= Testimonials Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Customer Reviews
                    </h2>
                </div>

                <div class="clients-slider swiper" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-wrap-comment">
                                <div class="testimonial-item-comment">
                                    <img src="assets_v3/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img-comment" alt="">
                                    <h3>محمد أحمد</h3>
                                    <h4>مدير شركة</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Testimonials Section -->



        <section id="Blogs" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Articles and advertisements
                    </h2>
                </div>

                <div class="Blogs-slider swiper" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i> مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i> Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i> 12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        Read more
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i> مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i> Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i> 12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        Read more
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card blog-card">
                                <img class="card-img-top" src="assets_v3/assets/img/blog-recent-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="blog-card-title">
                                            أهمية المحفظة الإلكترونية
                                        </a>
                                    </h4>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-person"></i> مدير المحفظة
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-clock"></i> Jan 1, 2022
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="bi bi-chat-dots"></i> 12 تعليق
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="bio-card-text c2">
                                        هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ
                                    </p>
                                    <a href="#" class="btn btn-Readmore ">
                                        Read more
                                        <i class="far fa-hand-pointer px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>







        <section id="paymant" class=" my-3">
            <div class="container">


                <div class="row justify-content-around">
                    <div class="col-md-4 pt-4 pt-lg-0 content">
                        <div class="section-header">
                            <h2 class="titl-aboutus" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                                Payment With
                            </h2>
                            <p class="bio-aboutus" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                                We support working with more than one payment receiving your money

                            </p>
                        </div>
                    </div>
                    <div class="col-md-6" style="flex-wrap:wrap!important;">
                        <div class="d-flex flex-row">
                            <div class="logo-company-top-right">
                                <img src="assets_v3/assets/img/icons/1.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="500" />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/2.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="600" />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/3.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="700" />
                            </div>
                            <div class="logo-company-top">
                                <img src="assets_v3/assets/img/icons/4.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="800" />
                            </div>
                            <div class="logo-company-top-left">
                                <img src="assets_v3/assets/img/icons/5.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="900" />
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="logo-company-bottom-right ">
                                <img src="assets_v3/assets/img/icons/6.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1000" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/7.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1100" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/8.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1200" />
                            </div>
                            <div class="logo-company-bottom">
                                <img src="assets_v3/assets/img/icons/9.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1300" />
                            </div>
                            <div class="logo-company-bottom-left">
                                <img src="assets_v3/assets/img/icons/10.png" class="img-fluid" data-aos="zoom-in" data-aos-easing="ease-out-cubic" data-aos-duration="1400" />
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>

        <!-- ======= Cta Section ======= -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2 class="Titel-befor" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="500">
                        Contact us
                    </h2>
                    <p class="bio-section-titel px-5" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="800">
                        Send your message and feedback to our support team
                        <b class="name-web">CTPAY</b>
                        <br /> We will contact you as soon as possible

                    </p>
                </div>

                <div class="row">


                    <div class="col-lg-7 my-sm-3  d-flex align-items-stretch" data-aos="zoom-in-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">Full name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <label class="required">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="required">Address</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="required">
                                    Submit an inquiry, suggestion or complaint
                                </label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-contactus">
                                    Send  Message
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-5 my-sm-3 d-flex align-items-stretch" data-aos="zoom-in-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4 class="title-contactus">Location :</h4>
                                <p>128 City Road, London, EC1V 2NX</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>E-mail :</h4>
                                <p>support@ctpay.uk</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>phone :</h4>
                                <p>+447451273774</p>
                            </div>

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.2357497086928!2d-0.0886604!3d51.5272357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ca671a6cfb7%3A0x9320c88f0a927f3f!2zMTI4IENpdHkgUmQsIExvbmRvbiBFQzFWIDJOWNiMINin2YTZhdmF2YTZg9ipINin2YTZhdiq2K3Yr9ip!5e0!3m2!1sar!2s!4v1662109627809!5m2!1sar!2s"
                                frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                </div>

            </div>
        </section>
        <!-- End Contact Section -->

    </main>
    <!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer" class="style-rtl">

        <div class="footer-top">

            <div class="container">

                <div class="row ">
                    <div class="col-lg-3 style-right">

                        <a href="index.html">
                            <img src="assets_v3/assets/img/logoFooter.png" alt="">
                        </a>
                        <h4 class="Title-Links">
                            Company
                        </h4>
                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#hero" class="scrollto">
                                    About
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#Whychooseus" class="scrollto">
                                    Why Choose Us
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#services" class="scrollto">
                                    Our Services

                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#paymant" class="scrollto">
                                    Payment With

                                </a>
                            </li>

                        </ul>


                    </div>
                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            Join us
                        </h4>

                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#Blogs" class="scrollto">
                                    Articles and advertisements
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#clients" class="scrollto">
                                    Customer Reviews

                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="#contact" class="scrollto">
                                   Contact us
                                </a>
                            </li>

                            <li class="Footer-Links">
                                <a href="#howsysteme" class="scrollto">
                                    Evidence
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            Our policy
                        </h4>

                        <ul class="Links pt-1">
                            <li class="Footer-Links">
                                <a href="#faq" class="scrollto">
                                    Questions Common
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('agreement')}}">
                                    User Agreement
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('privacy')}}">
                                    Security and privacy policy
                                </a>
                            </li>
                            <li class="Footer-Links">
                                <a href="{{route('licenses')}}">
                                    Licenses
                                </a>
                            </li>



                        </ul>

                    </div>

                    <div class="col-lg-3 style-right">
                        <h4 class="Title-Links pt-5">
                            Contact us
                        </h4>
                        <div class="social-links pt-1">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                        <h4 class="Title-Links pt-2">
                            Wait for the app to load
                        </h4>
                        <ul class="Links pt-3" style="display:inline-flex!important;">
                            <li class="Footer-Links mx-1">
                                <a href="#">
                                    <img width="120" height="40" src="assets_v3/assets/img/icons/app-1.png" />

                                </a>
                            </li>
                            <li class="Footer-Links mx-1">
                                <a href="#">
                                    <img width="120" height="40" src="assets_v3/assets/img/icons/app-2.png" />

                                </a>
                            </li>
                        </ul>

                    </div>
                </div>




            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span style="color:#e51d39!important;">CRPAY</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>





    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 120, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 400, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: true, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });
    </script>

    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>


    <script src="assets/js/main.js"></script>

</body>

</html>
@endif
