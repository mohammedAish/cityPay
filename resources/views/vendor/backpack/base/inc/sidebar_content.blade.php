<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
                class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('errorreport') }}'>
        <i class='nav-icon la la-question'></i> {{cp('ErrorReports')}}</a></li>

<!-- Manage article-->

<!-- Manage Services-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_services')}}
    </a>
    <ul class="nav-dropdown-items">

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('parentservice') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.ParentServices')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('servicefeature') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.services_features')}}</a></li>

        {{--    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('packagescategory') }}'><i
                            class='nav-icon la la-question'></i> {{__('lang.PackagesCategories')}}</a></li>
    --}}
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('service') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.all_Services') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('servicespackage') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.ServicesPackages') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('loyaltypointsprice') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.LoyaltyPointsPrices') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('serviceinstruction') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.ServiceInstructions') }}</a></li>
    </ul>
</li>
<!-- Manage Payments-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_payments')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.deposit_setting')}}
            </a>


            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositmethod') }}'>
                        <i class='nav-icon la la-language'></i> {{trans('lang.system_manual')}}</a></li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.methods_manual')}}
                    </a>
                    <ul class="nav-dropdown-items">

                        <li class='nav-item'>
                            <a class='nav-link' href='{{ backpack_url('depositagency') }}'>
                                <i class='nav-icon la la-question'></i> {{trans('lang.deposit_gencies_manual')}}</a>
                        </li>
                        {{--  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositagencycountry') }}'>
                                  <i class='nav-icon la la-question'></i> {{trans('lang.deposit_agency_countries')}}</a>
                          </li>--}}
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown disabled">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.automatically')}}
                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.withdraw_settings')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.methods_manual')}}
                    </a>
                    <ul class="nav-dropdown-items">

                        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('withdrawagency') }}'>
                                <i class='nav-icon la la-question'></i> {{trans('lang.withdraw_gencies_manual')}}</a>
                        </li>
                        {{--  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositagencycountry') }}'>
                                  <i class='nav-icon la la-question'></i> {{trans('lang.deposit_agency_countries')}}</a>
                          </li>--}}
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown disabled">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.automatically')}}
                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.transfer_setting')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.manual')}}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferagency') }}'><i
                                        class='nav-icon la la-question'></i> {{trans('lang.transfer_agencies')}}</a>
                        </li>
                        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transfersetting') }}'><i class='nav-icon la la-question'></i>إعدادات التحويل</a></li>
                        {{-- <li class='nav-item'><a class='nav-link'
                                                 href='{{ backpack_url('receivingagenciescountry') }}'><i
                                         class='nav-icon la la-question'></i> {{trans('lang.receiving_agencies_countries')}}
                             </a>
                         </li>--}}
                    </ul>
                </li>
            </ul>
            <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                        {{trans('lang.automatically')}}
                    </a>
                    <ul class="nav-dropdown-items"></ul>
                </li>
            </ul>
        </li>
        <!-- Manage Purchase-->
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.manage_purchases')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardcategory') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.DigitalCardCategories') }}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardsprovider') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.DigitalCardsProviders') }}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardstore') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.DigitalCardStores') }}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardproviderpackage') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.DigitalCardsItems') }}</a></li>
                {{--  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcard') }}'><i
                                  class='nav-icon la la-question'></i> {{__('lang.DigitalCardsItems') }}</a></li>--}}
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardspurchase') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.DigitalCardsPurchases') }}</a></li>
                {{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('dcardspurchasesdetail') }}'><i
                                 class='nav-icon la la-question'></i> {{__('lang.DCardsPurchasesDetails') }}</a>
                 </li>--}}


            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.pull_earning_manag')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('freelancingplatform') }}'>
                        <i class='nav-icon la la-question'></i> {{trans('lang.FreelancingPlatforms')}}</a></li>
            </ul>
        </li>
    </ul>

</li>

<!-- Manage TradingServices-->
{{--<li class="nav-item nav-dropdown">--}}
{{--    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>--}}
{{--        {{trans('lang.manage_trading_services')}}--}}
{{--    </a>--}}
{{--    <ul class="nav-dropdown-items">--}}

{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingagency') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.trading_agencies')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingservice') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.TradingServices')}}</a></li>--}}

