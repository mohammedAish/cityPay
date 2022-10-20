<div class="wrapper d-flex flex-column flex-row-fluid">
    <div class="header align-items-stretch" id="kt_header">
        <div class="container-fluid d-flex align-items-stretch justify-content-between style-right">
            <!--begin::Aside mobile toggle-->
            <!--<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                    <i class="bi bi-list fs-1"></i>
                </div>
            </div>-->
            <!--end::Aside mobile toggle-->
            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <a href="../../demo13/dist/index.html" class="d-lg-none">
                    <img alt="Logo" src="/assets_v2/media/imagesWebsite/logo.png" class="h-25px">
                </a>
            </div>
            <!--end::Mobile logo-->
            <!--begin::Wrapper-->
            <div style="@if(app()->getLocale() == 'en') direction:ltr!important @else direction:rtl!important @endif"
                 class="d-flex  align-items-stretch justify-content-between flex-lg-grow-1">
                <!--begin::Navbar-->
                <div class="d-flex  align-items-center" id="kt_header_nav">
                    <button class="btn  style-wallet-total2  text-danger   show menu-dropdown"
                            data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                            data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                        {{auth()->user()->balanceFloat}}$
                        <svg width="24" height="24" class="style-wallet-total" viewBox="0 0 26 25" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.6316 20.8333V22.2222C24.6316 23.7569 23.4068 25 21.8947 25H2.73684C1.22474 25 0 23.7569 0 22.2222V2.77778C0 1.24306 1.22474 0 2.73684 0H21.8947C23.4068 0 24.6316 1.24306 24.6316 2.77778V4.16667H12.3158C10.8037 4.16667 9.57895 5.40972 9.57895 6.94444V18.0556C9.57895 19.5903 10.8037 20.8333 12.3158 20.8333H24.6316ZM12.3158 18.0556H26V6.94444H12.3158V18.0556ZM17.7895 14.5833C16.6537 14.5833 15.7368 13.6528 15.7368 12.5C15.7368 11.3472 16.6537 10.4167 17.7895 10.4167C18.9253 10.4167 19.8421 11.3472 19.8421 12.5C19.8421 13.6528 18.9253 14.5833 17.7895 14.5833Z"
                                  fill="#E51C39"></path>
                        </svg>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded style-Customer-Balance  w-250px"
                         data-kt-menu="true">
                        <div class="menu-item px-3 my-1">
                            <h3 class="style-Title-Notifications-dropdown  fw-bold px-6 my-3">
                                            <span class=" svg-icon-2 svg-icon-primary me-3">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24 12C24 15.1826 22.7357 18.2348 20.4853 20.4853C18.2348 22.7357 15.1826 24 12 24C8.8174 24 5.76516 22.7357 3.51472 20.4853C1.26428 18.2348 0 15.1826 0 12C0 8.8174 1.26428 5.76516 3.51472 3.51472C5.76516 1.26428 8.8174 0 12 0C15.1826 0 18.2348 1.26428 20.4853 3.51472C22.7357 5.76516 24 8.8174 24 12ZM10.8 13.2V16.8C10.8 17.1183 10.9264 17.4235 11.1515 17.6485C11.3765 17.8736 11.6817 18 12 18C12.3183 18 12.6235 17.8736 12.8485 17.6485C13.0736 17.4235 13.2 17.1183 13.2 16.8V13.2C13.2 12.8817 13.0736 12.5765 12.8485 12.3515C12.6235 12.1264 12.3183 12 12 12C11.6817 12 11.3765 12.1264 11.1515 12.3515C10.9264 12.5765 10.8 12.8817 10.8 13.2ZM12 6.6C11.5226 6.6 11.0648 6.78964 10.7272 7.12721C10.3896 7.46477 10.2 7.92261 10.2 8.4C10.2 8.87739 10.3896 9.33523 10.7272 9.67279C11.0648 10.0104 11.5226 10.2 12 10.2C12.4774 10.2 12.9352 10.0104 13.2728 9.67279C13.6104 9.33523 13.8 8.87739 13.8 8.4C13.8 7.92261 13.6104 7.46477 13.2728 7.12721C12.9352 6.78964 12.4774 6.6 12 6.6Z"
                                                          fill="#1B3160"></path>
                                                </svg>
                                            </span>
                                <strong class="me-auto Style-Modal-Titel-Moeny-customer">
                                    {{cp('client_balance')}}
                                </strong>
                            </h3>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <p class="Style-Modal-Titel-Moeny-customer-Moeny">
                                {{auth()->user()->balanceFloat}} $
                            </p>
                        </div>
                    </div>
                </div>
                
                
                
                <!--begin::Topbar-->
                @include('layouts.wallet.topbar')
                <!--end::Topbar-->
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
    <div class="div-only-mobile bg-white" style="margin-top: 1%;">
        @include('layouts.wallet.topbar_mobile')
    </div>

    <script>
        function change_lang(lang_id) {
            jQuery(function ($) {
                jQuery.ajax({
                    beforeSend: function (xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    url: '{{ URL::to("/change_language")}}',
                    type: "POST",
                    data: {"languages_id": lang_id, "_token": "{{ csrf_token() }}"},
                    success: function (res) {
                        window.location.replace(res);
                        // window.location.reload();
                    },
                });
            });
        }
    </script>

