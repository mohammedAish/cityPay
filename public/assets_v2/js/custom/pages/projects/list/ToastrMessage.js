

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toastr-top-left",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function toastrSuccessMessage(message){
    toastr.success(message)
}

function toastrErrorMessage(message){
    toastr.error(message)
}

function Clicksuccesmoneytransfer() {
    toastr.success('تم التحويل بنجاح')
}
function ClicksuccesmoneytransferEN() {
    toastr.success('Converted successfully')
}

function ClicksuccesSendEvouchers() {
    toastr.success('تم إيداع القسيمة بنجاح')
}
function ClicksuccesBuyEvouchers() {
    toastr.success('تم شراء القسيمة بنجاح')
}
function ClicksuccesInputCodeConifrem() {
    toastr.success('تم إدخال المفتاح الرئيسي بنجاح')
}

function ClicksuccesSaveChangePassword() {
    toastr.success('تم تغيير كلمة المرور بنجاح')
}
function ClicksuccesInputCodeConifremInfo() {
    toastr.info('يرجى إدخال المفتاح الرئيسي')
}

function ClicksuccesSendPaylentInvoices() {
    toastr.success('تم إرسال طلب سداد فاتورة بنجاح')
}


function ClicksuccesAddAccountfinancial() {
    toastr.success('تم إضافة الحساب بنجاح')
}

function ClickSendMessagesProblemItem() {
    toastr.success('تم إرسال المشكلة بنجاح')
}

function ClicksuccesSubmittingrequest() {
    toastr.success('تم تقديم طلب وكيل بنجاح')
}

function ClicksuccesBuydigitalcards() {
    toastr.success('تم شراء كرت رقمي بنجاح')
}

function ClicksuccesEditAccountfinancial() {
    toastr.success('تم تعديل الحساب بنجاح')
}

function Clicksuccesfinancingrepayment() {
    toastr.success('تم تقديم طلب وكيل بنجاح')
}

function Clicksuccesfinancingadvancepayment() {
    toastr.success('تم تقديم طلب سداد سلفة بنجاح')
}

function ClicksuccesConfiremDesposit() {
    toastr.success('تمت عملية الإيداع بنجاح')
}

function showErrorModal(text = '') {
    $('#kt_modal_error_text').empty()
    $('#kt_modal_error_text').append(text)
    $('#kt_modal_error').modal('show')
}

function showSuccessModal(text = '') {
    $('#kt_modal_success_text').empty()
    $('#kt_modal_success_text').append(text)
    $('#kt_modal_success').modal('show')
}

function ClickSendMessagesProblem() {
    toastr.success('تم إرسال الخطأ بنجاح')
}

function ClicksuccesWithdrawingAccount() {
    toastr.success('تمت عملية السحب بنجاح')
}

function ClicksuccesSendPaylentInvoicesEN() {
    toastr.success('An invoice payment request has been sent successfully')
}

function ClicksuccesSaveChangePasswordEN() {
    toastr.success('Password changed successfully')
}

function ClicksuccesInputCodeConifremEN() {
    toastr.success('The master key has been entered successfully')
}

function ClicksuccesInputCodeConifremInfoEN() {
    toastr.info('Please enter the master key')
}

function ClicksuccesSendEvouchersEN() {
    toastr.success('Coupon deposited successfully')
}
function ClicksuccesBuyEvouchersEN() {
    toastr.success('Voucher purchased successfully')
}







