<?php $__env->startSection('keywords'); ?>
    <?php if(current_local()=="en"): ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords_en)?$header->home_keywords_en:'تداول'); ?>" />
    <?php else: ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords)?$header->home_keywords:'تداول'); ?>" />
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header class="inner-header no-overlay" style="margin-top: 6%;
    background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url(<?php echo e(asset('/app/public/'.(isset($page_setups->about_company_background)?$page_setups->about_company_background:'1.jpg'))); ?>);
    background-size: cover;
    background-position: bottom;
    background-repeat: no-repeat;">
        <div class="container">
            <div class="section-heading">
                <?php if(current_local()=="en"): ?>
                    <h1><?php echo e(isset($page_setups->about_company_title_en)?$page_setups->about_company_title_en:''); ?></h1>
                    <p><?php echo isset($page_setups->about_company_sub_title_en)?$page_setups->about_company_sub_title_en:''; ?></p>
                <?php else: ?>
                    <h1><?php echo e(isset($page_setups->about_company_title)?$page_setups->about_company_title:''); ?></h1>
                    <p><?php echo isset($page_setups->about_company_sub_title)?$page_setups->about_company_sub_title:''; ?></p>
                <?php endif; ?>

            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="about">
        <section class="about-rows">
            <div class="container">
                <div class="row about-info">
                    <div class="col-sm-12 col-lg-6">
                        <div class="circled-img">
                            <img src="<?php echo e(asset('/home_page/img/sample.jpg')); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <?php if(current_local()=="en"): ?>
                            <h2><?php echo e(isset($aboutus->trade_mark_title_en)?$aboutus->trade_mark_title_en:''); ?></h2>
                            <p><?php echo isset($aboutus->trade_mark_desc_en)?$aboutus->trade_mark_desc_en:''; ?></p>
                        <?php else: ?>
                            <h1><?php echo e(isset($aboutus->trade_mark_title)?$aboutus->trade_mark_title:''); ?></h1>
                            <p><?php echo isset($aboutus->trade_mark_desc)?$aboutus->trade_mark_desc:''; ?></p>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="row about-info">
                    <div class="col-sm-12 col-lg-6">
                        <?php if(current_local()=="en"): ?>
                            <h2><?php echo e(isset($aboutus->Definition_company_title_en)?$aboutus->Definition_company_title_en:''); ?></h2>
                            <p><?php echo isset($aboutus->Definition_company_desc_en)?$aboutus->Definition_company_desc_en:''; ?></p>
                        <?php else: ?>
                            <h2><?php echo e(isset($aboutus->Definition_company_title)?$aboutus->Definition_company_title:''); ?></h2>
                            <p><?php echo isset($aboutus->Definition_company_desc)?$aboutus->Definition_company_desc:''; ?></p>
                        <?php endif; ?>

                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="circled-img">
                            <img src="<?php echo e(asset('/home_page/img/about.jpg')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="whyUs">
            <div class="container">
                <div class="section-heading">
                    <h1> <?php echo e(__('site.Counters')); ?> </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>
                <div class="row">
                    <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indx => $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="why-us-item col-sm-6 col-lg-3">
                            <div class="imgback">
                                <img src="<?php echo e(asset('/app/public/'.(isset($counter->image)?$counter->image:'logo.png') )); ?>" alt="">
                            </div>

                            <p id="counter<?php echo e($indx); ?>" style="padding: 0.2rem;">0</p>
                            <p style="padding: 0.2rem;"><?php echo e(isset($counter->title)?$counter->title:''); ?></p>
                            <script>
                                $({countNum: $('#counter<?php echo e($indx); ?>').text()}).animate({countNum: '<?php echo e(isset($counter->counter)?$counter->counter:'0'); ?>'}, {
                                    duration: 8000,
                                    easing:'linear',
                                    step: function() {
                                        $('#counter<?php echo e($indx); ?>').text(Math.floor(this.countNum));
                                    },
                                    complete: function() {
                                        $('#counter<?php echo e($indx); ?>').text(this.countNum);
                                    }
                                });
                            </script>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

   </main>



    <!-- Footer -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/aboutus.blade.php ENDPATH**/ ?>