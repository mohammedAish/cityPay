"use strict";
var kt_project_Operations_week_Wallet = {
    init: function() {
        ! function() {
            const t = document.getElementById("kt_project_Operations_week_Wallet");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 4, orderable: !1 }] });
            var r = document.getElementById("kt_filter_search_Catagory");
            r && r.addEventListener("keyup", (function(t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function() { kt_project_Operations_week_Wallet.init() }));


var kt_Record_activities_Table = {
    init: function() {
        ! function() {
            const t = document.getElementById("kt_Record_activities_Table");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 2, orderable: !1 }] });
            var r = document.getElementById("kt_filter_search_Foods");
            r && r.addEventListener("keyup", (function(t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_Record_activities_Table.init() }));




var kt_oparation_Table = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_oparation_Table");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 2, orderable: !1 }] });
            var r = document.getElementById("kt_filter_search_Operation");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_oparation_Table.init() }));


var kt_project_Processes_All = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Processes_All");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Processes_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Processes_All.init() }));


var kt_project_Deposit_requests = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Deposit_requests");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Deposit_requests_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Deposit_requests.init() }));



var kt_project_Withdrawal_requests = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Withdrawal_requests");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Withdrawal_requests_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Withdrawal_requests.init() }));



var kt_project_Transfer_requests = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Transfer_requests");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Transfer_requests_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Transfer_requests.init() }));




var kt_project_Bill_payment_requests = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Bill_payment_requests");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Bill_payment_requests_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Bill_payment_requests.init() }));


var kt_project_freelance_platforms = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_freelance_platforms");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_freelance_platforms_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_freelance_platforms.init() }));



var kt_project_voucher_requests = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_voucher_requests");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_voucher_requests_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_voucher_requests.init() }));


var kt_project_Security_Transfer_Requests_P2P = {
    init: function () {
        ! function () {
            const t = document.getElementById("kt_project_Security_Transfer_Requests_P2P");
            if (!t) return;
            t.querySelectorAll("tbody tr").forEach((t => {
                const e = t.querySelectorAll("td"),
                    r = moment(e[1].innerHTML, "MMM D, YYYY").format();
                e[1].setAttribute("data-order", r)
            }));
            const e = $(t).DataTable({ info: !1, order: [], columnDefs: [{ targets: 3, orderable: !1 }] });
            var r = document.getElementById("kt_project_Security_Transfer_Requests_P2P_Search_All");
            r && r.addEventListener("keyup", (function (t) { e.search(t.target.value).draw() }))
        }()
    }
};
KTUtil.onDOMContentLoaded((function () { kt_project_Security_Transfer_Requests_P2P.init() }));





/***********************DATA---TAbLE********************************************* */








var idShow = document.getElementById("IDShowWithTransferProduct");
var BtnClickShow = document.getElementById("BtnClickShow");

idShow.style.display = "none";
BtnClickShow.style.display = "block";

function clickShow() {
    
   

    if (idShow.style.display === "none") {
        idShow.style.display = "block";
        BtnClickShow.style.display = "none";
    } else {
        idShow.style.display = "none";
    }
}


var x = document.getElementById("IDShowWithTransferProduct2");
var BtnClickShow2 = document.getElementById("BtnClickShow2");

x.style.display = "none";
BtnClickShow2.style.display = "block";

function clickShow2() {



    if (x.style.display === "none") {
        x.style.display = "block";
        BtnClickShow2.style.display = "none";
    } else {
        x.style.display = "none";
    }
}


var b = document.getElementById("IDShowWithTransferProduct3");
//var BtnClickShow2 = document.getElementById("BtnClickShow2");

b.style.display = "none";
//BtnClickShow2.style.display = "block";

function clickShow3() {



    if (b.style.display === "none") {
        b.style.display = "block";
        //BtnClickShow2.style.display = "none";
    } else {
        b.style.display = "none";
    }
}


/**************************/

var header = document.getElementById("MyBtnSales");



var btns = header.getElementsByClassName("btn-style-Transger-sale2");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("btn-style-Transger-sale");
        current[0].className = current[0].className.replace("  btn-style-Transger-sale", "");
        this.className += "  btn-style-Transger-sale";
    });
}

/******************/



/***********************************************/


/***********************************************/
