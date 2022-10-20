<?php $__env->startSection('content'); ?>
    <header class="inner-header" style="margin-top: 6%;
        background: linear-gradient(to bottom, rgba(11,72,121,0.75), rgba(11,72,121,0.1)),url(<?php echo e(asset('/app/public/'.(isset($page_setups->services_background)?$page_setups->services_background:'1.jpg'))); ?>);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;">
        <div class="section-heading">
            <?php if(current_local()=="en"): ?>
                <h1><?php echo e(isset($page_setups->services_title_en)?$page_setups->services_title_en:''); ?></h1>
                <p><?php echo e(isset($page_setups->services_sub_title_en)?$page_setups->services_sub_title_en:''); ?></p>
            <?php else: ?>
                <h1><?php echo e(isset($page_setups->services_title)?$page_setups->services_title:''); ?></h1>
                <p><?php echo e(isset($page_setups->services_sub_title)?$page_setups->services_sub_title:''); ?></p>
            <?php endif; ?>

        </div>
    </header>

    <!-- Main content -->
    <main>
        <section class="inner inner-services">
            <div class="container">
                <div class="row">
                    <?php $__currentLoopData = $parentServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card-grid">
                                <div class="card-grid-img">
                                    <img src="<?php echo e(config('app.url').$parentService->img_path); ?>"
                                         style="width: 100%;" hight="10%"
                                         alt="<?php echo e($parentService->name); ?>">
                                </div>
                                <div class="card-grid-content">
                                    <h5><?php echo e($parentService->name); ?></h5>
                                    <p><?php echo e($parentService->short_description); ?></p>
                                </div>
                                <?php if($parentService->id == 2): ?>
                                    <div class="card-grid-footer">
                                        <a href="#"
                                           class="btn"><?php echo e(__('site.readmore')); ?></a>
                                    </div>
                                    <?php elseif($parentService->id == 3): ?>
                                    <div class="card-grid-footer">
                                        <a href="<?php echo e(route('consultants.main')); ?>"
                                           class="btn"><?php echo e(__('site.readmore')); ?></a>
                                    </div>
                                    <?php elseif($parentService->id == 4): ?>
                                <div class="card-grid-footer">
                                    <a href="<?php echo e(route('courses.main')); ?>"
                                       class="btn"><?php echo e(__('site.readmore')); ?></a>
                                </div>
                                    <?php else: ?>
                                    <div class="card-grid-footer">
                                        <a href="<?php echo e(route('sub_services',$parentService->id)); ?>"
                                           class="btn"><?php echo e(__('site.readmore')); ?></a>
                                    </div>
                                 <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/services/services.blade.php ENDPATH**/ ?>