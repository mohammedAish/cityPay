<div class="d-flex align-items-stretch flex-shrink-0">

    <div class="topbar d-flex align-items-stretch flex-shrink-0">
        <!--begin::Search-->
        <div class="d-flex align-items-stretch">
            <!--begin::Search-->
            <div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true"
                 data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu"
                 data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true"
                 data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom" data-kt-search="true">
            </div>
            <!--end::Search-->
        </div>
        <!--end::Search-->
        <div class="d-flex align-items-center  ms-2 ms-lg-3">
            <!--begin::Menu- wrapper-->
            <div class="btn btn-icon btn-color-warning position-relative w-50px h-50px w-md-50px h-md-40px"
                 data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                 data-kt-menu-placement="bottom-end">
                <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                <div class="et_b-icon">
                    <svg width="22" height="21" viewBox="0 0 22 21" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_26_10)">
                            <path d="M15.7721 6.47059C15.7721 2.89753 13.0556 0 9.70588 0C6.35614 0 3.63971 2.89753 3.63971 6.47059V12.9412L0 15.5294V16.8235H19.4118V15.5294L15.7721 12.9412V6.47059Z"
                                  fill="#9B9B9B"></path>
                            <path d="M12.1322 18.1177H7.2793C7.2793 19.5477 8.36514 20.7059 9.70577 20.7059C11.0464 20.7059 12.1322 19.5477 12.1322 18.1177Z"
                                  fill="#9B9B9B"></path>
                        </g>
                        <circle cx="18.7646" cy="17.4706" r="3.23529" fill="#E81919"></circle>
                        <defs>
                            <clipPath id="clip0_26_10">
                                <rect width="19.4118" height="20.7059" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <!--end::Svg Icon-->
            </div>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown  menu-column w-400px w-lg-400px"
                 data-kt-menu="true">
                <!--begin::Heading-->
                <div class="d-flex flex-column bgi-no-repeat rounded-top">
                    <!--begin::Title-->
                    <h3 class="style-Title-Notifications-dropdown  fw-bold px-6 my-3">
                        <span><?php echo e(cp('notifications')); ?></span>
                    </h3>


                </div>

                <?php if(isset($notifications)): ?>
                    <div class="scroll-y mh-325px my-5 px-3">
                        <!--begin::Item-->
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex flex-column py-2   style-background-Notifications">
                                <div class="d-flex align-items-center py-3 style-border-bottom-Notifications">
                                    <div class="symbol symbol-35px me-4">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="15" cy="15" r="15" fill="#E51C39"></circle>
                                            <g clip-path="url(#clip0_348_13287)">
                                                <path d="M10.8002 13.5999C10.7998 12.7273 11.0713 11.8762 11.5768 11.1649C12.0824 10.4536 12.7969 9.91744 13.6212 9.63092C13.5893 9.43094 13.6011 9.22641 13.6559 9.03145C13.7107 8.83649 13.8072 8.65574 13.9386 8.50167C14.07 8.34759 14.2333 8.22387 14.4172 8.13903C14.6011 8.05419 14.8012 8.01025 15.0037 8.01025C15.2062 8.01025 15.4063 8.05419 15.5902 8.13903C15.7741 8.22387 15.9374 8.34759 16.0688 8.50167C16.2002 8.65574 16.2967 8.83649 16.3515 9.03145C16.4063 9.22641 16.4181 9.43094 16.3862 9.63092C17.2092 9.91861 17.9222 10.4553 18.4264 11.1665C18.9307 11.8776 19.2011 12.7281 19.2002 13.5999V17.7999L21.3002 19.1999V19.8999H8.7002V19.1999L10.8002 17.7999V13.5999ZM16.4002 20.5999C16.4002 20.9712 16.2527 21.3273 15.9901 21.5899C15.7276 21.8524 15.3715 21.9999 15.0002 21.9999C14.6289 21.9999 14.2728 21.8524 14.0102 21.5899C13.7477 21.3273 13.6002 20.9712 13.6002 20.5999H16.4002Z"
                                                      fill="white"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_348_13287">
                                                    <rect width="15" height="16" fill="white"
                                                          transform="translate(8 8)"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="mb-0 ">
                                        <a href="<?php echo e(route('notification_show', ['id' => $notification->id])); ?>"
                                           class="fs-6 style-text-Notifications-read fw-bolder">
                                            <?php if(strpos($notification->data['subject'], '_') !== false): ?>
                                                <?php echo e(cp($notification->data['subject'])); ?>

                                            <?php else: ?>
                                                <?php echo e($notification->data['subject']); ?>

                                            <?php endif; ?>
                                        </a>
                                        <div class="text-gray-400 style-text-Notifications-read-time fs-7">
                                            <?php echo e($notification->created_at->diffForHumans()); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--end::Item-->
                        <!--begin::Item-->
                        <!--end::Item-->
                    </div>
                    <div class="py-1 text-center " style="background-color:#E51C39;">
                        <a href="<?php echo e(route('notifications')); ?>"
                           class="btn btn-color-gray-600 btn-active-color-primary">

                            <span class="style-text-Notifications-read text-white"><?php echo e(cp('view_all')); ?></span>
                        </a>
                    </div>
            </div>
        <?php endif; ?>
        <!--end::Menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--begin::Activities-->

        <div class="d-flex align-items-center ms-1 ms-lg-3">
            <!--begin::Menu toggle-->
            <button class="btn btn-icon btn-icon-muted    show menu-dropdown"
                    data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                    data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                <?php if(LaravelLocalization::getCurrentLocale() == 'en'): ?>
                    <img src="/assets_v2/media/imagesWebsite/Engilsh.png">
                <?php else: ?>
                    <img src="/assets_v2/media/imagesWebsite/Language.png">
                <?php endif; ?>
            </button>
            <!--begin::Menu toggle-->
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="<?php echo e(route('change_lang', ['abbr' => 'ar'])); ?>"
                       class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <img src="/assets_v2/media/imagesWebsite/Language.png">
                                                    </span>
                        <span class="style-menu-title px-2"><?php echo e(cp('arabic')); ?></span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="<?php echo e(route('change_lang', ['abbr' => 'en'])); ?>" class="style-menu-link px-3 ">
                                                    <span class="menu-icon">
                                                        <img src="/assets_v2/media/imagesWebsite/Engilsh.png">
                                                    </span>
                        <span class="style-menu-title  px-2"><?php echo e(cp('english')); ?></span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Activities-->
        <!--begin::Quick links-->

        <div class="d-flex align-items-center ms-1 ms-lg-3 d-none">
            <!--begin::Menu toggle-->
            <div class="topbar-item position-relative  px-2" data-kt-menu-trigger="click"
                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                 data-kt-menu-flip="bottom">
                <svg width="21" height="21" viewBox="0 0 27 27" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.5 19.125C16.6066 19.125 19.125 16.6066 19.125 13.5C19.125 10.3934 16.6066 7.875 13.5 7.875C10.3934 7.875 7.875 10.3934 7.875 13.5C7.875 16.6066 10.3934 19.125 13.5 19.125Z"
                          fill="#9B9B9B"></path>
                    <path d="M23.625 14.625H22.5C22.2016 14.625 21.9155 14.5065 21.7045 14.2955C21.4935 14.0845 21.375 13.7984 21.375 13.5C21.375 13.2016 21.4935 12.9155 21.7045 12.7045C21.9155 12.4935 22.2016 12.375 22.5 12.375H23.625C23.9234 12.375 24.2095 12.4935 24.4205 12.7045C24.6315 12.9155 24.75 13.2016 24.75 13.5C24.75 13.7984 24.6315 14.0845 24.4205 14.2955C24.2095 14.5065 23.9234 14.625 23.625 14.625Z"
                          fill="#9B9B9B"></path>
                    <path d="M4.5 14.625H3.375C3.07663 14.625 2.79048 14.5065 2.5795 14.2955C2.36853 14.0845 2.25 13.7984 2.25 13.5C2.25 13.2016 2.36853 12.9155 2.5795 12.7045C2.79048 12.4935 3.07663 12.375 3.375 12.375H4.5C4.79837 12.375 5.08452 12.4935 5.29549 12.7045C5.50647 12.9155 5.625 13.2016 5.625 13.5C5.625 13.7984 5.50647 14.0845 5.29549 14.2955C5.08452 14.5065 4.79837 14.625 4.5 14.625Z"
                          fill="#9B9B9B"></path>
                    <path d="M19.8675 8.25732C19.588 8.24467 19.3233 8.12835 19.125 7.93107C18.9155 7.72029 18.7979 7.43515 18.7979 7.13794C18.7979 6.84073 18.9155 6.5556 19.125 6.34482L19.9237 5.54607C20.0246 5.4283 20.1487 5.33265 20.2883 5.26513C20.4278 5.1976 20.5799 5.15965 20.7348 5.15367C20.8897 5.14769 21.0442 5.17379 21.1886 5.23035C21.333 5.28691 21.4641 5.3727 21.5737 5.48234C21.6834 5.59197 21.7691 5.72309 21.8257 5.86746C21.8823 6.01182 21.9084 6.16632 21.9024 6.32125C21.8964 6.47619 21.8585 6.62821 21.7909 6.76779C21.7234 6.90736 21.6278 7.03147 21.51 7.13232L20.7112 7.93107C20.6008 8.04088 20.4688 8.12658 20.3236 8.18274C20.1784 8.2389 20.0231 8.26429 19.8675 8.25732Z"
                          fill="#9B9B9B"></path>
                    <path d="M6.34464 21.78C6.19658 21.7809 6.04981 21.7525 5.91275 21.6965C5.77568 21.6405 5.65101 21.558 5.54589 21.4538C5.33636 21.243 5.21875 20.9578 5.21875 20.6606C5.21875 20.3634 5.33636 20.0783 5.54589 19.8675L6.34464 19.125C6.55986 18.9407 6.83669 18.8444 7.11983 18.8553C7.40296 18.8663 7.67154 18.9836 7.8719 19.184C8.07226 19.3844 8.18963 19.6529 8.20057 19.9361C8.2115 20.2192 8.1152 20.496 7.93089 20.7113L7.13214 21.51C6.91382 21.6974 6.63201 21.794 6.34464 21.78Z"
                          fill="#9B9B9B"></path>
                    <path d="M13.5 5.625C13.2016 5.625 12.9155 5.50647 12.7045 5.29549C12.4935 5.08452 12.375 4.79837 12.375 4.5V3.375C12.375 3.07663 12.4935 2.79048 12.7045 2.5795C12.9155 2.36853 13.2016 2.25 13.5 2.25C13.7984 2.25 14.0845 2.36853 14.2955 2.5795C14.5065 2.79048 14.625 3.07663 14.625 3.375V4.5C14.625 4.79837 14.5065 5.08452 14.2955 5.29549C14.0845 5.50647 13.7984 5.625 13.5 5.625Z"
                          fill="#9B9B9B"></path>
                    <path d="M13.5 24.75C13.2016 24.75 12.9155 24.6315 12.7045 24.4205C12.4935 24.2095 12.375 23.9234 12.375 23.625V22.5C12.375 22.2016 12.4935 21.9155 12.7045 21.7045C12.9155 21.4935 13.2016 21.375 13.5 21.375C13.7984 21.375 14.0845 21.4935 14.2955 21.7045C14.5065 21.9155 14.625 22.2016 14.625 22.5V23.625C14.625 23.9234 14.5065 24.2095 14.2955 24.4205C14.0845 24.6315 13.7984 24.75 13.5 24.75Z"
                          fill="#9B9B9B"></path>
                    <path d="M7.13216 8.25716C6.83702 8.25591 6.5542 8.13874 6.34466 7.93091L5.54591 7.13216C5.3616 6.91694 5.26529 6.64011 5.27623 6.35697C5.28717 6.07383 5.40454 5.80525 5.6049 5.6049C5.80525 5.40454 6.07383 5.28717 6.35697 5.27623C6.64011 5.26529 6.91694 5.3616 7.13216 5.5459L7.93091 6.34466C8.14044 6.55544 8.25805 6.84057 8.25805 7.13778C8.25805 7.43499 8.14044 7.72012 7.93091 7.93091C7.82579 8.03517 7.70112 8.11766 7.56405 8.17365C7.42698 8.22963 7.28021 8.25801 7.13216 8.25716Z"
                          fill="#9B9B9B"></path>
                    <path d="M20.6553 21.7803C20.3601 21.779 20.0773 21.6618 19.8678 21.454L19.1253 20.6553C19.0064 20.4415 18.9604 20.1949 18.9942 19.9526C19.0281 19.7104 19.14 19.4858 19.3129 19.3129C19.4858 19.14 19.7104 19.0281 19.9526 18.9942C20.1949 18.9604 20.4415 19.0064 20.6553 19.1253L21.454 19.924C21.6635 20.1348 21.7811 20.4199 21.7811 20.7171C21.7811 21.0143 21.6635 21.2995 21.454 21.5103C21.2328 21.7004 20.9464 21.7972 20.6553 21.7803Z"
                          fill="#9B9B9B"></path>
                </svg>


            </div>

            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="#" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <svg width="15" height="16" viewBox="0 0 15 15" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.96484 0H8.03628V2.6786H6.96484V0Z"
                                                                  fill="black"></path>
                                                            <path d="M10.5459 3.69664L12.4241 1.81787L13.1816 2.57592L11.3034 4.45415L10.5459 3.69664Z"
                                                                  fill="black"></path>
                                                            <path d="M12.3213 6.96436H14.9999V8.0358H12.3213V6.96436Z"
                                                                  fill="black"></path>
                                                            <path d="M10.5459 11.3039L11.3034 10.5464L13.1816 12.4246L12.4241 13.1827L10.5459 11.3039Z"
                                                                  fill="black"></path>
                                                            <path d="M6.96484 12.3213H8.03628V14.9999H6.96484V12.3213Z"
                                                                  fill="black"></path>
                                                            <path d="M1.81836 12.4246L3.6966 10.5464L4.4541 11.3044L2.57587 13.1827L1.81836 12.4246Z"
                                                                  fill="black"></path>
                                                            <path d="M0 6.96436H2.6786V8.0358H0V6.96436Z"
                                                                  fill="black"></path>
                                                            <path d="M1.81836 2.57592L2.57587 1.81787L4.4541 3.69664L3.6966 4.45415L1.81836 2.57592Z"
                                                                  fill="black"></path>
                                                            <path d="M7.49948 4.28589C6.86375 4.28589 6.24229 4.47441 5.7137 4.8276C5.18511 5.18079 4.77312 5.6828 4.52983 6.27014C4.28655 6.85748 4.22289 7.50378 4.34692 8.12729C4.47095 8.75081 4.77708 9.32355 5.22661 9.77308C5.67614 10.2226 6.24888 10.5287 6.8724 10.6528C7.49592 10.7768 8.14221 10.7131 8.72955 10.4699C9.31689 10.2266 9.8189 9.81459 10.1721 9.28599C10.5253 8.7574 10.7138 8.13594 10.7138 7.50021C10.7138 6.64772 10.3752 5.83014 9.77235 5.22734C9.16955 4.62454 8.35197 4.28589 7.49948 4.28589Z"
                                                                  fill="black"></path>
                                                        </svg>

                                                    </span>
                        <span class="style-menu-title px-2">فاتح</span>
                    </a>
                </div>
                <div class="menu-item px-3 my-1">
                    <a href="#" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <svg width="15" height="16" viewBox="0 0 13 13" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.5 0C5.21442 0 3.95771 0.381218 2.8888 1.09545C1.81988 1.80968 0.986755 2.82484 0.494786 4.01256C0.00281632 5.20028 -0.125905 6.50721 0.124899 7.76808C0.375702 9.02896 0.994767 10.1871 1.90381 11.0962C2.81285 12.0052 3.97104 12.6243 5.23191 12.8751C6.49279 13.1259 7.79972 12.9972 8.98744 12.5052C10.1752 12.0132 11.1903 11.1801 11.9046 10.1112C12.6188 9.04228 13 7.78558 13 6.5C13 6.16778 12.9711 5.83555 12.9278 5.51778C12.5669 6.02381 12.0901 6.43605 11.5372 6.72002C10.9844 7.00399 10.3715 7.15143 9.75 7.15C8.9232 7.15002 8.11777 6.88742 7.44987 6.40008C6.78196 5.91275 6.28611 5.22586 6.03383 4.43849C5.78155 3.65113 5.78588 2.80398 6.0462 2.01923C6.30652 1.23448 6.80937 0.552702 7.48222 0.0722221C7.16444 0.0288888 6.83222 0 6.5 0Z"
                                                                  fill="black"></path>
                                                        </svg>

                                                    </span>
                        <span class="style-menu-title px-2">غامق</span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Quick links-->
        <!--begin::Chat-->

        <div class="d-flex align-items-center ms-1 ms-lg-3 d-none">
            <!--begin::Menu toggle-->
            <div class="topbar-item position-relative  px-2" data-kt-menu-trigger="click"
                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                 data-kt-menu-flip="bottom">
                <svg width="21" height="21" viewBox="0 0 21 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5 0.6875C4.93125 0.6875 0.375 5.24375 0.375 10.8125V13.3438C0.375 15.7063 2.23125 17.5625 4.59375 17.5625C5.1 17.5625 5.4375 17.225 5.4375 16.7188V9.96875C5.4375 9.4625 5.1 9.125 4.59375 9.125C3.66563 9.125 2.82187 9.4625 2.14687 9.96875C2.56875 5.75 6.19688 2.375 10.5 2.375C14.8031 2.375 18.4312 5.66563 18.8531 9.96875C18.1781 9.4625 17.3344 9.125 16.4062 9.125C15.9 9.125 15.5625 9.4625 15.5625 9.96875V16.7188C15.5625 17.225 15.9 17.5625 16.4062 17.5625C16.9125 17.5625 17.5031 17.4781 17.925 17.225C16.9969 18.9125 15.5625 20.2625 13.7906 21.0219C13.6219 20.0094 12.7781 19.1656 11.6812 19.1656C10.5844 19.1656 9.65625 20.0938 9.65625 21.1906C9.65625 21.7812 9.90937 22.3719 10.4156 22.7938C10.8375 23.1313 11.2594 23.3 11.7656 23.3C11.85 23.3 12.0187 23.3 12.1031 23.3C16.9125 22.625 20.625 18.3219 20.625 13.3438V10.8125C20.625 5.24375 16.0688 0.6875 10.5 0.6875Z"
                          fill="#9B9B9B"></path>
                </svg>

            </div>

            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="#" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <i class="fas fa-headset text-dark" style="font-size:16px;"></i>
                                                    </span>
                        <span class="style-menu-title px-2">الدعم</span>
                    </a>
                </div>

                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Chat-->
        <!--begin::Notifications-->


        <div class="d-flex align-items-center ms-1 ms-lg-3">
            <!--begin::Menu toggle-->
            <div class="topbar-item position-relative px-2" data-kt-menu-trigger="click"
                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                 data-kt-menu-flip="bottom">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7006 8.4801L18.3658 7.81344C18.2043 7.27431 17.9823 6.7535 17.7036 6.2601L18.8467 4.21343C18.8896 4.13618 18.9053 4.04776 18.8915 3.96129C18.8776 3.87482 18.8351 3.79492 18.77 3.73344L17.1042 2.13344C17.04 2.07121 16.9564 2.03048 16.866 2.01727C16.7756 2.00406 16.6832 2.01908 16.6024 2.0601L14.4767 3.14677C13.9558 2.86721 13.4041 2.64363 12.8318 2.4801L12.1349 0.273435C12.1054 0.192113 12.0497 0.121835 11.9758 0.0727166C11.9019 0.0235985 11.8136 -0.00182616 11.7236 0.000102112H9.36789C9.27738 0.000505162 9.18937 0.0285251 9.11666 0.0800842C9.04396 0.131643 8.99035 0.204051 8.96364 0.286769L8.26667 2.48677C7.68959 2.64942 7.13324 2.87302 6.60789 3.15344L4.51698 2.07344C4.43621 2.03241 4.34377 2.01739 4.25337 2.0306C4.16297 2.04381 4.07944 2.08455 4.01516 2.14677L2.32152 3.72677C2.25648 3.78825 2.21389 3.86815 2.20007 3.95462C2.18626 4.04109 2.20197 4.12951 2.24486 4.20677L3.37395 6.20677C3.08126 6.70716 2.84751 7.23707 2.67698 7.78677L0.370009 8.45343C0.283532 8.47898 0.207833 8.53026 0.15393 8.5998C0.100027 8.66935 0.0707339 8.75353 0.0703125 8.8401V11.0934C0.0707339 11.18 0.100027 11.2642 0.15393 11.3337C0.207833 11.4033 0.283532 11.4546 0.370009 11.4801L2.69092 12.1468C2.86331 12.6873 3.09703 13.2082 3.38789 13.7001L2.24486 15.7934C2.20197 15.8707 2.18626 15.9591 2.20007 16.0456C2.21389 16.132 2.25648 16.212 2.32152 16.2734L3.98728 17.8668C4.05156 17.929 4.13509 17.9697 4.22549 17.9829C4.31589 17.9961 4.40833 17.9811 4.4891 17.9401L6.64274 16.8401C7.1522 17.1031 7.6896 17.3131 8.24577 17.4668L8.94274 19.7134C8.96944 19.7962 9.02305 19.8686 9.09575 19.9201C9.16846 19.9717 9.25647 19.9997 9.34698 20.0001H11.7027C11.7932 19.9997 11.8813 19.9717 11.954 19.9201C12.0267 19.8686 12.0803 19.7962 12.107 19.7134L12.8039 17.4601C13.3554 17.3057 13.8881 17.0956 14.393 16.8334L16.5606 17.9401C16.6414 17.9811 16.7338 17.9961 16.8242 17.9829C16.9146 17.9697 16.9982 17.929 17.0624 17.8668L18.7282 16.2734C18.7932 16.212 18.8358 16.132 18.8496 16.0456C18.8635 15.9591 18.8477 15.8707 18.8049 15.7934L17.6479 13.7268C17.9248 13.2419 18.1468 12.7301 18.31 12.2001L20.6588 11.5334C20.7453 11.5079 20.821 11.4566 20.8749 11.3871C20.9288 11.3175 20.9581 11.2333 20.9585 11.1468V8.87344C20.9626 8.79054 20.9401 8.70842 20.894 8.63811C20.8479 8.5678 20.7804 8.51266 20.7006 8.4801ZM10.5458 13.6668C9.7876 13.6668 9.04647 13.4517 8.41608 13.0488C7.78569 12.6459 7.29436 12.0733 7.00423 11.4033C6.71409 10.7333 6.63818 9.99603 6.78609 9.28477C6.934 8.57351 7.29909 7.92017 7.83519 7.40738C8.37129 6.89458 9.05433 6.54537 9.79792 6.40389C10.5415 6.26241 11.3123 6.33502 12.0127 6.61254C12.7132 6.89007 13.3119 7.36003 13.7331 7.96301C14.1543 8.56599 14.3791 9.2749 14.3791 10.0001C14.3791 10.9726 13.9752 11.9052 13.2563 12.5928C12.5375 13.2805 11.5624 13.6668 10.5458 13.6668Z"
                          fill="#9B9B9B"></path>
                </svg>
            </div>
            <!--begin::Menu toggle-->
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="<?php echo e(url('/account/profile/dashboard')); ?>" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <svg width="15" height="16" viewBox="0 0 15 16"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.8145 6.78405L13.1378 6.25072C13.0219 5.81942 12.8625 5.40277 12.6624 5.00806L13.4832 3.37073C13.514 3.30893 13.5253 3.23819 13.5153 3.16902C13.5054 3.09984 13.4748 3.03592 13.4281 2.98673L12.232 1.70674C12.1858 1.65696 12.1258 1.62437 12.0609 1.6138C11.996 1.60324 11.9296 1.61525 11.8716 1.64807L10.3451 2.5174C9.97105 2.29376 9.57492 2.11489 9.16396 1.98407L8.66347 0.218747C8.6423 0.15369 8.6023 0.0974673 8.54924 0.058173C8.49617 0.0188787 8.43278 -0.00146092 8.36818 8.16896e-05H6.67652C6.61153 0.000404127 6.54833 0.02282 6.49612 0.0640671C6.44391 0.105314 6.40542 0.16324 6.38624 0.229414L5.88575 1.9894C5.47135 2.11953 5.07184 2.2984 4.69459 2.52274L3.19312 1.65874C3.13512 1.62592 3.06874 1.6139 3.00383 1.62447C2.93891 1.63504 2.87892 1.66763 2.83277 1.71741L1.61658 2.9814C1.56987 3.03058 1.53928 3.09451 1.52937 3.16368C1.51945 3.23286 1.53073 3.30359 1.56153 3.3654L2.37232 4.96539C2.16214 5.3657 1.99429 5.78963 1.87183 6.22938L0.21521 6.76271C0.153111 6.78315 0.0987524 6.82417 0.0600453 6.87981C0.0213381 6.93544 0.000302583 7.00279 0 7.07205V8.8747C0.000302583 8.94396 0.0213381 9.01131 0.0600453 9.06694C0.0987524 9.12258 0.153111 9.1636 0.21521 9.18403L1.88184 9.71736C2.00563 10.1498 2.17346 10.5665 2.38233 10.96L1.56153 12.6347C1.53073 12.6965 1.51945 12.7672 1.52937 12.8364C1.53928 12.9056 1.56987 12.9695 1.61658 13.0187L2.81275 14.2933C2.8589 14.3431 2.91889 14.3757 2.98381 14.3863C3.04872 14.3968 3.1151 14.3848 3.1731 14.352L4.71961 13.472C5.08545 13.6824 5.47135 13.8504 5.87074 13.9733L6.37123 15.7707C6.3904 15.8368 6.4289 15.8948 6.48111 15.936C6.53332 15.9773 6.59652 15.9997 6.66151 16H8.35316C8.41815 15.9997 8.48135 15.9773 8.53356 15.936C8.58577 15.8948 8.62427 15.8368 8.64345 15.7707L9.14394 13.968C9.53991 13.8445 9.92243 13.6764 10.2851 13.4667L11.8416 14.352C11.8996 14.3848 11.966 14.3968 12.0309 14.3863C12.0958 14.3757 12.1558 14.3431 12.2019 14.2933L13.3981 13.0187C13.4448 12.9695 13.4754 12.9056 13.4853 12.8364C13.4952 12.7672 13.4839 12.6965 13.4531 12.6347L12.6223 10.9814C12.8212 10.5935 12.9806 10.184 13.0978 9.76003L14.7844 9.2267C14.8465 9.20626 14.9009 9.16524 14.9396 9.10961C14.9783 9.05397 14.9994 8.98663 14.9997 8.91737V7.09871C15.0026 7.03239 14.9865 6.9667 14.9533 6.91045C14.9202 6.8542 14.8718 6.81009 14.8145 6.78405V6.78405ZM7.52235 10.9334C6.97792 10.9334 6.44572 10.7613 5.99304 10.439C5.54036 10.1167 5.18754 9.65857 4.9792 9.12257C4.77085 8.58658 4.71634 7.99679 4.82255 7.42778C4.92877 6.85877 5.19093 6.3361 5.5759 5.92587C5.96088 5.51564 6.45136 5.23627 6.98533 5.12309C7.5193 5.0099 8.07277 5.06799 8.57576 5.29001C9.07875 5.51202 9.50866 5.888 9.81113 6.37038C10.1136 6.85276 10.275 7.41989 10.275 8.00004C10.275 8.77801 9.98503 9.52411 9.4688 10.0742C8.95257 10.6243 8.25241 10.9334 7.52235 10.9334V10.9334Z"
                                                                  fill="black"></path>
                                                        </svg>
                                                    </span>
                        <span class="style-menu-title px-2"><?php echo e(cp('personal_account')); ?></span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="<?php echo e(route("list_deposit_withdraws")); ?>" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <svg width="15" height="16" viewBox="0 0 16 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.281 0H3.71903C1.66826 0 0 1.6165 0 3.6034V4.16949H0.470833H3.33936C3.47623 3.86393 3.78909 3.64934 4.15473 3.64934C4.64621 3.64934 5.04464 4.03548 5.04464 4.5118C5.04464 4.98813 4.64621 5.37427 4.15473 5.37427C3.78166 5.37427 3.46449 5.15085 3.33222 4.83534H0.470833H0V8.16683H0.470833H3.33419C3.46864 7.85594 3.78511 7.63729 4.15473 7.63729C4.64621 7.63729 5.04464 8.02344 5.04464 8.49976C5.04464 8.97608 4.64621 9.36223 4.15473 9.36223C3.78511 9.36223 3.46864 9.14358 3.33419 8.83269H0.470833H0V12.1548H0.470833H3.33419C3.46864 11.8439 3.78511 11.6253 4.15473 11.6253C4.64621 11.6253 5.04464 12.0114 5.04464 12.4877C5.04464 12.9641 4.64621 13.3502 4.15473 13.3502C3.78511 13.3502 3.46864 13.1316 3.33419 12.8206H0.470833H0V13.396C0 15.3835 1.66826 17 3.71903 17H12.281C14.3317 17 16 15.3835 16 13.396V3.6034C16 1.6165 14.3317 0 12.281 0ZM13.5247 12.0595V11.3352C13.5247 11.2092 13.6301 11.1074 13.7601 11.1074C13.8901 11.1074 13.9955 11.2092 13.9955 11.3352V12.0595C13.9955 12.1855 13.8901 12.2873 13.7601 12.2873C13.6301 12.2873 13.5247 12.1855 13.5247 12.0595ZM13.9955 9.53417C13.9955 9.66018 13.8901 9.76201 13.7601 9.76201C13.6301 9.76201 13.5247 9.66018 13.5247 9.53417V4.97042C13.5247 4.84441 13.6301 4.74258 13.7601 4.74258C13.8901 4.74258 13.9955 4.84441 13.9955 4.97042V9.53417Z"
                                                                  fill="#303030"></path>
                                                        </svg>

                                                    </span>
                        <span class="style-menu-title px-2"><?php echo e(cp('history')); ?></span>
                    </a>
                </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>


        <div class="d-flex align-items-center ms-1 ms-lg-3">
            <!--begin::Menu toggle-->
            <div class="topbar-item position-relative  px-2" data-kt-menu-trigger="click"
                 data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                 data-kt-menu-flip="bottom">
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5007 8.58317C11.5548 8.58317 12.4173 7.72067 12.4173 6.6665V2.83317C12.4173 1.779 11.5548 0.916504 10.5007 0.916504C9.44648 0.916504 8.58398 1.779 8.58398 2.83317V6.6665C8.58398 7.72067 9.44648 8.58317 10.5007 8.58317Z"
                          fill="#9B9B9B"></path>
                    <path d="M17.3045 3.69583C17.017 3.40833 16.7295 3.3125 16.2503 3.3125C15.4837 3.3125 14.8128 3.98333 14.8128 4.75C14.8128 5.13333 15.0045 5.51667 15.1962 5.80417C16.442 7.05 17.1128 8.67917 17.1128 10.5C17.1128 14.2375 14.142 17.2083 10.4045 17.2083C6.66699 17.2083 3.69616 14.2375 3.69616 10.5C3.69616 8.67917 4.46283 6.95417 5.70866 5.80417C5.99616 5.51667 6.18783 5.13333 6.18783 4.75C6.18783 3.98333 5.51699 3.3125 4.75033 3.3125C4.36699 3.3125 3.98366 3.50417 3.69616 3.69583C1.97116 5.42083 0.916992 7.81667 0.916992 10.5C0.916992 15.7708 5.22949 20.0833 10.5003 20.0833C15.7712 20.0833 20.0837 15.7708 20.0837 10.5C20.0837 7.81667 19.0295 5.42083 17.3045 3.69583Z"
                          fill="#9B9B9B"></path>
                </svg>

            </div>
            <!--begin::Menu toggle-->
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-200px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-1">
                    <a href="<?php echo e(route("logout")); ?>" class="style-menu-link px-3 active">
                                                    <span class="menu-icon">
                                                        <i class="fas fa-sign-out-alt text-dark"
                                                           style="font-size:16px;"></i>
                                                    </span>
                        <span class="style-menu-title px-2"><?php echo e(cp('logout_str')); ?></span>
                    </a>
                </div>

                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Notifications-->
        <!--begin::User-->
        <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
            <!--begin::Menu wrapper-->
            <div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px"
                 data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                 data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                <img src="<?php echo e(asset(auth()->user()->img_profile )); ?>"
                     class="style-image-Preonal-user " width="35px"
                     alt="">
                <span class="px-2 style-Name-user-dropdown"><?php echo e(auth('customers')->user()->first_name); ?></span>
                <svg width="12" height="6" viewBox="0 0 12 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5199 9.09392e-05C10.3868 0.00399205 10.2616 0.0586077 10.1696 0.154185L5.51475 4.79456L0.859874 0.154185C0.764976 0.0576325 0.635837 0.00301677 0.49985 0.00301677C0.296358 0.00301677 0.113411 0.126877 0.0371014 0.315106C-0.0401861 0.503334 0.00579499 0.718871 0.151566 0.860286L5.16059 5.85371C5.35626 6.04876 5.67324 6.04876 5.8689 5.85371L10.8779 0.860286C11.0266 0.717895 11.0736 0.498458 10.9934 0.308279C10.9141 0.118099 10.7263 -0.00381017 10.5199 9.09392e-05Z"
                          fill="#5F5F5F"></path>
                </svg>

            </div>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                 data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="<?php echo e(asset(auth()->user()->img_profile )); ?>"
                                 width="50px">
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet d-flex align-items-center fs-5">
                                    رقم المحفظة
                                </div>
                                <div class="style-icon-copy-dropdown-user">
                                                                <span class="badge  fw-bolder fs-8 px-2 py-1 ms-2">
                                                                    <svg width="18" height="22" viewBox="0 0 18 22"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.9041 21.3546H0.796812C0.585485 21.3546 0.382812 21.2706 0.233381 21.1212C0.0839498 20.9718 0 20.7691 0 20.5578V5.09588C0 4.88456 0.0839498 4.68188 0.233381 4.53245C0.382812 4.38302 0.585485 4.29907 0.796812 4.29907H12.9041C13.1154 4.29907 13.3181 4.38302 13.4675 4.53245C13.617 4.68188 13.7009 4.88456 13.7009 5.09588V20.5578C13.7009 20.7691 13.617 20.9718 13.4675 21.1212C13.3181 21.2706 13.1154 21.3546 12.9041 21.3546ZM1.59362 19.761H12.1073V5.8927H1.59362V19.761Z"
                                                                              fill="#3ABE32"></path>
                                                                        <path d="M17.2029 17.0555H12.9039C12.6925 17.0555 12.4899 16.9716 12.3404 16.8221C12.191 16.6727 12.1071 16.47 12.1071 16.2587C12.1071 16.0474 12.191 15.8447 12.3404 15.6953C12.4899 15.5458 12.6925 15.4619 12.9039 15.4619H16.4061V1.59362H5.89245V5.09535C5.89245 5.30668 5.8085 5.50935 5.65907 5.65878C5.50964 5.80821 5.30697 5.89216 5.09564 5.89216C4.88431 5.89216 4.68164 5.80821 4.53221 5.65878C4.38278 5.50935 4.29883 5.30668 4.29883 5.09535V0.796812C4.29883 0.585485 4.38278 0.382812 4.53221 0.233381C4.68164 0.0839496 4.88431 0 5.09564 0H17.2029C17.4143 0 17.6169 0.0839496 17.7664 0.233381C17.9158 0.382812 17.9998 0.585485 17.9998 0.796812V16.2587C17.9998 16.47 17.9158 16.6727 17.7664 16.8221C17.6169 16.9716 17.4143 17.0555 17.2029 17.0555Z"
                                                                              fill="#3ABE32"></path>
                                                                    </svg>
                                                                </span>
                                </div>
                            </div>

                            <a href="#"
                               class="fw-bold text-muted  style-text-number-wallet2 text-hover-primary fs-7"><?php echo e(auth()->user()->wallet_code_symbol); ?></a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.7562 9.20721L9.12715 8.12357L8.32715 9.33085L11.0617 11.1563L14.3853 7.00357L13.2508 6.09448L10.7562 9.20721Z"
                                  fill="#969696"></path>
                            <path d="M13.818 3.63647H2.18164V5.09102H13.818V3.63647Z"
                                  fill="#969696"></path>
                            <path d="M8.7271 10.9092H2.18164V12.3637H8.7271V10.9092Z"
                                  fill="#969696"></path>
                            <path d="M7.99982 7.27271H2.18164V8.72725H7.99982V7.27271Z"
                                  fill="#969696"></path>
                            <path d="M13.8178 10.9092H12.3633V12.3637H13.8178V10.9092Z"
                                  fill="#969696"></path>
                            <path d="M14.1382 0H1.86182C1.36803 0 0.894473 0.196155 0.545314 0.545314C0.196155 0.894473 0 1.36803 0 1.86182V14.1382C0 14.632 0.196155 15.1055 0.545314 15.4547C0.894473 15.8038 1.36803 16 1.86182 16H14.1382C14.632 16 15.1055 15.8038 15.4547 15.4547C15.8038 15.1055 16 14.632 16 14.1382V1.86182C16 1.36803 15.8038 0.894473 15.4547 0.545314C15.1055 0.196155 14.632 0 14.1382 0ZM14.5455 14.1382C14.5455 14.2462 14.5025 14.3498 14.4262 14.4262C14.3498 14.5025 14.2462 14.5455 14.1382 14.5455H1.86182C1.7538 14.5455 1.65021 14.5025 1.57383 14.4262C1.49745 14.3498 1.45455 14.2462 1.45455 14.1382V1.86182C1.45455 1.7538 1.49745 1.65021 1.57383 1.57383C1.65021 1.49745 1.7538 1.45455 1.86182 1.45455H14.1382C14.2462 1.45455 14.3498 1.49745 14.4262 1.57383C14.5025 1.65021 14.5455 1.7538 14.5455 1.86182V14.1382Z"
                                  fill="#969696"></path>
                        </svg>

                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column px-4">
                            <div class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet d-flex align-items-center fs-5">
                                    <?php echo e(cp('check_confirm')); ?>

                                </div>
                                <div class="style-icon-copy-dropdown-user2">
                                                                <span class="badge  fw-bolder fs-8 px-2 py-1 ms-2">
                                                                    <svg width="13" height="14" viewBox="0 0 13 14"
                                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M10.3808 4.17544H5.47368C4.3849 4.17544 3.34071 4.61905 2.57082 5.40867C1.80094 6.1983 1.36842 7.26926 1.36842 8.38596C1.36842 9.50267 1.80094 10.5736 2.57082 11.3633C3.34071 12.1529 4.3849 12.5965 5.47368 12.5965H11.6316V14H5.47368C4.02197 14 2.62972 13.4085 1.60321 12.3557C0.57669 11.3029 0 9.8749 0 8.38596C0 6.89703 0.57669 5.46908 1.60321 4.41624C2.62972 3.36341 4.02197 2.77193 5.47368 2.77193H10.3808L8.64568 0.992281L9.61316 0L13 3.47368L9.61316 6.94737L8.64568 5.95509L10.3808 4.17544Z"
                                                                              fill="#005170"></path>
                                                                    </svg>
                                                                </span>
                                </div>
                            </div>

                            <a href="<?php echo e(route('profile_info')); ?>"
                               class="fw-bold style-text-number-wallet2 text-muted text-hover-primary fs-7"><?php echo e(auth()->user()->is_verified == 1 ? cp('verified') : cp('unverified')); ?></a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 d-none">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <svg width="18" height="22" viewBox="0 0 19 19" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.3679 0.581324L12.5467 5.32198C12.6414 5.60642 12.9256 5.79605 13.2098 5.89086L18.1359 6.64937C18.9885 6.64937 19.2727 7.5975 18.7043 8.16638L15.1045 11.8641C14.915 12.0537 14.8203 12.433 14.8203 12.7174L15.6729 17.8373C15.7676 18.5958 15.0097 19.2595 14.3466 18.8803L9.89422 16.4151C9.61002 16.2255 9.32583 16.2255 9.04163 16.4151L4.58923 18.8803C3.92611 19.2595 3.07352 18.6906 3.26299 17.8373L4.11558 12.7174C4.21031 12.433 4.02084 12.0537 3.83138 11.8641L0.231567 8.16638C-0.242093 7.5975 0.042103 6.64937 0.799958 6.55455L5.72602 5.79605C6.01021 5.79605 6.29441 5.51161 6.38914 5.22717L8.56797 0.48651C9.04163 -0.177182 9.98895 -0.177182 10.3679 0.581324Z"
                                  fill="#969696"></path>
                        </svg>


                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column px-4">
                            <div class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet d-flex align-items-center fs-5">
                                    نوع الحساب
                                </div>

                            </div>

                            <a href="#"
                               class="fw-bold style-text-number-wallet2 text-muted text-hover-primary fs-7">مسجل</a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <div class="menu-item px-3 d-none">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <svg width="18" height="22" viewBox="0 0 18 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.5776 0.447578C10.8559 0.447578 10.1519 0.566031 9.4784 0.800171C10.7498 1.58195 11.6201 2.83722 11.9108 4.27455C11.8676 4.0658 11.8119 3.8582 11.7431 3.65289C10.807 0.858825 7.76197 -0.65678 4.9555 0.274479C4.77868 0.33299 4.60253 0.401762 4.43182 0.479029C4.31933 0.529904 4.26931 0.662341 4.32023 0.774924C4.37111 0.88746 4.50359 0.937476 4.61608 0.886505C4.77257 0.815777 4.93407 0.752684 5.0962 0.699041C7.66948 -0.154808 10.4611 1.23409 11.3191 3.79492C11.7332 5.03181 11.6399 6.3558 11.0563 7.52301C10.4694 8.69676 9.45788 9.57156 8.20796 9.98629C5.63439 10.8401 2.84286 9.45129 1.98529 6.89013C1.67059 5.95051 1.65302 4.92705 1.92911 3.97756L3.08626 4.71677C3.12353 4.74059 3.16519 4.752 3.20647 4.752C3.28021 4.752 3.35247 4.71549 3.39508 4.64867C3.46161 4.54463 3.43112 4.40637 3.32703 4.33984L1.92501 3.44409C1.92429 3.44366 1.92358 3.44342 1.92286 3.44299C1.92124 3.44199 1.91966 3.44104 1.91804 3.44008C1.91146 3.43617 1.90434 3.43335 1.89738 3.43015C1.89217 3.42772 1.88707 3.42491 1.88172 3.42285C1.88096 3.42261 1.88034 3.42209 1.87958 3.42185C1.87919 3.42176 1.87881 3.42176 1.87843 3.42161C1.87156 3.41918 1.8644 3.41794 1.85729 3.41622C1.85108 3.41474 1.84497 3.41278 1.83872 3.41183C1.83762 3.41169 1.83653 3.41116 1.83543 3.41102C1.82899 3.41011 1.82235 3.41049 1.81581 3.41016C1.80909 3.40982 1.80236 3.40911 1.79563 3.40935C1.79419 3.40944 1.79267 3.40925 1.79124 3.4093C1.78732 3.40954 1.78346 3.41064 1.77959 3.41111C1.77754 3.41135 1.77553 3.41183 1.77343 3.41207C1.76656 3.41307 1.75969 3.41369 1.75296 3.41531C1.75105 3.41574 1.74914 3.41608 1.74723 3.41655C1.7468 3.4167 1.74633 3.41665 1.7459 3.41679L0.164957 3.84708C0.0457878 3.87949 -0.0245112 4.00238 0.00789408 4.1216C0.0350019 4.22105 0.125155 4.28653 0.223564 4.28653C0.242988 4.28653 0.262746 4.284 0.282361 4.27861L1.47048 3.95527C1.19954 4.96261 1.22899 6.04029 1.56125 7.03216C2.23909 9.05651 4.02396 10.4097 6.02349 10.6476C6.02335 10.6476 6.02321 10.6475 6.02302 10.6475C5.73137 10.6135 5.44349 10.5566 5.16163 10.4755L5.1653 20.4746H12.827L6.95246 16.1868C6.85272 16.114 6.83086 15.9741 6.90369 15.8743C6.97651 15.7745 7.11644 15.7528 7.21614 15.8255L13.2888 20.258L13.2876 18.2501L9.95069 15.7589C9.85171 15.685 9.83138 15.545 9.90521 15.4459C9.97914 15.347 10.1192 15.3266 10.2182 15.4006L13.2873 17.6917L13.2857 15.1533C13.2856 15.094 13.3092 15.0371 13.3511 14.9951C13.3931 14.9532 13.4499 14.9296 13.5093 14.9296H16.2856L16.2893 10.4609C16.2894 10.3375 16.3895 10.2375 16.5129 10.2375H17.9997L18 6.84264C17.9998 3.31638 15.1188 0.447578 11.5776 0.447578ZM12.0179 5.52142C12.0178 5.52333 12.0177 5.52524 12.0177 5.52715C12.0177 5.52524 12.0178 5.52328 12.0179 5.52142ZM11.9884 5.93052C11.988 5.933 11.9878 5.93548 11.9875 5.93796C11.9878 5.93548 11.988 5.933 11.9884 5.93052ZM11.9613 6.13583C11.9608 6.13917 11.9602 6.14256 11.9598 6.1459C11.9602 6.14256 11.9608 6.13917 11.9613 6.13583ZM11.8851 6.53367C11.8832 6.54168 11.8814 6.5497 11.8794 6.55772C11.8814 6.5497 11.8832 6.54168 11.8851 6.53367ZM11.7773 6.92883C11.7743 6.93814 11.7715 6.94744 11.7685 6.95675C11.7715 6.94744 11.7744 6.93814 11.7773 6.92883ZM11.708 7.13491C11.7051 7.14288 11.7021 7.15085 11.6991 7.15877C11.7021 7.15085 11.7051 7.14288 11.708 7.13491ZM11.6361 7.32309C11.6332 7.33034 11.6304 7.33764 11.6274 7.34494C11.6304 7.33764 11.6332 7.33034 11.6361 7.32309ZM11.5539 7.51642C11.5487 7.52797 11.5434 7.53947 11.5381 7.55107C11.5434 7.53947 11.5487 7.52792 11.5539 7.51642ZM11.3453 7.93277C11.3425 7.93783 11.3398 7.94294 11.337 7.948C11.3398 7.94294 11.3425 7.93783 11.3453 7.93277ZM11.2223 8.14262C11.2176 8.15021 11.2131 8.15789 11.2083 8.16548C11.2131 8.15794 11.2177 8.15026 11.2223 8.14262ZM11.0883 8.34956C11.0826 8.35796 11.077 8.36631 11.0712 8.37466C11.0769 8.36631 11.0826 8.35796 11.0883 8.34956ZM10.944 8.55139C10.938 8.55926 10.9321 8.56714 10.9261 8.57496C10.9321 8.56709 10.938 8.55926 10.944 8.55139ZM10.79 8.74682C10.7848 8.75312 10.7795 8.75942 10.7742 8.76572C10.7795 8.75942 10.7848 8.75312 10.79 8.74682ZM10.6267 8.93524C10.6237 8.93863 10.6205 8.94202 10.6174 8.9454C10.6205 8.94202 10.6236 8.93867 10.6267 8.93524ZM8.34279 10.4126C8.28194 10.4328 8.22047 10.4516 8.15871 10.4696C8.22018 10.4516 8.28156 10.4329 8.34279 10.4126ZM8.11471 10.4822C8.05544 10.4989 7.99592 10.515 7.93584 10.5297C7.99554 10.515 8.05515 10.499 8.11471 10.4822ZM6.13894 10.6592C6.15927 10.6612 6.17955 10.6634 6.19993 10.6652C6.19969 10.6652 6.1995 10.6651 6.19926 10.6651C6.17912 10.6635 6.15908 10.6611 6.13894 10.6592ZM6.49401 10.682C6.54799 10.6837 6.60197 10.6852 6.65614 10.6852C6.60192 10.6853 6.54794 10.684 6.49401 10.682ZM6.74314 10.6836C6.71498 10.684 6.68673 10.6851 6.65862 10.6852C6.70859 10.6852 6.75875 10.6837 6.80881 10.6822C6.78695 10.6828 6.76505 10.6832 6.74314 10.6836ZM6.96821 10.6751C6.97556 10.6746 6.98291 10.6742 6.99026 10.6738C6.99012 10.6738 6.98993 10.6738 6.98973 10.6738C6.98258 10.6742 6.97542 10.6746 6.96821 10.6751ZM7.3188 10.6435C7.33431 10.6416 7.34982 10.6391 7.36533 10.637C7.34992 10.639 7.33464 10.6416 7.31918 10.6435C7.31909 10.6435 7.31894 10.6435 7.3188 10.6435ZM7.69893 10.5822C7.70136 10.5818 7.70384 10.5814 7.70628 10.5809C7.70384 10.5814 7.70136 10.5818 7.69893 10.5822ZM7.87828 10.5429C7.89255 10.5396 7.90682 10.5368 7.92104 10.5334C7.92099 10.5334 7.9209 10.5335 7.92085 10.5335C7.90677 10.5368 7.89241 10.5396 7.87828 10.5429ZM8.62255 10.3116C8.62284 10.3115 8.62312 10.3113 8.62341 10.3112C8.62303 10.3113 8.62279 10.3115 8.62255 10.3116ZM9.28975 9.99645C9.29132 9.9955 9.29299 9.99464 9.29462 9.99373C9.29304 9.99469 9.29132 9.99555 9.28975 9.99645ZM9.49692 9.87437C9.50088 9.87194 9.50489 9.86946 9.5089 9.86697C9.50489 9.86946 9.50088 9.87189 9.49692 9.87437ZM9.70085 9.74146C9.70577 9.73816 9.71064 9.73478 9.7155 9.73144C9.71064 9.73482 9.70572 9.73816 9.70085 9.74146ZM9.90001 9.59833C9.90449 9.59489 9.90898 9.59146 9.91352 9.58802C9.90898 9.59146 9.90449 9.59489 9.90001 9.59833ZM10.0933 9.44532C10.0963 9.44289 10.0991 9.44041 10.102 9.43797C10.0991 9.44041 10.0963 9.44289 10.0933 9.44532Z"
                                  fill="#969696"></path>
                            <path d="M6.34044 6.32689C6.2501 6.20729 6.18801 6.0655 6.1556 5.90023L5.35449 5.99558C5.41658 6.39891 5.55751 6.71227 5.77929 6.93333C6.00107 7.15444 6.29825 7.28669 6.65156 7.33026V7.90182H7.08018V7.32387C7.48227 7.2603 7.80422 7.10066 8.0302 6.84447C8.25627 6.58847 8.36847 6.27396 8.36847 5.90027C8.36847 5.56587 8.27918 5.29178 8.09959 5.07797C7.921 4.86521 7.58373 4.69059 7.08853 4.5571V3.34737C7.28841 3.43418 7.41216 3.59916 7.46065 3.8427L8.24262 3.741C8.18893 3.43098 8.06475 3.18334 7.87151 2.99816C7.67717 2.8128 7.408 2.70069 7.08013 2.66146V2.35669H6.65075V2.66146C6.29988 2.69654 6.00942 2.82879 5.798 3.05939C5.58672 3.28905 5.48068 3.57387 5.48068 3.91262C5.48068 4.24708 5.57412 4.53071 5.76144 4.76571C5.94738 4.99966 6.2407 5.17428 6.64106 5.28949V6.58618C6.53058 6.53225 6.43079 6.44649 6.34044 6.32689ZM7.08858 5.42302C7.2748 5.47695 7.40801 5.55317 7.48895 5.65363C7.57094 5.75314 7.61208 5.87288 7.61208 6.01052C7.61208 6.16601 7.56359 6.3004 7.46594 6.4148C7.36935 6.52915 7.24307 6.60326 7.08858 6.6371V5.42302ZM6.34569 4.18127C6.28155 4.0872 6.25015 3.9855 6.25015 3.87649C6.25015 3.75694 6.28465 3.64794 6.35514 3.54838C6.42554 3.44897 6.52008 3.37801 6.64111 3.33462V4.40782C6.50863 4.35069 6.40988 4.27452 6.34569 4.18127Z"
                                  fill="#969696"></path>
                        </svg>
                        <div class="d-flex flex-column px-4">
                            <a href="#" class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet d-flex align-items-center fs-5">
                                    حساب تجاري
                                </div>
                                <div class="style-icon-copy-dropdown-user-account">
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value=""
                                               name="notifications" checked="checked">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <svg width="18" height="22" viewBox="0 0 19 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 4.47461C0 3.37461 0.95 2.47461 2.11111 2.47461H16.8889C17.4488 2.47461 17.9858 2.68532 18.3817 3.0604C18.7776 3.43547 19 3.94418 19 4.47461V18.4746C19 19.005 18.7776 19.5138 18.3817 19.8888C17.9858 20.2639 17.4488 20.4746 16.8889 20.4746H2.11111C1.55121 20.4746 1.01424 20.2639 0.61833 19.8888C0.22242 19.5138 0 19.005 0 18.4746V4.47461ZM2.11111 6.47461V18.4746H16.8889V6.47461H2.11111ZM4.22222 0.474609H6.33333V2.47461H4.22222V0.474609ZM12.6667 0.474609H14.7778V2.47461H12.6667V0.474609ZM4.22222 9.47461H6.33333V11.4746H4.22222V9.47461ZM4.22222 13.4746H6.33333V15.4746H4.22222V13.4746ZM8.44444 9.47461H10.5556V11.4746H8.44444V9.47461ZM8.44444 13.4746H10.5556V15.4746H8.44444V13.4746ZM12.6667 9.47461H14.7778V11.4746H12.6667V9.47461ZM12.6667 13.4746H14.7778V15.4746H12.6667V13.4746Z"
                                  fill="#969696"></path>
                        </svg>

                        <div class="d-flex flex-column px-4">
                            <div class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet d-flex align-items-center fs-5">
                                    <?php echo e(cp('registered')); ?>

                                </div>

                            </div>
                            <a href="#"
                               class="fw-bold style-text-number-wallet2 text-muted text-hover-primary fs-7"><?php echo e(auth()->user()->created_at->format('Y.m.d')); ?></a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <svg width="18" height="22" viewBox="0 0 20 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 10.4746C20 13.1268 18.9464 15.6703 17.0711 17.5457C15.1957 19.421 12.6522 20.4746 10 20.4746C7.34784 20.4746 4.8043 19.421 2.92893 17.5457C1.05357 15.6703 0 13.1268 0 10.4746C0 7.82244 1.05357 5.27891 2.92893 3.40354C4.8043 1.52818 7.34784 0.474609 10 0.474609C12.6522 0.474609 15.1957 1.52818 17.0711 3.40354C18.9464 5.27891 20 7.82244 20 10.4746ZM9 11.4746V14.4746C9 14.7398 9.10536 14.9942 9.29289 15.1817C9.48043 15.3693 9.73478 15.4746 10 15.4746C10.2652 15.4746 10.5196 15.3693 10.7071 15.1817C10.8946 14.9942 11 14.7398 11 14.4746V11.4746C11 11.2094 10.8946 10.955 10.7071 10.7675C10.5196 10.58 10.2652 10.4746 10 10.4746C9.73478 10.4746 9.48043 10.58 9.29289 10.7675C9.10536 10.955 9 11.2094 9 11.4746ZM10 5.97461C9.60218 5.97461 9.22064 6.13264 8.93934 6.41395C8.65804 6.69525 8.5 7.07678 8.5 7.47461C8.5 7.87243 8.65804 8.25397 8.93934 8.53527C9.22064 8.81657 9.60218 8.97461 10 8.97461C10.3978 8.97461 10.7794 8.81657 11.0607 8.53527C11.342 8.25397 11.5 7.87243 11.5 7.47461C11.5 7.07678 11.342 6.69525 11.0607 6.41395C10.7794 6.13264 10.3978 5.97461 10 5.97461Z"
                                  fill="#969696"></path>
                        </svg>
                        <div class="d-flex flex-column px-4">
                            <a data-bs-toggle="modal" data-bs-target="#kt_modal_Found_Error_data"
                               class="d-flex flex-row">
                                <div class="fw-bolder style-text-number-wallet2 d-flex align-items-center fs-5">
                                    <?php echo e(cp('found_error')); ?>

                                </div>

                            </a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <div class="menu-item px-3 d-none">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <label class="switch">
                            <input type="checkbox" id="togBtn">
                            <span class="slider round">
                                                            <span class="on" style="font-family:Almarai!important;">تشغيل</span>
                                                            <span class="off" style="font-family:Almarai!important;">إيقاف</span>
                                                        </span>
                        </label>
                        <div class="d-flex flex-column px-4">
                            <div class="d-flex flex-row">
                                <div class=""
                                     style="font-family:Almarai!important;color:#9C9C9C;font-size:12px;font-weight:600!important">
                                    أمن الرسائل القصيرة
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::Menu item-->
                <div class="menu-item px-3 d-none">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <label class="switch">
                            <input type="checkbox" id="togBtn">
                            <span class="slider round">
                                                            <span class="on" style="font-family:Almarai!important;">تشغيل</span>
                                                            <span class="off" style="font-family:Almarai!important;">إيقاف</span>
                                                        </span>
                        </label>
                        <div class="d-flex flex-column px-4">
                            <div class="d-flex flex-row">
                                <div class=""
                                     style="font-family:Almarai!important;color:#9C9C9C;font-size:12px;font-weight:600!important">
                                    أمان IP
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User -->
        <!--begin::Heaeder menu toggle-->
        <!--end::Heaeder menu toggle-->
    </div>

</div><?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/wallet/topbar_mobile.blade.php ENDPATH**/ ?>