{{--        --}}{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingservicesorder') }}'>--}}
{{--                        <i class='nav-icon la la-question'></i> {{__('lang.TradingServicesOrders')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingservicecustomer') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.TradingServiceCustomers')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('livebroadcasting') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.live_broadcastings')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerlivebroadcasting') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.CustomerLiveBroadcastings')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingcustomerpoint') }}'>--}}
{{--                <i class='nav-icon la la-question'></i> {{__('lang.TradingCustomerPoints')}}</a></li>--}}
{{--    </ul>--}}
{{--</li>--}}
<!-- Manage Orders-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_orders')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.Deposits')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositordersuspended') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.deposit_order_suspendeds')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositordercompleted') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.deposit_order_completeds')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositorderrejected') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.deposit_order_rejecteds')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositorder') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.AllDepositOrders')}}</a></li>

            </ul>
        </li>

        <!-- withdraw-->

        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.withdraw_orders')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('withdrawordersuspended') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.withdraw_order_suspended')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('withdrawordercompleted') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.withdraw_order_completed')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('withdraworderrejected') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.withdraw_order_rejecteds')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('withdraworder') }}'><i
                                class='nav-icon la la-question'></i> {{__('lang.all_withdraws')}}</a></li>
            </ul>
        </li>
        <!-- move it as child in customer -->
        {{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerspops') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerSPOps')}}</a></li>--}}
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerdcorder') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerDCOrders')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('identitydocumentation') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.identitydocumentation')}}</a></li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.TransferWithdrawOrders')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferwithdrawordersuspended') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.transferwithdrawordersuspended')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferwithdrawordercompleted') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.transferwithdrawordercompleted')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferwithdraworderrejected') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.transferwithdraworderrejected')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferwithdraworder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.AllTransferWithdrawOrders')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('wallettransfer') }}'>
                        <i class='nav-icon la la-question'></i> التحويل بين المحافظ</a></li>

            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
                {{trans('lang.PayingOrders')}}
            </a>
            <ul class="nav-dropdown-items">
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('suspendedpayingorder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.suspended_paying_orders')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('acceptedpayingorder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.acceptedpayingorder')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('completedpayingorder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.completedpayingorder')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('rejectedpayingorder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.rejectedpayingorder')}}</a></li>
                <li class='nav-item'><a class='nav-link' href='{{ backpack_url('payingorder') }}'>
                        <i class='nav-icon la la-question'></i> {{__('lang.allpayingorder')}}</a></li>
            </ul>
        </li>
        {{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerconsultantorder') }}'><i--}}
        {{--                        class='nav-icon la la-question'></i> {{__('lang.CustomerConsultantOrders') }}</a></li>--}}
        {{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultantorderprocedure') }}'><i--}}
        {{--                        class='nav-icon la la-question'></i> {{__('lang.consultantOrderProcedures') }}</a></li>--}}
        {{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingservicesorder') }}'>--}}
        {{--                <i class='nav-icon la la-question'></i> {{__('lang.TradingServicesOrders')}}</a></li>--}}
    </ul>
