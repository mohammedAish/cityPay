<body dir="rtl">

 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top style-rtl">
        <div class="container-fluid d-flex justify-content-around ">

            <h1 class="logo ">
                <a href="index.html">
                    <img src="assets_v3/assets/img/logo.png" class="img-fluid " alt="">
                </a>
            </h1>

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero"><?php echo e(__('site.Home')); ?></a></li>
                    <li><a class="nav-link scrollto" href="#Aboutus">About</a></li>
                    <li><a class="nav-link scrollto" href="#services"><?php echo e(__('site.services')); ?></a></li>
                    <li><a class="nav-link scrollto " href="#howsysteme">Evidence</a></li>
                    <li><a class="nav-link scrollto" href="#Whychooseus"><?php echo e(__('site.whyUs')); ?></a></li>
                    <li><a class="nav-link scrollto" href="#paymant">Paymant</a></li>

                    <li><a class="nav-link scrollto" href="#contact">Contact us</a></li>
                    <li class="dropdown w-25">
                        <a href="#">
                            <span>
                                <i class="fas fa-globe"></i>
                            </span> <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>


                            <li class="navLang">
                                <a href="<?php echo e(LaravelLocalization::getLocalizedURL('ar')); ?>">
                                    <img src="assets_v3/assets/img/icons/Language.png" /> AR
                                </a>
                            </li>
                            <li class="navLang">
                                <a href="<?php echo e(LaravelLocalization::getLocalizedURL('en')); ?>">
                                    <img src="assets_v3/assets/img/icons/Engilsh.png" /> EN
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->

        </div>
    </header>



<?php /**PATH /Users/mac/Documents/GitHub/cityPay/resources/views/layouts/home/navbar.blade.php ENDPATH**/ ?>