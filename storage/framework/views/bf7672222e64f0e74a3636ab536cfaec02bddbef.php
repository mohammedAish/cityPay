
<script src="<?php echo e(asset('/org_assets/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/custom.js')); ?>"></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/videojs.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/main.min.js')); ?>"></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/courses.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/select2.full.min.js')); ?>"></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/counterup.min.js')); ?> "></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/waypoints.min.js')); ?>" ></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/jquery.magnific-popup.js')); ?>" ></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/isotop.min.js')); ?>" ></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/barfiller.js')); ?> "></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/easing.min.js')); ?>" ></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/wow.min.js')); ?>" ></script>
<script  src="<?php echo e(asset('/org_assets/dist/js/coursemain.js')); ?>" ></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
<script src="<?php echo e(asset('/org_assets/plugins/froiden-helper/helper.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/plugins/toast-master/js/jquery.toast.js')); ?>"></script>

<script src="<?php echo e(asset('/org_assets/dist/js/chat.js')); ?>"></script>




<?php echo $__env->yieldContent('scripts'); ?>

<script>
    function scrollToTop() {
        $('html, body').animate({scrollTop:0}, 'slow');
    }

    $('.lang-select').click(function (event) {
        event.preventDefault();
        var url = document.URL;
        var lang = $(this).data("lang");
        var current_lang = "<?php echo e(LaravelLocalization::setLocale()); ?>";
        if (lang != current_lang) {
            var url = url.replace(current_lang, lang);
            location.replace(url);
        }

    });

</script>

</body>
</html>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/org_web/script.blade.php ENDPATH**/ ?>