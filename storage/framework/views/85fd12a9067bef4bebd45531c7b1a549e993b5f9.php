<div class="modal fade" id="kt_modal_error" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-300px">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="fw-bolder style-Address-Modal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                  stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M12 8V12" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M12 16H12.01" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>

                        <span class="px-1"><?php echo e(cp('alert')); ?></span>
                    </h2>

                </div>

                <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                    <i class="fas fa-times  style-icon-Close-Modal"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body scroll-y ">
                <div class="row">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row">
                            <p class="style-title-wronge-platform" id="kt_modal_error_text"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="kt_modal_rang_error" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-300px">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="fw-bolder style-Address-Modal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                  stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M12 8V12" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M12 16H12.01" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>

                        <span class="px-1"><?php echo e(cp('alert')); ?></span>
                    </h2>

                </div>

                <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                    <i class="fas fa-times  style-icon-Close-Modal"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body scroll-y ">
                <div class="row">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row">
                            <p class="style-title-wronge-platform" id="kt_modal_rang_error_text"></p>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <p class="style-label-form"><?php echo e(cp('min_deposit_amount')); ?> :</p>
                            </div>
                            <div class="px-2">
                                <p class="style-Max-Sale-Platform"><span id="kt_modal_rang_error_min"></span>$</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div>
                                <p class="style-label-form"><?php echo e(cp('max_deposit_amount')); ?> :</p>
                            </div>
                            <div class="px-2">
                                <p class="style-Max-Sale-Platform"><span id="kt_modal_rang_error_max"></span>$</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_success" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-300px">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="fw-bolder style-Address-Modal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                            <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003" stroke="white"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <span class="px-1"><?php echo e(cp('kt_modal_success_title')); ?></span>
                    </h2>

                </div>

                <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                    <i class="fas fa-times  style-icon-Close-Modal"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body scroll-y ">
                <div class="row">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row">
                            <p class="style-title-wronge-platform" id="kt_modal_success_text"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_Quick_introductory_tour" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px">
        <div class="modal-content">
            <video class="ratio ratio-16x9" title="<?php echo e(cp('quick_introductory_tour')); ?>" draggable="false" contextmenu="false" poster="/assets_v2/media/imagesWebsite/ImageVideoTour.jpg" contenteditable="false" itemscope controls>
                <source src="/assets_v2/media/imagesWebsite/video2.mp4" type="video/mp4" />
            </video>
        </div>
    </div>

</div>

<div class="modal fade" id="kt_modal_Found_Error_data" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <div class="modal-content">
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder style-Address-Modal">
                    <?php echo e(cp('you_found_error')); ?>

                </h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                    <i class="fas fa-times  style-icon-Close-Modal"></i>

                </div>
                <!--end::Close-->
            </div>


            <div class="modal-body scroll-y ">
                <form id="errorReportForm" action="<?php echo e(route('send_error_report')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <span id="error_msg_report" style="color: red"></span>
                            <div class="col-md-12 my-3">
                                <label class="style-label-form"><?php echo e(cp('error_link')); ?></label>
                                <input type="text" class="form-control" required name="error_link"/>
                            </div>
                            <div class="col-md-12 my-3">
                                <label class="style-label-form"><?php echo e(cp('what_you_done_before_error')); ?></label>
                                <input type="text" class="form-control" required name="error_action"/>
                            </div>
                            <div class="col-md-12 my-3">
                                <label class="style-label-form"><?php echo e(cp('download')); ?></label>
                                <div class="input-group">
                                    <input type="text" style="border-radius: 0;" class="form-control" id="error_file_title" disabled/>
                                    <input type="file" required name="error_file"
                                           id="error_file" accept=".png, .jpg, .jpeg"
                                           onchange="getFileData(this, 'error_file_title');"
                                           style="display: none;/*width: 0 !important;height: 0 !important;overflow: hidden;opacity: 0;*/">
                                    <a href="#" type="button" id="error_file_btn">
                                                <span class="input-group-text text-white" style="font-family:Almarai!important;border-radius: 0px!important;background-color:#E51C39;" id="basic-addon2">
                                                    <?php echo e(cp('upload_file')); ?>

                                                </span>
                                    </a>
                                </div>
                                <label class="pt-3 style-title-bio-card2 ">
                                    <?php echo e(cp('upload_file_or_image_of_error')); ?> (<?php echo e(cp('not_more_that_mb')); ?> , PDF, PNG ,GIF ,JPG ,JPEG)
                                </label>
                            </div>

                        </div>
                        <div class="modal-footer col-md-12 flex-center">
                            <button type="submit" id="sendErrorReportBtn" class="btn form-control BntAdd-Modal">
                                <?php echo e(cp('send_error')); ?>

                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<div class="footer py-4 style-footer-desktop-respisve d-flex flex-lg-column d-none" id="kt_footer">

    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2021©</span>
            <a href="" target="_blank" class="text-gray-800 text-hover-primary">CTPAY</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>

