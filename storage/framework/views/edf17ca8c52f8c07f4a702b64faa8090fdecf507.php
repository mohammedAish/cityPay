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
            <h1><?php echo e(__('site.rules')); ?></h1>
        </div>
    </header>


   <!-- Main content -->
    <main class="colored-bg policy">
        <div class="container">
            <!-- معلومات عامة -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4><?php echo e(__('site.General_Information')); ?> </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->public_information_en)?$privacy_policy->public_information_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->public_information)?$privacy_policy->public_information:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- الحق في الوصول إلى البيانات وتصحيحها وحذفها والاعتراض على معالجة البيانات -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4> <?php echo e(__('site.right1')); ?>

                       </h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->access_for_data_en)?$privacy_policy->access_for_data_en:''; ?></p>

                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->access_for_data)?$privacy_policy->access_for_data:''; ?></p>

                    <?php endif; ?>
                </div>
            </section>
            <!-- إدارة البيانات الشخصية -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4><?php echo e(__('site.personal_data')); ?></h4>
                </div>
                <div class="col-sm-12 col-md-8">
                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->manage_personal_data_en)?$privacy_policy->manage_personal_data_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->manage_personal_data)?$privacy_policy->manage_personal_data:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- المعلومات التي نجمعها -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4><?php echo e(__('site.collcted_data')); ?></h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->information_collect_en)?$privacy_policy->information_collect_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->information_collect)?$privacy_policy->information_collect:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- كيف نستخدم معلوماتك -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4><?php echo e(__('site.data_usage')); ?></h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->how_Uses_data_en)?$privacy_policy->how_Uses_data_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->how_Uses_data)?$privacy_policy->how_Uses_data:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <!-- مشاركة معلوماتك -->
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h4><?php echo e(__('site.data_share')); ?></h4>
                </div>
                <div class="col-sm-12 col-md-8">


                    <?php if(current_local()=="en"): ?>
                        <p><?php echo isset($privacy_policy->sharing_data_en)?$privacy_policy->sharing_data_en:''; ?></p>
                    <?php else: ?>
                        <p><?php echo isset($privacy_policy->sharing_data)?$privacy_policy->sharing_data:''; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section class="row policy-content">
                <div class="col-sm-12 col-md-4">
                    <h6><?php echo e(__('site.query')); ?> </h6>
                </div>
                <div class="col-sm-12 col-md-8">
                    <p><a href="mailto:<?php echo e(isset($privacy_policy->For_inquiries)?$privacy_policy->For_inquiries:''); ?>"><?php echo e(isset($privacy_policy->For_inquiries)?$privacy_policy->For_inquiries:''); ?></a></p>


                </div>
            </section>
        </div>

    </main>
    <!-- Footer -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/privacyPolicy.blade.php ENDPATH**/ ?>