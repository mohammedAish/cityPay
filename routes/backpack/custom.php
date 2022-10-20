<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),[/*'dash_permission'*/]),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes


    Route::get('dashboard', 'DashboardController@index');
    Route::crud('currency', 'CurrencyCrudController');
    Route::crud('transferagency', 'TransferAgencyCrudController');
    Route::crud('transfersetting', 'TransferSettingCrudController');
    //Route::crud('receivingagenciescountry','ReceivingAgenciesCountryCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('city', 'CityCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('parentservice', 'ParentServiceCrudController');
    Route::crud('service', 'ServiceCrudController');
    Route::crud('parentservice/{parent_id}/service', 'ServiceCrudController');
    Route::crud('parentservice/{parent_id}/servicefeature', 'ServiceFeatureCrudController');
    Route::crud('packagescategory', 'PackagesCategoryCrudController');
    Route::crud('loyaltypointsprice', 'LoyaltyPointsPriceCrudController');
    Route::crud('servicespackage', 'ServicesPackageCrudController');
    Route::crud('customerspops', 'CustomerSPOpsCrudController');
    Route::crud('customersloyaltypointsprice', 'CustomersLoyaltyPointsPriceCrudController');
    Route::crud('digitalcardsprovider', 'DigitalCardsProviderCrudController');
    Route::crud('digitalcard', 'DigitalCardCrudController');
    Route::crud('digitalcardspurchase', 'DigitalCardsPurchaseCrudController');
    /*    Route::crud('dcardspurchasesdetail','DCardsPurchasesDetailCrudController');*/
    Route::crud('customerdcorder', 'CustomerDCOrderCrudController');
    Route::crud('consultantscategory', 'ConsultantsCategoryCrudController');
    Route::crud('consultant', 'ConsultantCrudController');
    Route::crud('comment', 'CommentCrudController');
    Route::crud('coursecategory', 'CourseCategoryCrudController');
    Route::crud('teacherdetail', 'TeacherDetailCrudController');
    Route::crud('coursetraining', 'CourseTrainingCrudController');
    Route::crud('coursetraining/{course_id}/courseParts', 'CoursePartCrudController');
    Route::crud('coursetraining/{course_id}/coursesubject', 'CourseSubjectCrudController');
    Route::crud('coursetraining/{course_id}/courseexercise', 'CourseExerciseCrudController');
    Route::crud('digitalcardsprovider/{package_id}/packages', 'DigitalCardProviderPackageCrudController');
    Route::crud('digitalcardspurchase/{purchase_id}/dcardspurchasesdetail', 'DCardsPurchasesDetailCrudController');
    Route::crud('depositagency/{agency_id}/fee_countries', 'DepositAgencyCountryCrudController');
    Route::crud('transferagency/{agency_id}/fee_countries', 'ReceivingAgenciesCountryCrudController');

    Route::crud('coursepart', 'CoursePartCrudController');
    Route::crud('coursesubject', 'CourseSubjectCrudController');
    Route::crud('courseexercise', 'CourseExerciseCrudController');
    Route::crud('customercourse', 'CustomerCourseCrudController');
    Route::crud('language', 'LanguageCrudController');
    Route::crud('orgnew', 'Org\OrgNewCrudController');
    Route::prefix('log')->name('log.')->namespace('log')->group(function () {
        Route::get('/index', 'LogController@index')->name('indexx');//becuase there are one named is log.index
    });
    Route::crud('logevents', 'LogEventsCrudController');
    Route::crud('orgservices', 'Org\OrgServicesCrudController');
    Route::crud('orgservicecategory', 'Org\OrgServiceCategoryCrudController');
    Route::crud('orgservicefeature', 'Org\OrgServiceFeatureCrudController');
    Route::crud('orgoffer', 'Org\OrgOfferCrudController');
    Route::crud('orgpagesetup', 'Org\OrgPageSetupCrudController');
    Route::crud('orgsettingwebsite', 'Org\OrgSettingWebsiteCrudController');
    Route::crud('orgwhyus', 'Org\OrgWhyUsCrudController');
    Route::crud('orgcertificate', 'Org\OrgCertificateCrudController');
    Route::crud('orgpartener', 'Org\OrgPartenerCrudController');
    Route::crud('orgbrokeragefirm', 'Org\OrgBrokerageFirmCrudController');
    Route::crud('orgpaymentcompany', 'Org\OrgPaymentCompanyCrudController');
    Route::crud('orgaboutcompanypagesettings', 'Org\OrgAboutCompanyPageSettingsCrudController');
    Route::crud('orgcounter', 'Org\OrgCounterCrudController');
    Route::crud('orgcontactuspagesettings', 'Org\OrgContactUsPageSettingsCrudController');
    Route::crud('orgcontactussociallinksetup', 'Org\OrgContactUsSocialLinkSetupCrudController');
    Route::crud('orgaccesspolicy', 'Org\OrgAccessPolicyCrudController');
    Route::crud('orgpostcategory', 'Org\OrgPostCategoryCrudController');
    Route::crud('orgprivacypolicies', 'Org\OrgPrivacyPoliciesCrudController');
    Route::crud('coursesubjectattachment', 'CourseSubjectAttachmentCrudController');
    Route::crud('customerdcorderdetail', 'CustomerDCOrderDetailCrudController');
    Route::crud('servicefeature', 'ServiceFeatureCrudController');
    Route::crud('customerconsultantorder', 'CustomerConsultantOrderCrudController');
    Route::crud('consultantorderprocedure', 'ConsultantOrderProcedureCrudController');
    Route::crud('proceduretype', 'ProcedureTypeCrudController');
    Route::crud('depositorder', 'DepositOrderCrudController');
    Route::crud('depositmethod', 'DepositMethodCrudController');
    Route::crud('depositmethod', 'DepositMethodCrudController');
    Route::crud('depositagency', 'DepositAgencyCrudController');
    // Route::crud('depositagencycountry','DepositAgencyCountryCrudController');
    Route::crud('customerbankaccount', 'CustomerBankAccountCrudController');
    Route::crud('customerloverbankaccount', 'CustomerLoverBankAccountCrudController');
    Route::crud('badge', 'BadgeCrudController');
    Route::crud('transferwithdrawordersuspended', 'TransferWithdrawOrderSuspendedCrudController');
    Route::crud('transferwithdrawordercompleted', 'TransferWithdrawOrderAcceptedCrudController');
    Route::crud('transferwithdraworderrejected', 'TransferWithdrawOrderRejectedCrudController');
    Route::crud('transferwithdraworder', 'TransferWithdrawOrderCrudController');
    Route::crud('wallettransfer', 'WalletTransferCrudController');
    /*    Route::crud('depositagencymethod', 'DepositAgencyMethodCrudController');*/
    Route::crud('freelancingplatform', 'FreelancingPlatformCrudController');
    Route::crud('customerfinanceaccount', 'CustomerFinanceAccountCrudController');
    Route::crud('serviceinstruction', 'ServiceInstructionCrudController');
    Route::crud('suspendedpayingorder', 'PayingOrderSuspendedCrudController');
    Route::crud('acceptedpayingorder', 'PayingOrderAcceptedCrudController');
    Route::crud('completedpayingorder', 'PayingOrderCompletedCrudController');
    Route::crud('rejectedpayingorder', 'PayingOrderRejectedCrudController');
    Route::crud('payingorder', 'PayingOrderCrudController');
    Route::crud('digitalcardcategory', 'DigitalCardCategoryCrudController');
    Route::crud('digitalcardstore', 'DigitalCardStoreCrudController');
    Route::crud('digitalcardproviderpackage', 'DigitalCardProviderPackageCrudController');
    Route::crud('tradingagency', 'TradingAgencyCrudController');
    Route::crud('tradingservice', 'TradingServiceCrudController');
    Route::crud('tradingcustomerpoint', 'TradingCustomerPointCrudController');
    Route::crud('tradingservicesorder', 'TradingServicesOrderCrudController');
    Route::crud('tradingservicecustomer', 'TradingServiceCustomerCrudController');
    Route::crud('livebroadcasting', 'LiveBroadcastingCrudController');
    Route::crud('customerlivebroadcasting', 'CustomerLiveBroadcastingCrudController');
    Route::crud('tradingagencyservice', 'TradingAgencyServiceCrudController');
    Route::crud('withdraworder', 'WithdrawOrderCrudController');
    Route::crud('withdrawordersuspended', 'WithdrawOrderSuspendedCrudController');
    Route::crud('withdrawordercompleted', 'WithdrawOrderCompletedCrudController');
    Route::crud('withdraworderrejected', 'WithdrawOrderRejectedCrudController');
    Route::crud('depositordersuspended', 'DepositOrderSuspendedCrudController');
    Route::crud('depositordercompleted', 'DepositOrderCompletedCrudController');
    Route::crud('depositorderrejected', 'DepositOrderRejectedCrudController');
    Route::crud('withdrawagency', 'WithdrawAgencyCrudController');
    Route::crud('pullearning', 'PullEarningCrudController');
    Route::crud('emailtemplate', 'EmailTemplateCrudController');
    Route::crud('frontend/{part?}', 'FrontEndCrudController');
    Route::crud('identitydocumentation', 'IdentityDocumentationCrudController');
    Route::crud('errorreport', 'ErrorReportCrudController');
}); // this should be the absolute last line of this file