<div class="footer  style-footer-Mbile-respisve fixed-bottom d-flex flex-lg-column" id="kt_footer">

    <div class=" style-respoinsive-hide-icons-header-Mobile">
        <div class="topbar  text-center d-flex py-3   flex-shrink-0" style="justify-content: center;">
            <!--begin::Search-->
            <div class="d-flex align-items-stretch">
                <!--begin::Search-->
                <div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true"
                     data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu"
                     data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true"
                     data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">


                </div>
                <!--end::Search-->
            </div>


            <div class="d-flex mx-4 style-icons-footer-bottom-Mobile  align-items-center  ms-1 ms-lg-3">
                <!--begin::Menu toggle-->
                <div class="topbar-item flex-column active position-relative px-2" data-kt-menu-trigger="click"
                     data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom"
                     onclick="window.location.replace('<?php echo e(url('/wallet/dashboard')); ?>')"
                >

                        <svg width="23" height="23" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.9212 19.1938H3.0707C2.88113 19.1938 2.69934 19.1185 2.5653 18.9845C2.43126 18.8504 2.35596 18.6686 2.35596 18.4791V7.13857C2.35596 6.94901 2.43126 6.76721 2.5653 6.63317C2.69934 6.49913 2.88113 6.42383 3.0707 6.42383C3.26026 6.42383 3.44205 6.49913 3.57609 6.63317C3.71013 6.76721 3.78543 6.94901 3.78543 7.13857V17.7643H15.2065V7.13857C15.2065 6.94901 15.2818 6.76721 15.4158 6.63317C15.5499 6.49913 15.7316 6.42383 15.9212 6.42383C16.1108 6.42383 16.2926 6.49913 16.4266 6.63317C16.5606 6.76721 16.6359 6.94901 16.6359 7.13857V18.4791C16.6359 18.6686 16.5606 18.8504 16.4266 18.9845C16.2926 19.1185 16.1108 19.1938 15.9212 19.1938Z"></path>
                            <path d="M18.2854 10.2189C18.1915 10.219 18.0986 10.2005 18.0118 10.1646C17.9251 10.1287 17.8463 10.0761 17.7799 10.0098L9.49557 1.72546L1.21127 10.0098C1.07647 10.1399 0.895929 10.212 0.708527 10.2104C0.521125 10.2087 0.34186 10.1336 0.209342 10.001C0.0768238 9.86853 0.00165549 9.68926 2.7019e-05 9.50186C-0.00160145 9.31446 0.0704401 9.13392 0.200635 8.99911L8.98858 0.209266C9.12261 0.0752731 9.30437 0 9.4939 0C9.68342 0 9.86518 0.0752731 9.99922 0.209266L18.791 8.99911C18.8908 9.0991 18.9588 9.22644 18.9863 9.36505C19.0138 9.50365 18.9996 9.64731 18.9455 9.77785C18.8914 9.90839 18.7998 10.02 18.6824 10.0985C18.5649 10.177 18.4267 10.2189 18.2854 10.2189V10.2189Z"></path>
                            <path d="M11.5692 19.1938H7.42372C7.23416 19.1938 7.05237 19.1185 6.91833 18.9844C6.78429 18.8504 6.70898 18.6686 6.70898 18.479V12.3075C6.70898 12.118 6.78429 11.9362 6.91833 11.8021C7.05237 11.6681 7.23416 11.5928 7.42372 11.5928H11.5692C11.7588 11.5928 11.9406 11.6681 12.0746 11.8021C12.2086 11.9362 12.2839 12.118 12.2839 12.3075V18.479C12.2839 18.6686 12.2086 18.8504 12.0746 18.9844C11.9406 19.1185 11.7588 19.1938 11.5692 19.1938ZM8.13846 17.7643H10.8545V13.0222H8.13846V17.7643Z"></path>
                        </svg>


                        <span class="pt-3">الرئيسية</span>

                </div>

                <!--begin::Menu toggle-->

            </div>
            <div class="d-flex mx-4 style-icons-footer-bottom-Mobile align-items-center flex-column ms-1 ms-lg-3">
                <!--begin::Menu toggle-->
                <div class="topbar-item flex-column position-relative px-2" data-kt-menu-trigger="click"
                     data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom"
                     onclick="window.location.replace('<?php echo e(route('list_deposit_withdraws')); ?>')">

                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.5 7V8.5" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M11.5 14.5V16" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M10 14.5H12.25C13.075 14.5 13.75 13.825 13.75 13C13.75 12.175 13.075 11.5 12.25 11.5H10.75C9.925 11.5 9.25 10.825 9.25 10C9.25 9.175 9.925 8.5 10.75 8.5H13"
                                  stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M11.5 4C15.625 4 19 7.375 19 11.5C19 15.625 15.625 19 11.5 19C7.375 19 4 15.625 4 11.5V9.25"
                                  stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M7 12.25L4 9.25L1 12.25" stroke-width="1.5" stroke-miterlimit="10"
                                  stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.5 1C17.275 1 22 5.725 22 11.5C22 17.275 17.275 22 11.5 22" stroke-width="1.5"
                                  stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="pt-3">العمليات</span>

                </div>

                <!--begin::Menu toggle-->

            </div>
            <div class="d-flex mx-4  style-icons-footer-bottom-Mobile align-items-center flex-column ms-1 ms-lg-3">
                <!--begin::Menu toggle-->
                <div class="topbar-item flex-column position-relative px-2" data-kt-menu-trigger="click"
                     data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom"
                     onclick="window.location.replace('<?php echo e(url('/account/profile/dashboard')); ?>')">

                        <svg width="23" height="23" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 19C7.62108 19 5.78435 18.4428 4.22209 17.399C2.65982 16.3551 1.44218 14.8714 0.723149 13.1355C0.0041162 11.3996 -0.184015 9.48946 0.182544 7.64665C0.549104 5.80383 1.45389 4.11109 2.78249 2.78249C4.11109 1.45389 5.80383 0.549104 7.64665 0.182544C9.48946 -0.184015 11.3996 0.0041162 13.1355 0.723149C14.8714 1.44218 16.3551 2.65982 17.399 4.22209C18.4428 5.78435 19 7.62108 19 9.5C19 12.0196 17.9991 14.4359 16.2175 16.2175C14.4359 17.9991 12.0196 19 9.5 19ZM9.5 1.46154C7.91015 1.46154 6.35599 1.93299 5.03407 2.81627C3.71216 3.69954 2.68185 4.95498 2.07343 6.42382C1.46502 7.89265 1.30583 9.50892 1.616 11.0682C1.92616 12.6275 2.69175 14.0599 3.81595 15.1841C4.94015 16.3083 6.37247 17.0738 7.93178 17.384C9.49109 17.6942 11.1074 17.535 12.5762 16.9266C14.045 16.3182 15.3005 15.2878 16.1837 13.9659C17.067 12.644 17.5385 11.0899 17.5385 9.5C17.5385 7.36807 16.6916 5.32346 15.1841 3.81595C13.6765 2.30845 11.6319 1.46154 9.5 1.46154Z"></path>
                            <path d="M9.50004 10.2305C8.77738 10.2305 8.07094 10.0162 7.47007 9.61476C6.8692 9.21327 6.40088 8.64262 6.12433 7.97496C5.84777 7.30731 5.77542 6.57265 5.9164 5.86387C6.05739 5.15509 6.40538 4.50404 6.91638 3.99304C7.42738 3.48204 8.07843 3.13405 8.78721 2.99306C9.49599 2.85208 10.2307 2.92443 10.8983 3.20099C11.566 3.47754 12.1366 3.94586 12.5381 4.54673C12.9396 5.1476 13.1539 5.85404 13.1539 6.5767C13.1539 7.54576 12.7689 8.47513 12.0837 9.16036C11.3985 9.84559 10.4691 10.2305 9.50004 10.2305ZM9.50004 4.38439C9.06644 4.38439 8.64258 4.51297 8.28206 4.75386C7.92153 4.99476 7.64054 5.33715 7.47461 5.73774C7.30868 6.13833 7.26527 6.57913 7.34986 7.0044C7.43445 7.42966 7.64324 7.82029 7.94984 8.12689C8.25644 8.43349 8.64707 8.64229 9.07234 8.72688C9.49761 8.81147 9.93841 8.76806 10.339 8.60213C10.7396 8.4362 11.082 8.1552 11.3229 7.79468C11.5638 7.43416 11.6923 7.0103 11.6923 6.5767C11.6923 5.99526 11.4614 5.43764 11.0502 5.0265C10.6391 4.61537 10.0815 4.38439 9.50004 4.38439Z"></path>
                            <path d="M16.4789 15.3461C16.3774 15.3467 16.277 15.3263 16.1839 15.2861C16.0908 15.2458 16.0071 15.1866 15.9381 15.1122C15.1624 14.2662 14.2196 13.5903 13.1693 13.1274C12.1189 12.6645 10.984 12.4246 9.83616 12.423H9.16385C7.02431 12.4184 4.96695 13.2466 3.42732 14.7322C3.28506 14.8496 3.10369 14.9089 2.91957 14.8981C2.73545 14.8873 2.56222 14.8073 2.43461 14.6742C2.307 14.541 2.23446 14.3645 2.23154 14.1801C2.22862 13.9957 2.29553 13.817 2.41886 13.6799C4.22815 11.9311 6.64756 10.956 9.16385 10.9614H9.83616C11.1853 10.9645 12.5193 11.2465 13.7542 11.7898C14.9892 12.3331 16.0984 13.1259 17.0123 14.1184C17.1089 14.2225 17.173 14.3525 17.1969 14.4924C17.2207 14.6324 17.2033 14.7763 17.1467 14.9065C17.0902 15.0368 16.9968 15.1477 16.8782 15.2257C16.7596 15.3038 16.6208 15.3456 16.4789 15.3461Z"></path>
                        </svg>
                        <span class="pt-3">الملف الشخصي</span>


                </div>

                <!--begin::Menu toggle-->

            </div>
            <div class="d-flex mx-4 style-icons-footer-bottom-Mobile align-items-center flex-column ms-1 ms-lg-3">
                <!--begin::Menu toggle-->
                <div class="topbar-item flex-column position-relative px-2" data-kt-menu-trigger="click"
                     id="kt_aside_mobile_toggle">
                    <svg width="23" height="23" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1H14" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"></path>
                        <path d="M1 7H14" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"></path>
                        <path d="M1 13H14" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"></path>
                    </svg>
                    <span class="pt-3">القائمة</span>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/bootstrap.min.js')); ?>"></script>
