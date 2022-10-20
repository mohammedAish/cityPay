<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('dashboard')); ?>"><i
                class="la la-home nav-icon"></i> <?php echo e(trans('backpack::base.dashboard')); ?></a></li>

<li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('errorreport')); ?>'>
        <i class='nav-icon la la-question'></i> <?php echo e(cp('ErrorReports')); ?></a></li>

<!-- Manage article-->

<!-- Manage Services-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        <?php echo e(trans('lang.manage_services')); ?>

    </a>
    <ul class="nav-dropdown-items">

        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('parentservice')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.ParentServices')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('servicefeature')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.services_features')); ?></a></li>

        
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('service')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(__('lang.all_Services')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('servicespackage')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.ServicesPackages')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('loyaltypointsprice')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.LoyaltyPointsPrices')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('serviceinstruction')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.ServiceInstructions')); ?></a></li>
    </ul>
</li>
<!-- Manage Payments-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        <?php echo e(trans('lang.manage_payments')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.deposit_setting')); ?>

            </a>


            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('depositmethod')); ?>'>
                        <i class='nav-icon la la-language'></i> <?php echo e(trans('lang.system_manual')); ?></a></li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.methods_manual')); ?>

                    </a>
                    <ul class="nav-dropdown-items">

                        <li class='nav-item'>
                            <a class='nav-link' href='<?php echo e(backpack_url('depositagency')); ?>'>
                                <i class='nav-icon la la-question'></i> <?php echo e(trans('lang.deposit_gencies_manual')); ?></a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown disabled">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.automatically')); ?>

                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.withdraw_settings')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.methods_manual')); ?>

                    </a>
                    <ul class="nav-dropdown-items">

                        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('withdrawagency')); ?>'>
                                <i class='nav-icon la la-question'></i> <?php echo e(trans('lang.withdraw_gencies_manual')); ?></a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown disabled">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.automatically')); ?>

                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.transfer_setting')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.manual')); ?>

                    </a>
                    <ul class="nav-dropdown-items">
                        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transferagency')); ?>'><i
                                        class='nav-icon la la-question'></i> <?php echo e(trans('lang.transfer_agencies')); ?></a>
                        </li>
                        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transfersetting')); ?>'><i class='nav-icon la la-question'></i>إعدادات التحويل</a></li>
                        
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        <?php echo e(trans('lang.automatically')); ?>

                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <!-- Manage Purchase-->
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.manage_purchases')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('digitalcardcategory')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.DigitalCardCategories')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('digitalcardsprovider')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.DigitalCardsProviders')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('digitalcardstore')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.DigitalCardStores')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('digitalcardproviderpackage')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.DigitalCardsItems')); ?></a></li>
                
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('digitalcardspurchase')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.DigitalCardsPurchases')); ?></a></li>
                


            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.pull_earning_manag')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('freelancingplatform')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(trans('lang.FreelancingPlatforms')); ?></a></li>
            </ul>
        </li>
    </ul>

</li>

<!-- Manage TradingServices-->























<!-- Manage Orders-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
        <?php echo e(trans('lang.manage_orders')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.Deposits')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('depositordersuspended')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.deposit_order_suspendeds')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('depositordercompleted')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.deposit_order_completeds')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('depositorderrejected')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.deposit_order_rejecteds')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('depositorder')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.AllDepositOrders')); ?></a></li>

            </ul>
        </li>

        <!-- withdraw-->

        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.withdraw_orders')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('withdrawordersuspended')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.withdraw_order_suspended')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('withdrawordercompleted')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.withdraw_order_completed')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('withdraworderrejected')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.withdraw_order_rejecteds')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('withdraworder')); ?>'><i
                                class='nav-icon la la-question'></i> <?php echo e(__('lang.all_withdraws')); ?></a></li>
            </ul>
        </li>
        <!-- move it as child in customer -->
        
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('customerdcorder')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.CustomerDCOrders')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('identitydocumentation')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.identitydocumentation')); ?></a></li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.TransferWithdrawOrders')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transferwithdrawordersuspended')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.transferwithdrawordersuspended')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transferwithdrawordercompleted')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.transferwithdrawordercompleted')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transferwithdraworderrejected')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.transferwithdraworderrejected')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('transferwithdraworder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.AllTransferWithdrawOrders')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('wallettransfer')); ?>'>
                        <i class='nav-icon la la-question'></i> التحويل بين المحافظ</a></li>

            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                <?php echo e(trans('lang.PayingOrders')); ?>

            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('suspendedpayingorder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.suspended_paying_orders')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('acceptedpayingorder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.acceptedpayingorder')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('completedpayingorder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.completedpayingorder')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('rejectedpayingorder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.rejectedpayingorder')); ?></a></li>
                <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('payingorder')); ?>'>
                        <i class='nav-icon la la-question'></i> <?php echo e(__('lang.allpayingorder')); ?></a></li>
            </ul>
        </li>
        
        
        
        
        
        
    </ul>
