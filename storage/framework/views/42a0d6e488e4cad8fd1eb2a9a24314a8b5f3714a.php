
<script>
    function loadJS() {
        var head = document.getElementsByTagName('head')[0];
        var js = document.createElement("script");
        js.type = "text/javascript";
        js.src = "<?php echo e(asset('assets/admin/js/main.js')); ?>";
        head.appendChild(js);
    }
</script>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/inc/wallet_js.blade.php ENDPATH**/ ?>