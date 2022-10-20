<?php $__env->startSection('title',"$page_title"); ?>
<?php $__env->startSection('content'); ?>

    <!--breadcrumb area-->
    <section class="breadcrumb-area fixed-head gradient-overlay">
    <div id="particles-js"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 centered">
                    <div class="banner-title">
                        <h2><?php echo e(__($page_title)); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title cl-black">
                        <p><?php echo $menu->data_values->body ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/home/policy.blade.php ENDPATH**/ ?>