<?php echo $__env->yieldContent('footer'); ?>

<script src="<?php echo e(asset('/org_assets/dist/js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('/org_assets/dist/js/custom.js')); ?>"></script>


<script src="<?php echo e(asset('/org_assets/dist/cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="/assets_v2/plugins/global/plugins.bundle.js"></script>
<script src="/assets_v2/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="/assets_v2/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="/assets_v2/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<script src="/assets_v2/js/custom/pages/projects/list/JavaScriptSelect.js"></script>
<script src="/assets_v2/js/custom/pages/projects/list/DataTableProjects.js"></script>
<script src="/assets_v2/js/custom/pages/projects/list/ToastrMessage.js"></script>
<!--begin::Page Custom Javascript(used by this page)-->
<script src="/assets_v2/js/custom/widgets.js"></script>
<script src="/assets_v2/js/custom/apps/chat/chat.js"></script>
<script src="/assets_v2/js/custom/modals/upgrade-plan.js"></script>
<script src="/assets_v2/js/custom/modals/users-search.js"></script>
<script src="/assets_v2/js/custom/helper.js"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->

<script src="<?php echo e(asset('/org_assets/plugins/froiden-helper/helper.js')); ?>"></script>


<script>


    $(document).ready(function () {


        // $( '.header-box .header-nav-menu li a' ).on( 'click', function () {
        //     $( '.header-box .header-nav-menu' ).find( 'li .active' ).removeClass( 'active' );
        //     $( this ).parent( 'li' ).addClass( 'active' );
        // });
        //


        $('.sidebar-invoice').hide();

        $('.dropdown-btn-invoice').click(function () {
            $('.sidebar-invoice').toggle();
        });


        $('.transfer-coin-btn > a').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('.transfer-coin-btn > a').removeClass('active');
            $('.transfer-coin-content-box').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });


    });

    $(document).ready(function () {
        $('#example').DataTable(
            {

                "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
                "iDisplayLength": 5,
                "paging": false,


            }
        );
        $('#example2').DataTable(
            {

                "paging": false,


            }
        );
        $('#example3').DataTable(
            {

                "paging": false,


            }
        );

        $('#example4').DataTable(
            {

                "paging": false,


            }
        );
        $('#example5').DataTable(
            {

                "paging": false,


            }
        );
        $('#example6').DataTable(
            {

                "paging": false,


            }
        );


    });


    function getFileData(myFile, id) {
        console.log('here')
        console.log(id)
        var file = myFile.files[0];
        var filename = file.name;
        console.log(filename)
        $('#' + id).val(filename)
    }
    
    $(document).ready(function () {
        $('#error_msg_report').text('')
        
        $('.transfer-coin-btn > a').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('.transfer-coin-btn > a').removeClass('active');
            $('.transfer-coin-content-box').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });
        $('.lang-select').click(function (event) {
            event.preventDefault();
            var url = document.URL;
            var lang = $(this).data("lang");
            var current_lang = "<?php echo e(LaravelLocalization::setLocale()); ?>";
            if (lang != current_lang) {
                var url = url.replace(current_lang, lang);
                location.replace(url);
            }

        });
        $(document).on("click", '.dropdown', function () {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(300);
        });
        $(document).on("focusout", '.dropdown', function () {
            $(this).removeClass('active');
            $(this).find('.dropdown-menu').slideUp(300);
        });

        $(document).on("click", '.dropdown .dropdown-menu li', function () {

            $(this).parents('.dropdown').find('span').text($(this).text());
            $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
        });


    });


    function checkAll(bx) {
        var cbs = document.getElementsByTagName('input');
        for (var i = 0; i < cbs.length; i++) {
            if (cbs[i].type == 'checkbox') {
                cbs[i].checked = bx.checked;
            }
        }
    }

    function get_first_objectVal(obj) {
        return obj[Object.keys(obj)[0]]
    }

    
    document.getElementById('error_file_btn').onclick = function () {
        document.getElementById('error_file').click();
        console.log('here')
    };

    $('#errorReportForm').submit(function(e){
        e.preventDefault()
        let form = $(this)
        let form_data_obj = new FormData(form[0])
        $.ajax({
            url: form.attr('action'),
            processData: false,
            contentType: false,
            data: form_data_obj,
            type: "POST",
            beforeSend: function () {
                $("#sendErrorReportBtn").attr("disabled", true);
            },
            success: function (res) {
                $("#sendErrorReportBtn").attr("disabled", false);
                if (res.success){
                    $('#error_msg_report').text('')
                    $('#kt_modal_Found_Error_data').modal('hide')
                    showSuccessModal(res.message)
                }else{
                    $('#error_msg_report').text(response.message)
                }
                console.log(res)
            }, error: function (res) {
                console.log('res', res);
            },
        })
    });
    
</script>

<?php echo $__env->yieldContent('custom_js'); ?>

</body>

</html>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/wallet/footer.blade.php ENDPATH**/ ?>