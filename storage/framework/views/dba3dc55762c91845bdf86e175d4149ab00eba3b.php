<?php $__env->startSection('keywords'); ?>
    <?php if(current_local()=="en"): ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords_en)?$header->home_keywords_en:'تداول'); ?>" />
    <?php else: ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords)?$header->home_keywords:'تداول'); ?>" />
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header class="inner-head" style="margin-top:6%;">
        <div class="container">
            <h1>
            <?php echo e(__('site.accessPolicy')); ?>

            </h1>
        </div>
    </header>


   <!-- Main content -->
    <main class="colored-bg policy">
        <div class="container">
            <!-- مقدمة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                    <?php echo e(__('site.introduction')); ?>

                    </h4>
                </div>
                <div class="col-sm-12 col-md">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->introduction_en)?$access_policy->introduction_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->introduction)?$access_policy->introduction:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- الهدف -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.target')); ?>


                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->target_en)?$access_policy->target_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->target)?$access_policy->target:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- استخدام موقع YTIF -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.uses_website')); ?>

                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->uses_website_en)?$access_policy->uses_website_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->uses_website)?$access_policy->uses_website:''; ?></p>
                    <?php endif; ?>

                </div>
            </section>
            <!-- مايلي يشمل موقع YTIFS -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4> <?php echo e(__('site.what_contain')); ?></h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <?php echo isset($access_policy->included_website_en)?$access_policy->included_website_en:''; ?>

                    <?php else: ?>
                        <?php echo isset($access_policy->included_website)?$access_policy->included_website:''; ?>

                    <?php endif; ?>
                </div>
            </section>
            <!-- إشراك العملاء -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.customerss')); ?>

                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->subscribe_customer_en)?$access_policy->subscribe_customer_en:''; ?> </p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->subscribe_customer)?$access_policy->subscribe_customer:''; ?> </p>
                    <?php endif; ?>

                </div>
            </section>
            <!-- الحلول البديلة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.Alternative solutions')); ?>

                    </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->Alternative_solutions_en)?$access_policy->Alternative_solutions_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->Alternative_solutions)?$access_policy->Alternative_solutions:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- الامتثال للمعايير -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.Compliance with standards')); ?>

                        </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($access_policy->Compliance_standards_en)?$access_policy->Compliance_standards_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($access_policy->Compliance_standards)?$access_policy->Compliance_standards:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- اتصل بنا -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4>
                        <?php echo e(__('site.contact')); ?>

                         </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <p>

                        <?php echo e(__('site.havequetion')); ?>

                    </p>
                    <ul>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span><?php echo e(isset($access_policy->phone)?$access_policy->phone:''); ?></span>
                        </li>
                        <li>
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/<?php echo e(isset($access_policy->whatsApp)?$access_policy->whatsApp:''); ?>" class="icon-link"><?php echo e(isset($access_policy->whatsApp)?$access_policy->whatsApp:''); ?></a>
                        </li>
                        <li>
                            <i class="fas fa-at"></i>
                            <a href="mailto:<?php echo e(isset($access_policy->default_email)?$access_policy->default_email:''); ?>"><?php echo e(isset($access_policy->default_email)?$access_policy->default_email:''); ?></a>
                        </li>
                    </ul>
                </div>
            </section>
        </div>

    </main>
    <!-- Footer -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/accessPolicy.blade.php ENDPATH**/ ?>