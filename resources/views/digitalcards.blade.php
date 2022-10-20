@extends('wallet.index')
@section('content')
    <section class="m-5">
        <div class="row mt-1 mb-1">
            <div class="col-md-12">
                <h2 class="style-dashboard-control-peanl-home pb-5"
                    style="color:#000!important;border-bottom: 1px solid #D0D0D0;">
                    الكروت الرقمية
                </h2>
            </div>
        </div>

        <div class="row style-right justify-content-start">
            <div class="col-md-5">
                <div class="card">

                    <div class="style-card-body-digital-cards">
                        <div class="card-title">
                            <h2 class="style-dashboard-control-peanl-home pb-5" style="color:#E81919!important;">
                                الشراء السريع
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 my-3 ">
                                <select name="role" data-control="select2" data-placeholder="حدد التصنيف"
                                        data-hide-search="true"
                                        class="form-select  style-select-profile style-label-form  ">
                                    <option></option>
                                    <option value="1">FXTM</option>
                                    <option value="2">FBS</option>
                                    <option value="3">Tether</option>
                                </select>
                            </div>
                            <div class="col-md-6  my-3 ">
                                <select name="role" data-control="select2" data-placeholder="حدد المنتج"
                                        data-hide-search="true"
                                        class="form-select style-select-profile style-label-form  ">
                                    <option></option>
                                    <option value="1">FXTM</option>
                                    <option value="2">FBS</option>
                                    <option value="3">Tether</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  my-3">
                                <select name="role" data-control="select2" data-placeholder="المتجر"
                                        data-hide-search="true"
                                        class="form-select style-select-profile style-label-form  ">
                                    <option></option>
                                    <option value="1">FXTM</option>
                                    <option value="2">FBS</option>
                                    <option value="3">Tether</option>
                                </select>
                            </div>
                            <div class="col-md-6  my-3">
                                <select name="role" data-control="select2" data-placeholder="حدد البطاقة"
                                        data-hide-search="true"
                                        class="form-select style-select-profile style-label-form  ">
                                    <option></option>
                                    <option value="1">FXTM</option>
                                    <option value="2">FBS</option>
                                    <option value="3">Tether</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  my-3">
                                <input type="text" placeholder="الكمية" class="form-control"/>
                            </div>
                            <div class="col-md-6  my-3">
                                <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_details_digital_Cards"
                                        class="form-control BntAdd-Modal">شراء
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 my-3">
                <h2 class="style-sale-digital-card  text-left">
                    50 ريال
                </h2>
                <img src="/assets_v2/media/imagesWebsite/unsplash_wQLAGv4_OYs.png"/>
            </div>
        </div>


        <!--begin::Modal title-->
        <div class="modal fade" id="kt_modal_details_digital_Cards" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-600px">
                <div class="modal-content">


                    <div class="modal-body scroll-y ">


                        <div class="row">
                            <div class="col-md-7">

                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">بيانات العملية</div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">التصنيف</div>
                                        <div class="text-end style-row-Invouce-text">متاجر رقمية</div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">المنتج</div>
                                        <div class="text-end style-row-Invouce-text">ايتونز</div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">المتجر</div>
                                        <div class="text-end style-row-Invouce-text">السعودي</div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">البطاقة</div>
                                        <div class="text-end style-row-Invouce-text">50 ريال</div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">الكمية</div>
                                        <div class="text-end style-row-Invouce-text">3</div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            جميع بياناتي السابقة صحيحة
                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                                <div class="modal-footer row flex-center">
                                    <div class="col-md-5">
                                        <button type="button" id="addCardBtn" class="btn  form-control BntAdd-Modal">
                                            تأكيد
                                        </button>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="reset" class="btn form-control BntAdd-Modal-close"
                                                data-bs-dismiss="modal" aria-label="Close"
                                                style="font-weight:600!important;;font-family:almarai!important;color:#fff;background-color:#262626;">
                                            إغلاق
                                        </button>
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-5">
                                <h2 class="style-sale-digital-card  text-left">
                                    50 ريال
                                </h2>
                                <img src="/assets_v2/media/imagesWebsite/unsplash_wQLAGv4_OYs.png"
                                     class="w-100 py-3 img-fluid"/>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section("custom_js")
<script>
    $('#addCardBtn').click(function (event) {
        console.log('here')
        event.preventDefault();
        $('#kt_modal_details_digital_Cards').modal('hide')
        showSuccessModal('تم شراء كرت رقمي بنجاح')
    })
</script>
@endsection