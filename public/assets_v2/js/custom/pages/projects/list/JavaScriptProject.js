



var CardHomeAllvouchers = document.getElementById("CardHomeAllvouchers");
var SMS = document.getElementById("cardSendSMS");

SMS.style.display = "none";
CardHomeAllvouchers.style.display = "block";

function SendSMS() {



    if (SMS.style.display === "none") {
        SMS.style.display = "block";
        CardHomeAllvouchers.style.display = "none";
    } else {
        SMS.style.display = "none";
    }
}

/****************************************************/
var cardSendEmail = document.getElementById("cardSendEmail");

cardSendEmail.style.display = "none";
CardHomeAllvouchers.style.display = "block";

function SendEmail() {



    if (cardSendEmail.style.display === "none") {
        cardSendEmail.style.display = "block";
        CardHomeAllvouchers.style.display = "none";
       
    } else {
        cardSendEmail.style.display = "none";
    }
}

/****************************************************/
var cardMessageSuccess = document.getElementById("cardMessageSuccess");

cardMessageSuccess.style.display = "none";

CardHomeAllvouchers.style.display = "block";

function MessageSuccess() {



    if (cardMessageSuccess.style.display === "none") {
        cardMessageSuccess.style.display = "block";
        CardHomeAllvouchers.style.display = "none";
        SMS.style.display = "none";
        toastr.success('تم إرسال الرسالة بنجاح')
        cardSendEmail.style.display = "none";
    } else {
        cardMessageSuccess.style.display = "none";
    }
}

/***************************/
function ShowCardHome() {
    CardHomeAllvouchers.style.display = "block";
    cardMessageSuccess.style.display = "none";
    
}

/***********************************************/