</li>
<!-- Manage consultants-->
{{--<li class="nav-item nav-dropdown">--}}
{{--    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>--}}
{{--        {{trans('lang.manage_consultants')}}--}}
{{--    </a>--}}
{{--    <ul class="nav-dropdown-items">--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultantscategory') }}'><i--}}
{{--                        class='nav-icon la la-question'></i> {{__('lang.ConsultantsCategories')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultant') }}'><i--}}
{{--                        class='nav-icon la la-question'></i>--}}
{{--                {{__('lang.consultants')}}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('proceduretype') }}'><i--}}
{{--                        class='nav-icon la la-question'></i> {{__('lang.procedure_types')}}</a></li>--}}

{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('comment') }}'><i--}}
{{--                        class='nav-icon la la-question'></i>--}}
{{--                {{__('lang.Comments')}}</a></li>--}}

{{--    </ul>--}}
{{--</li>--}}
{{--<!-- Manage trainings-->--}}
{{--<li class="nav-item nav-dropdown">--}}
{{--    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>--}}
{{--        {{trans('lang.manage_trainings')}}--}}
{{--    </a>--}}
{{--    <ul class="nav-dropdown-items">--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursecategory') }}'><i--}}
{{--                        class='nav-icon la la-question'></i> {{__('lang.CourseCategories') }}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('teacherdetail') }}'><i--}}
{{--                        class='nav-icon la la-question'></i> {{__('lang.TeacherDetails') }}</a></li>--}}
{{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursetraining') }}'><i--}}
{{--                        class='nav-icon la la-question'></i> {{__('lang.CourseTrainings') }}</a></li>--}}
{{--        <!-- will added internally-->--}}
{{--        --}}{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursepart') }}'><i--}}
{{--                       class='nav-icon la la-question'></i>--}}
{{--               CourseParts</a></li>--}}
{{--       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursesubject') }}'><i--}}
{{--                       class='nav-icon la la-question'></i> {{__('lang.CourseSubjects') }}</a></li>--}}
{{--      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursesubjectattachment') }}'><i--}}
{{--                       class='nav-icon la la-question'></i> {{__('lang.CourseSubjectAttachments') }}</a></li>--}}
{{--       <li class='nav-item'><a class='nav-link' href='{{ backpack_url('courseexercise') }}'><i--}}
{{--                       class='nav-icon la la-question'></i> {{__('lang.CourseExercises') }}</a></li>--}}
{{----}}
{{--    </ul>--}}
{{--</li>--}}
<!-- Manage Customers-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" style="font-weight: bold;" href="#"><i
                class="nav-icon la la-users"></i> {{trans('lang.manage_customers')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customer') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.all_customers')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerbankaccount') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerBankAccounts')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerloverbankaccount') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerLoverBankAccounts')}}</a></li>

        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('customersloyaltypointsprice') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomersLoyaltyPointsPrices')}}</a></li>

        {{--        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customercourse') }}'><i--}}
        {{--                        class='nav-icon la la-question'></i> {{__('lang.CustomerCourses') }}</a></li>--}}

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('badge') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.Badges')}}</a></li>
    </ul>
</li>
<!-- Manage System users-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> {{trans('lang.system_users')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i>
                <span>{{trans('lang.Users')}}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i
                        class="nav-icon la la-id-badge"></i> <span>{{trans('lang.roles')}}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i
                        class="nav-icon la la-key"></i> <span>{{trans('lang.permissions')}}</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('logevents') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.LogEvents')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i
                        class='nav-icon la la-terminal'></i>
                {{__('lang.Logs')}}</a></li>
    </ul>
</li>
<!-- Manage General Settings -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.general_setting')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i
                        class='nav-icon la la-question'></i>
                {{trans('lang.countries')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('city') }}'><i
                        class='nav-icon la la-question'></i>
                {{trans('lang.cities')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('currency') }}'><i
                        class='nav-icon la la-question'></i>
                {{trans('lang.Currencies')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('language') }}'>
                <i class='nav-icon la la-question'></i>
                {{__('lang.Languages')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('emailtemplate') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.email_tmp_settings')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'>
                <i class='nav-icon fa fa-cog'></i>
                {{__('lang.system_Settings')}}</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.NewHome')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/homecontent') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.banner_content')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/whychoose') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.our_services')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/flowstep') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.how_system_works')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/howitwork') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.Why_Choose_Us')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/testimonial') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.testimonial')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/blog_announce') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.blog_announce')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/faq') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.faq')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/contact') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.contact')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/bg_image') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.bg_image')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/team') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.team')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/company_policy') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.company_policy')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/social') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.manage_social')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/seo') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.seo')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('frontend/about') }}'>
                <i class='nav-icon la la-question'></i> {{__('lang.about_us')}}</a>

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


{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositwithdrawprocess') }}'><i class='nav-icon la la-question'></i> DepositWithdrawProcesses</a></li>--}}

{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('depositagencymethod') }}'><i class='nav-icon la la-question'></i> AgencyDepositMethods</a></li>--}}

{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerfinanceaccount') }}'><i
                class='nav-icon la la-question'></i> CustomerFinanceAccounts</a></li>--}}


{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tradingagencyservice') }}'><i class='nav-icon la la-question'></i> TradingAgencyServices</a></li>--}}


{{--<li class='nav-item'><a class='nav-link' href='{{ backpack_url('pullearning') }}'><i class='nav-icon la la-question'></i> PullEarnings</a></li>--}}

