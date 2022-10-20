<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
                class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

{{--
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>Pages</span></a></li>
--}}


{{--<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>{{trans('lang.News')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i
                        class="nav-icon la la-newspaper-o"></i> Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i
                        class="nav-icon la la-list"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tag"></i>
                Tags</a></li>
    </ul>
</li>--}}
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

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('packagescategory') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.PackagesCategories')}}</a></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('service') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.all_Services') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('servicespackage') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.ServicesPackages') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('loyaltypointsprice') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.LoyaltyPointsPrices') }}</a></li>

    </ul>
</li>
<!-- Manage Payments-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_payments')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('transferagency') }}'><i
                        class='nav-icon la la-question'></i> {{trans('lang.transfer_agencies')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('receivingagenciescountry') }}'><i
                        class='nav-icon la la-question'></i> {{trans('lang.receiving_agencies_countries')}}</a></li>
    </ul>
</li>
<!-- Manage Purchase-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_purchases')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcard') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.DigitalCards') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardsprovider') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.DigitalCardsProviders') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('digitalcardspurchase') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.DigitalCardsPurchases') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('dcardspurchasesdetail') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.DCardsPurchasesDetails') }}</a></li>
    </ul>
</li>
<!-- Manage Orders-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle " href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_orders')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerspops') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerSPOps')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerdcorder') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerDCOrders')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerdcorderdetail') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.customerDCOrder_details')}}</a></li>
        <li class='nav-item'></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customerconsultantorder') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomerConsultantOrders') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultantorderprocedure') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.ConsultantOrderProcedures') }}</a></li>
    </ul>
</li>
<!-- Manage consultants-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_consultants')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultantscategory') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.ConsultantsCategories')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('proceduretype') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.procedure_types')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('consultant') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.Consultants')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('comment') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.Comments')}}</a></li>

    </ul>
</li>
<!-- Manage trainings-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>
        {{trans('lang.manage_trainings')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursecategory') }}'><i
                        class='nav-icon la la-question'></i> CourseCategories</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('teacherdetail') }}'><i
                        class='nav-icon la la-question'></i> TeacherDetails</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursetraining') }}'><i
                        class='nav-icon la la-question'></i> CourseTrainings</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursepart') }}'><i
                        class='nav-icon la la-question'></i>
                CourseParts</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursesubject') }}'><i
                        class='nav-icon la la-question'></i> CourseSubjects</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coursesubjectattachment') }}'><i
                        class='nav-icon la la-question'></i> CourseSubjectAttachments</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('courseexercise') }}'><i
                        class='nav-icon la la-question'></i> CourseExercises</a></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customercourse') }}'><i
                        class='nav-icon la la-question'></i> CustomerCourses</a></li>
    </ul>
</li>
<!-- Manage Customers-->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i
                class="nav-icon la la-users"></i> {{trans('lang.manage_customers')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('customer') }}'><i
                        class='nav-icon la la-question'></i>
                {{__('lang.customers')}}</a></li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('customersloyaltypointsprice') }}'><i
                        class='nav-icon la la-question'></i> {{__('lang.CustomersLoyaltyPointsPrices')}}</a></li>
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
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'>
                <i class='nav-icon fa fa-cog'></i>
                {{__('lang.system_Settings')}}</a></li>
    </ul>
</li>
<!-- Manage Home Pages  -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>{{trans('صفحات الموقع')}}
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgnew') }}'><i
                        class='nav-icon la la-question'></i>
                الاخبار</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgservices') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgServices</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgservicecategory') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgServiceCategories</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgservicefeature') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgServiceFeatures</a></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgoffer') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgOffers</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgpagesetup') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgPageSetups</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgsettingwebsite') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgSettingWebsites</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgwhyus') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgWhyuses</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgcertificate') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgCertificates</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgpartener') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgParteners</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgbrokeragefirm') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgBrokerageFirms</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgpaymentcompany') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgPaymentCompanies</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgaboutcompanypagesettings') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgAboutCompanyPageSettings</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgcounter') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgCounters</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgcontactuspagesettings') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgContactUsPageSettings</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgcontactussociallinksetup') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgContactUsSocialLinkSetups</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgaccesspolicy') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgAccessPolicies</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgpostcategory') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgPostCategories</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('orgprivacypolicies') }}'><i
                        class='nav-icon la la-question'></i> Org\OrgPrivacyPolicies</a></li>

    </ul>
</li>


