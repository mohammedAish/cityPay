<?php $__env->startSection('keywords'); ?>

    <meta name="keywords" content=" <?php echo e(isset($header->home_keywords)?trans('lang.'.$header->home_keywords):'تداول'); ?>"/>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <!-- Header -->
    <header class="main-page-header" style="margin-top: 6%;">
        <section id="headerCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li data-target="#headerCarousel" data-slide-to="<?php echo e($key); ?>"
                        class="<?php echo e($key == 0? 'active':''); ?>"></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ol>
            <div class="carousel-inner">

                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php echo e($key==0 ? 'item'.++$key.' active ':'item'.(++$key)); ?>"
                         style="background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.25)),
                             url(<?php echo e(asset('app/public/'.$slider->image)); ?>); background-size: cover;
                             background-repeat: no-repeat;
                             background-position: center;">
                        <div class="container">
                            <h1><?php echo e(isset($slider->title)?$slider->title:''); ?></h1>
                            <p><?php echo e(isset($slider->description)?$slider->description:''); ?></p>
                            <a href="<?php echo e(isset($slider->button_link)?$slider->button_link:''); ?>" class="btn">
                                <?php echo e(isset($slider->button_text)?$slider->button_text:''); ?>

                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"><?php echo e(__('site.previous')); ?></span>
            </a>
            <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"><?php echo e(__('site.next')); ?></span>
            </a>
        </section>
    </header>
    <!-- Main content -->
    <main>
        <!-- العروض -->
        <section class="container">
            <div class="section-heading">
                <h1><?php echo e(__('site.offers')); ?> </h1>
                <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
            </div>
            <section class="slickSlider offerSlider">

                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="offer-slider-item">
                        <section class="offer-container">
                            <div class="offer-img">
                                <img src="<?php echo e(asset('/app/public/'.(isset($offer->offer_logo)?$offer->offer_logo:'logo.png'))); ?>"
                                     alt="">
                            </div>
                            <div class="offer-header">
                                <div class="offer-amount offer-badge1">
                                    <div class="offer-no">
                                        <span class="no"> <?php echo e(isset($offer->discount_rate)?$offer->discount_rate:''); ?>%</span>
                                        <span> <?php echo e(isset($offer->offer_desc_title)?$offer->offer_desc_title:''); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="offer-content">
                                <h2><?php echo e(isset($offer->offer_title)?$offer->offer_title:''); ?></h2>
                                <p><?php echo e(isset($offer->offer_small_description)?$offer->offer_small_description:''); ?></p>
                            </div>
                            <div class="offer-footer">
                                <a href="<?php echo e(isset($offer->offer_button_link)?$offer->offer_button_link:''); ?>"
                                   class="btn"><?php echo e(isset($offer->offer_button_text)?$offer->offer_button_text:''); ?></a>
                            </div>
                        </section>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </section>
        </section>
        <!-- لماذا يمن تداول -->
        <section class="whyUs">
            <div class="container">
                <div class="section-heading">
                    <h1> <?php echo e(__('site.whyUs')); ?> </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    <?php $__currentLoopData = $why_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $why_us_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="why-us-item col-sm-6 col-lg-3">
                            <div class="imgback">
                                <img src="<?php echo e(asset('/app/public/'.(isset($why_us_item->icon)?$why_us_item->icon:'logo.png') )); ?>"
                                     alt="">
                            </div>
                            <p><?php echo e(isset($why_us_item->description)?$why_us_item->description:''); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- الشهادات -->
        <section class="certificates">
            <div class="container">
                <div class="section-heading">
                    <h1><?php echo e(__('site.certificates')); ?></h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="slickSlider cert-slider">
                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cert-slider-item">
                            <img src="<?php echo e(asset('/app/public/'.(isset($certificate->certificate_image)?
                            $certificate->certificate_image:'cert.png'))); ?>" class="d-block w-100"
                                 alt="<?php echo e($certificate->certificate_name); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
        <!-- من نحن -->
        <section class="whoUs">
            <div class="container">
                <div class="section-heading">
                    <h1><?php echo e(__('site.about_company')); ?></h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="<?php echo e(asset('/org_assets/dist/img/svg/team.svg')); ?>" alt="">
                                <h3><?php echo e(__('site.who_us')); ?> </h3>
                                <p><?php echo isset($SettingSite->who_us)?trans('lang.'.$SettingSite->who_us):'who us text here'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="<?php echo e(asset('/org_assets/dist/img/svg/target.svg')); ?>" alt="">
                                <h3><?php echo e(__('site.mission')); ?></h3>
                                <p><?php echo isset($SettingSite->mission_en)?trans('lang.'.$SettingSite->mission):'mission text here'; ?></p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card-grid">
                            <div class="card-grid-content">
                                <img src="<?php echo e(asset('/org_assets/dist/img/svg/success.svg')); ?>" alt="">
                                <h3><?php echo e(__('site.vision')); ?></h3>
                                <p><?php echo isset($SettingSite->vision)?trans('lang.'.$SettingSite->vision):'vision text here'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- الخدمات -->
        <section class="services">
            <div class="container">
                <div class="section-heading">
                    <h1><?php echo e(__('site.services')); ?></h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row slickSlider services-slider">
                    <?php $__currentLoopData = $service_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slider-item">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="circled-img">
                                        <img src="<?php echo e(asset('/app/public/'.(isset($service->service_background)?$service->service_background:'logo.png'))); ?>"
                                             alt="<?php echo e(isset($service->service_title)?$service->service_title:''); ?>"
                                             width="100%">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="item-content">
                                        <h2><?php echo e(isset($service->service_title)?$service->service_title:''); ?></h2>
                                        <p><?php echo isset($service->service_short_desc_title)?$service->service_short_desc_title:''; ?></p>
                                        <a href="<?php echo e(route('servicePage',$service->slug)); ?>" class="btn">
                                            <?php echo e(__('site.readmore')); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- المستجدات -->
        <section class="news light">
            <div class="container">
                <div class="section-heading">
                    <h1><?php echo e(__('site.news')); ?></h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="<?php echo e(asset('/app/public/'.(isset($new->new_image)?$new->new_image:'default.jpeg'))); ?>"
                                         alt="">
                                </div>
                                <div class="card-grid-content">
                                    <h5><?php echo e(isset($new->new_title)?$new->new_title:''); ?></h5>
                                    <p><?php echo e(isset($new->new_subtitle)?$new->new_subtitle:''); ?></p>
                                </div>
                                <div class="card-grid-footer">
                                    <span>
                                  <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($new->created_at))->diffForHumans() ?>
                                    </span>
                                    <a href="<?php echo e(route('news_post',$new->slug)); ?>"
                                       class="line-btn">  <?php echo e(__('site.readmore')); ?>  </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>


            </div>
        </section>
        <!-- العملاء -->
        <section class="clients ">
            <div class="container">
                <div class="section-heading">
                    <h1><?php echo e(__('site.partners')); ?></h1>
                    <!-- <h1>نحن شركاء للشركات العالمية</h1> -->
                </div>
                <div class="slickSlider autoplay-slider">
                    <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="client-logo">
                            <img src="<?php echo e(asset('/app/public/'.(isset($partner->partner_logo)?$partner->partner_logo:'default.jpeg'))); ?>"
                                 alt="">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
        <!-- شركات الوساطه -->
        <section class="clients light">
            <div class="container">
                <div class="section-heading">
                    <h1> <?php echo e(__('site.firms')); ?>

                    </h1>
                </div>
                <div class="slickSlider autoplay-slider">
                    <?php $__currentLoopData = $brokerage_firms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brokerage_firm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="client-logo">
                            <a href="<?php echo e($brokerage_firm->brokerage_firms_link); ?>">
                                <img src="<?php echo e(asset('/app/public/'.(isset($brokerage_firm->brokerage_firms_logo)?$brokerage_firm->brokerage_firms_logo:'default.jpeg'))); ?>"
                                     alt="">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
        <!-- الدفع -->
        <section class="clients">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        <?php echo e(__('site.companiespayment')); ?>

                    </h1>
                </div>
                <div class="slickSlider autoplay-slider">
                    <?php $__currentLoopData = $payment_companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="client-logo">
                            <img src="<?php echo e(asset('/app/public/'.(isset($payment_company->payment_company_logo)?$payment_company->payment_company_logo:'default.jpeg'))); ?>"
                                 alt="">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/index.blade.php ENDPATH**/ ?>