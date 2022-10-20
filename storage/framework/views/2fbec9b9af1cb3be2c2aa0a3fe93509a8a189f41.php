<?php
    $rnm = Request::route()->getName();
    $sp = explode('.',$rnm);

    $arr= ['user','express','invoice']
?>

<?php if(!in_array($sp[0],$arr)): ?>

    <footer class="footer-area section-padding-2 theme-bg wave-animation pb-0">
        <div class="container">
            <div class="row mb-0 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="footer-widget">
                        <a href=""><img src="<?php echo e(get_image(config('constants.logoIcon.path') .'/logo.png')); ?>" alt=""></a>
                        <p><?php echo e(__($shortAbout->value->web_footer)); ?></p>
                        <div class="social">
                            <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($data->value->url); ?>" target="_blank" class="cl-facebook"
                                   title="<?php echo e($data->value->title); ?>"><?php echo $data->value->icon ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="footer-widget ">
                                <div class="m-app">
                                    <a href=""><i class="fab fa-apple"></i><?php echo app('translator')->get('App Store'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer-widget ">
                                <div class="m-app">
                                    <a href=""><i class="fa fa-play"></i><?php echo app('translator')->get('Google Play'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
<!--        <div class="footer-bottom-section" style="border-top: 1px solid #fff; padding-top 10px">
            <div class="container">
                <div class="row py-4 justify-content-around">
                    <div class="col-xl-6  cl-white copyright ">
                        <p class="mb-0 text-md-center text-xl-left"><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?>

                            - <?php echo e(__($general->sitename)); ?>

                            . <?php echo app('translator')->get('All Rights Reserved.'); ?></p>
                    </div>
                    <div class="col-xl-6  cl-white copyright ">
                        <div class="footer-widget footer-nav text-md-center float-xl-right mb-0">

                        </div>
                    </div>

                </div>
            </div>
        </div>-->
    </footer>




<?php else: ?>

    <!--Footer Area-->
<!--    <footer class="footer-area py-4 theme-bg wave-animation" style="border-top: 1px solid #fff;">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-xl-6  cl-white copyright ">
                    <p class="mb-0 text-md-center text-xl-left"><?php echo app('translator')->get('Copyright'); ?> &copy; <?php echo e(date('Y')); ?>

                        - <?php echo e(__($general->sitename)); ?>

                        . <?php echo app('translator')->get('All Rights Reserved.'); ?></p>
                </div>
                <div class="col-xl-6  cl-white copyright ">
                    <div class="footer-widget footer-nav text-md-center float-xl-right mb-0">

                    </div>
                </div>

            </div>
        </div>
    </footer>&lt;!&ndash;/Footer Area&ndash;&gt;-->
<?php endif; ?>

<?php /**PATH /home/ytadawu1/wallet-main/resources/views/home/partials/footer.blade.php ENDPATH**/ ?>