</li>
<!-- Manage consultants-->












































<!-- Manage Customers-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" style="font-weight: bold;" href="#"><i
                class="nav-icon la la-users"></i> <?php echo e(trans('lang.manage_customers')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('customer')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(__('lang.all_customers')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('customerbankaccount')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.CustomerBankAccounts')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('customerloverbankaccount')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.CustomerLoverBankAccounts')); ?></a></li>

        <li class='nav-item'>
            <a class='nav-link' href='<?php echo e(backpack_url('customersloyaltypointsprice')); ?>'><i
                        class='nav-icon la la-question'></i> <?php echo e(__('lang.CustomersLoyaltyPointsPrices')); ?></a></li>

        
        

        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('badge')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.Badges')); ?></a></li>
    </ul>
</li>
<!-- Manage System users-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> <?php echo e(trans('lang.system_users')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('user')); ?>"><i class="nav-icon la la-user"></i>
                <span><?php echo e(trans('lang.Users')); ?></span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('role')); ?>"><i
                        class="nav-icon la la-id-badge"></i> <span><?php echo e(trans('lang.roles')); ?></span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('permission')); ?>"><i
                        class="nav-icon la la-key"></i> <span><?php echo e(trans('lang.permissions')); ?></span></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('logevents')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(__('lang.LogEvents')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('log')); ?>'><i
                        class='nav-icon la la-terminal'></i>
                <?php echo e(__('lang.Logs')); ?></a></li>
    </ul>
</li>
<!-- Manage General Settings -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        <?php echo e(trans('lang.general_setting')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('country')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(trans('lang.countries')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('city')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(trans('lang.cities')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('currency')); ?>'><i
                        class='nav-icon la la-question'></i>
                <?php echo e(trans('lang.Currencies')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('language')); ?>'>
                <i class='nav-icon la la-question'></i>
                <?php echo e(__('lang.Languages')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('emailtemplate')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.email_tmp_settings')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('setting')); ?>'>
                <i class='nav-icon fa fa-cog'></i>
                <?php echo e(__('lang.system_Settings')); ?></a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        <?php echo e(trans('lang.NewHome')); ?>

    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/homecontent')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.banner_content')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/whychoose')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.our_services')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/flowstep')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.how_system_works')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/howitwork')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.Why_Choose_Us')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/testimonial')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.testimonial')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/blog_announce')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.blog_announce')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/faq')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.faq')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/contact')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.contact')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/bg_image')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.bg_image')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/team')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.team')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/company_policy')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.company_policy')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/social')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.manage_social')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/seo')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.seo')); ?></a></li>
        <li class='nav-item'><a class='nav-link' href='<?php echo e(backpack_url('frontend/about')); ?>'>
                <i class='nav-icon la la-question'></i> <?php echo e(__('lang.about_us')); ?></a>

    </ul>
</li>

<style>
    .sidebar {
        background: #000036
    }

    .nav-link.nav-dropdown-toggle {
        font-weight: bold;
    }

    body {
        font-size: .7rem;
        font-weight: 400;
    !important;
    }

    .btn {
        font-size: .8rem;
    }

    .h2, h2 {
        font-size: 1rem;
    }

    h2 small, h3 small, h4 small, h5 small {
        font-size: .7em;
    }

    a:hover {
        background-color: #5e72e4 !important;
    }

    .bg-primary {
        background-color: #5e72e4 !important;
    }

    .sidebar .nav-item .nav-link.active {
        background-color: #5e72e4 !important;
    }

    .btn-primary {
        background-color: #5e72e4 !important;
    }

    .form-control {
        border-radius: 10px 10px 10px 10px !important;
    }

    .content-bg {
        background-color: #f8f9fe !important;
    }

    .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.6);
    }


</style>














<?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/inc/sidebar_content.blade.php ENDPATH**/ ?>