<!-- Navbars -->
<!-- me -->
<nav class="main-nav navbar navbar-expand-xl navbar-light fixed-top" style="background: aliceblue;">
    <?php echo $__env->make('org_web.msg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="container" style="padding: 0">
        <a class="navbar-brand" href="<?php echo e(route('index')); ?>">
            <?php $logo='logo2.png'; ?>


            <img class="img-fluid" src="<?php echo e(asset('org_assets/dist/img/logo4.png')); ?>"
                 alt="<?php echo e(isset($header->website_title)?$header->website_title:"يمن تداول شارت الدولية المحدودة"); ?>" width="350px">
        </a>


        <div class="navbar">



            <div class="language d-block d-xl-none d-lg-none">

                <a class="nav-link dropdown-toggle" href="#" id="langDropdown" style="color: #000;padding: 0"
                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                </a>

                <div class="dropdown-menu " aria-labelledby="langDropdown">
                    <a class="dropdown-item" onclick="change_lang('ar')"
                       href="#"><?php echo e(trans('lang.arabic')); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="change_lang('en')"
                       href="#"><?php echo e(trans('lang.english')); ?></a>
                </div>
            </div>


            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarMenu"
                    aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </div>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav  <?php if(current_local()=="ar"): ?> mr-auto <?php else: ?> ml-auto <?php endif; ?> ">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo e(route('aboutus')); ?>"><?php echo e(__('site.about_company')); ?><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('news')); ?>"><?php echo e(__('site.news')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('services.main')); ?>"><?php echo e(__('site.services')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('offers')); ?>"><?php echo e(__('site.offers')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('blog')); ?>"><?php echo e(__('site.blog')); ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo e(__('site.ploicies')); ?>

                    </a>


                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('privacyPolicy')); ?>"><?php echo e(__('site.privacyPolicy')); ?> </a>
                        <a class="dropdown-item" href="<?php echo e(route('accessPolicy')); ?>"> <?php echo e(__('site.accessPolicy')); ?></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('contact')); ?>"><?php echo e(__('site.contact')); ?> </a>
                </li>
                <?php if(!auth()->id()>0): ?>


                    <li class="nav-item btns d-inline d-sm-inline d-xs-inline d-md-none d-lg-none">
                        <a href="<?php echo e(url('login')); ?>" type="button" class="nav-link btn btn-success ">
                            تسجيل دخول
                            <i class="fa fa-sign-in"></i></a>
                        <a href="<?php echo e(route('userRegister')); ?>" type="button" class="nav-link btn register-btn">
                            إنشاء حساب
                            <i class="fa fa-user"></i></a>
                    </li>
                <?php else: ?>

                    <li><a href="<?php echo e(route('profile.dashboard')); ?>"><i
                                class="fas fa-user"></i> <?php echo e(trans('lang.my_profile')); ?>

                        </a></li>
                    <li><a href="<?php echo e(url('wallet/dashboard')); ?>"><i class="fas fa-wallet"></i> <?php echo e(trans('lang.my_wallet')); ?>

                        </a>
                    </li>
                    <li><a href="<?php echo e(route("logout")); ?>"><i class="fas fa-sign-out-alt"></i><?php echo e(trans('lang.logout')); ?></a>
                    </li>

                <?php endif; ?>


            </ul>


            <ul class="navbar-nav <?php if(current_local()=="ar"): ?> mr-auto <?php else: ?> ml-auto <?php endif; ?>">



                <li class="nav-item dropdown d-none d-lg-block d-md-block d-xl-block" style="  background: aliceblue;">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" style="color: #000;" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </a>

                    <div class="dropdown-menu " aria-labelledby="langDropdown">
                        <a class="dropdown-item lang-select" data-lang="ar"
                           href="#"><?php echo e(trans('lang.arabic')); ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item lang-select" data-lang="en"
                           href="#"><?php echo e(trans('lang.english')); ?></a>
                    </div>


                </li>
                <li class="nav-item dropdown d-none d-lg-block d-md-block d-xl-block" style="  background: aliceblue;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" style="color: #000;" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(!auth()->id()>0): ?>
                            <a href="<?php echo e(url('/login')); ?>" type="button" class="nav-link btn btn-success mr-auto ml-auto"
                               style="width: 85%; color:white;">

                                تسجيل دخول
                                <i class="fas fa-sign-in-alt"></i></a>
                            <a href="<?php echo e(route('userRegister')); ?>" type="button"
                               class="nav-link btn register-btn mr-auto ml-auto mt-3" style="width: 85%; color:white;">
                                إنشاء حساب
                                <i class="fa fa-user"></i></a>
                        <?php else: ?>
                            <a class="nav-link btn register-btn mr-auto ml-auto" href="<?php echo e(route('profile.dashboard')); ?>"><i
                                    class="fas fa-user"></i> <?php echo e(trans('lang.my_profile')); ?></a>

                            <a href="<?php echo e(url('wallet/dashboard')); ?>"
                               type="button" class="nav-link btn btn-success mr-auto ml-auto"><i
                                    class="fas fa-wallet"></i> <?php echo e(trans('lang.my_wallet')); ?>

                            </a>

                            <a class="nav-link btn register-btn mr-auto ml-auto mt-3" href="<?php echo e(route("logout")); ?>"><i
                                    class="fas fa-sign-out-alt"></i><?php echo e(trans('lang.logout')); ?>

                            </a>

                        <?php endif; ?>
                    </div>
                </li>

            </ul>


        </div>


    </div>


</nav>


<script>
    function change_lang(lang_id) {
        jQuery(function ($) {
            jQuery.ajax({
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                url: '<?php echo e(URL::to("/change_language")); ?>',
                type: "POST",
                data: {"languages_id": lang_id, "_token": "<?php echo e(csrf_token()); ?>"},
                success: function (res) {
                    window.location.replace(res);
                    // window.location.reload();
                },
            });
        });
    }
</script>



<?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/org_web/navbar.blade.php ENDPATH**/ ?>