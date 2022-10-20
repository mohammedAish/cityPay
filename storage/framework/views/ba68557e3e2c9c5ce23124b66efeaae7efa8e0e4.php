<?php $__env->startSection('keywords'); ?>
    <?php if(current_local()=="en"): ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords_en)?$header->home_keywords_en:'تداول'); ?>" />
    <?php else: ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords)?$header->home_keywords:'تداول'); ?>" />
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <main class="contact light"  style="margin-top:6%;">
        <section class="mapBroken">
            <div class="container">
                <div class="text">
                    <div class="content">
                        <?php if(current_local()=="en"): ?>
                            <h3><?php echo e(isset($cotact_us_page_settings->title_en)?$cotact_us_page_settings->title_en:''); ?></h3>
                            <p><?php echo isset($cotact_us_page_settings->first_paragraph_en)?$cotact_us_page_settings->first_paragraph_en:''; ?></p>
                            <p><?php echo isset($cotact_us_page_settings->second_paragraph_en)?$cotact_us_page_settings->second_paragraph_en:''; ?></p>

                        <?php else: ?>
                            <h3><?php echo e(isset($cotact_us_page_settings->title)?$cotact_us_page_settings->title:''); ?></h3>
                            <p><?php echo isset($cotact_us_page_settings->first_paragraph)?$cotact_us_page_settings->first_paragraph:''; ?></p>
                            <p><?php echo isset($cotact_us_page_settings->second_paragraph)?$cotact_us_page_settings->second_paragraph:''; ?></p>

                        <?php endif; ?>

                        <ul>
                            <li class="chat" style="background-color: #fff;">
                                <i class="far fa-envelope"></i>
                                <div>
                                    <p>
                                        <?php echo e(__('site.t_chat')); ?>

                                    </p>

                                </div>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>tel:<?php echo e(isset($cotact_us_page_settings->phone)?$cotact_us_page_settings->phone:''); ?></span>
                            </li>
                            <li>
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/<?php echo e(isset($cotact_us_page_settings->whatsapp)?$cotact_us_page_settings->whatsapp:''); ?>" class="icon-link"><?php echo e(isset($cotact_us_page_settings->whatsapp)?$cotact_us_page_settings->whatsapp:''); ?></a>
                            </li>
                            <li>
                                <i class="fas fa-at"></i>
                                <a href="mailto:<?php echo e(isset($cotact_us_page_settings->support_email)?$cotact_us_page_settings->support_email:''); ?>"><?php echo e(isset($cotact_us_page_settings->support_email)?$cotact_us_page_settings->support_email:''); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="map">
                    <div id="map"></div>
                </div>
            </div>
        </section>

    </main>
    <!-- Footer -->


    <script>
        function initMap() {
        // The location of Uluru
        var ytifs = {lat: 15.3217263, lng: 44.1969769};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: ytifs});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: ytifs, map: map, title: 'Hello'});
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmVxsB7PCdTBYcvtv7S2Lc3Bx6XrCpqPE&callback=initMap" type="text/javascript"></script>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/contact.blade.php ENDPATH**/ ?>