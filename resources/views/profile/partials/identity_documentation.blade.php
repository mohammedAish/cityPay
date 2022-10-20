<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    {{cp('personal_identity_documentation')}}
                                                </span>
                </h1>
                <p class="style-title-bio-card">
                    @if(!empty($identity_document) && $identity_document->status == 1)
                        تم توثيق هويتك بنجاح
                    @else
                        {{cp('personal_identity_documentation_follow_instructions')}}
                    @endif    
                </p>
            </div>
        </div>
    </div>
    <form name="profile" id="add_identity_document_form" action="{{route('add_identity_document')}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="card-body" id="Display_Next_Identity_block">

            <div class="row justify-content-between">

                <div class="col-md-8">
                    <div class="row">
                        {{--                        <div class="col-md-6 my-2">--}}
                        {{--                            <label class="style-label-form">{{cp('name')}} </label>--}}
                        {{--                            <input type="text" name="first_name" class="form-control"/>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-md-6 my-2">--}}
                        {{--                            <label class="style-label-form">{{cp('family_name')}}</label>--}}
                        {{--                            <input type="text" name="last_name" class="form-control"/>--}}
                        {{--                        </div>--}}
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">
                                {{cp('name')}}
                                <span class="style-label-form-Badeg"> {{cp('in_english_letters')}}</span>
                            </label>
                            <input type="text" name="first_name_en" class="form-control" required
                                   @if(!empty($identity_document) && $identity_document->first_name_en) 
                                   value="{{$identity_document->first_name_en}}" @endif
                                    @if(!empty($identity_document) && $identity_document->status == 1) disabled @endif
                            />
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">
                                {{cp('family_name')}}
                                <span class="style-label-form-Badeg"> {{cp('in_english_letters')}}</span>
                            </label>
                            <input type="text" name="last_name_en" class="form-control" required
                                   @if(!empty($identity_document) && $identity_document->last_name_en)
                                   value="{{$identity_document->last_name_en}}" @endif
                                   @if(!empty($identity_document) && $identity_document->status == 1) disabled @endif
                            />
                        </div>

                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('country')}}</label>
                            <select name="country_id" data-control="select2" required
                                    data-placeholder="{{cp('select_country_placeholder')}}" data-hide-search="true"
                                    class="form-select style-select-profile style-label-form " id="country_id"
                                    @if(!empty($identity_document) && $identity_document->status == 1) disabled @endif
                            >
                                <option></option>
                                @foreach($collected_data['countries'] as $country)
                                    <option value="{{$country->id}}"
                                            @if(!empty($identity_document) && $identity_document->country_id == $country->id) selected @endif
                                    >{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('birth_date')}}</label>
                            <input type="date" name="birthdate" required
                                   placeholder="{{cp('day')}}/{{cp('month')}}/{{cp('year')}}" class="form-control"
                                   @if(!empty($identity_document)  && $identity_document->birthdate)
                                   value="{{$identity_document->birthdate}}" @endif
                                   @if(!empty($identity_document) && $identity_document->status == 1) disabled @endif
                            />
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('phone_number')}}</label>
                            <div class="input-group">
                                <input type="text" name="mobile" id="mobileNumber" style="border-radius: 0;"
                                       class="form-control" required
                                       @if(!empty($identity_document) && $identity_document->mobile) value="{{$identity_document->mobile}}" @endif
                                       @if(!empty($identity_document) && $identity_document->status == 1) disabled @endif
                                />
                                @if(empty($identity_document) || $identity_document->status != 1)
                                    <a href="#" type="button" id="confimMobileBtn">
                                                                <span class="input-group-text text-white"
                                                                      style="font-family:Almarai!important;border-radius: 0px!important;background-color:#E51C39;"
                                                                      id="basic-addon2">
                                                                    {{cp('confirm')}}
                                                                </span>
                                    </a>
                                @endif


                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('e_mail')}}</label>
                            <input type="email" name="email" class="form-control"
                                   disabled value="{{auth('customers')->user()->email}}"
                            />
                        </div>
                        <div class="col-md-6 my-2">
                            @if(!empty($identity_document) && $identity_document->status == 1)
                            @endif    
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </form>


    <form action="{{route('update_identity_document_files')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="document_id" id="document_id" @if(!empty($identity_document)) value="{{$identity_document->id}}" @endif>
        <div class="card-body" id="Display_Next_Identity_Hide" style="display: none">

            <div class="d-none">
                <h1 class="style-title-card">
                                            <span class="mb-2 text-dark">
                                                {{cp('download_documents')}}
                                            </span>
                </h1>
                <p class="style-title-bio-card2">
                    {{cp('can_use_phone')}}
                </p>
            </div>

            <div class="row d-none">
                <div class="col-md-8">
                <span class="d-md-flex d-lg-flex d-sm-grid align-items-center me-2">
                                                <span class="symbol symbol-70px me-6">
                                                    <span class="symbol-label ">
                                                        <img src="assets/media/imagesWebsite/F9FNESYGJHVCX5F 1.png"/>
                                                    </span>
                                                </span>
                                                <span class="d-flex flex-column  ">
                                                    <span class="style-title-bio-card2">
                                                        {{cp('can_use_phone_upload_documents')}}
                                                        </span>

                                                    <span class="style-label-form-Badeg mb-2">
                                                        {{cp('can_user_following_link')}}
                                                        <span id="kt_clipboard_Confirm_profile" style="color:#1B3160;">www.google//.com</span>
                                                    </span>

                                                    <span>
                                                        <a href="#"
                                                           onclick="copyToClipboard('#kt_clipboard_Confirm_profile')"
                                                           class="style-btn-copy-link ">{{cp('copy_link')}}</a>
                                                    </span>
                                                </span>
                                            </span>
                </div>

            </div>
            <div class="row pt-5">

                <div class="row d-none">
                    <div class="col-md-12">
                        <h1 class="style-title-card">
                        <span class="mb-2 pt-5">
                            {{cp('can_use_desktop')}}
                        </span>
                        </h1>
                    </div>
                </div>
                <!--<div class="row style-row-identity ">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center ">-->
                <!--begin::Symbol-->
                <!--<div class="symbol symbol-50px me-3">
                    <div class="symbol-label bg-light-info">-->
                <!--begin::Svg Icon | path: icons/duotune/art/art007.svg-->
                <!--<span>
                    <svg width="62" height="76" viewBox="0 0 62 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M59.9996 2H2.12891V74H59.9996V2Z" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M29.1865 13.9463H51.0319" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M29.1865 30.8164H51.0319" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M29.1865 47.7041H51.0319" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M29.1865 64.5918H51.0319" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M11.0293 14.3016L14.9381 17.9228L19.6253 9.24219" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M11.0293 30.6991L14.9381 34.3203L19.6253 25.6396" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M11.0293 47.1125L14.9381 50.7167L19.6253 42.0361" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                        <path d="M11.0293 63.5087L14.9381 67.1298L19.6253 58.4492" stroke="#302C2A" stroke-opacity="0.5" stroke-width="3" stroke-miterlimit="10" stroke-linecap="square" />
                    </svg>
    
                </span>-->
                <!--end::Svg Icon-->
                <!--</div>
            </div>-->
                <!--end::Symbol-->
                <!--begin::Title-->
                <!--<div>
                    <div class="style-text-Upload-identity px-3">
                        <span style="color:#9E9E9E;">قم بتحميل </span>
                        <span style="color:#000;">شهادة التأسيس الخاصة بك</span>
                        <span>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 12C2.6862 12 0 9.3138 0 6C0 2.6862 2.6862 0 6 0C9.3138 0 12 2.6862 12 6C12 9.3138 9.3138 12 6 12ZM6 10.8C7.27304 10.8 8.49394 10.2943 9.39411 9.39411C10.2943 8.49394 10.8 7.27304 10.8 6C10.8 4.72696 10.2943 3.50606 9.39411 2.60589C8.49394 1.70571 7.27304 1.2 6 1.2C4.72696 1.2 3.50606 1.70571 2.60589 2.60589C1.70571 3.50606 1.2 4.72696 1.2 6C1.2 7.27304 1.70571 8.49394 2.60589 9.39411C3.50606 10.2943 4.72696 10.8 6 10.8ZM5.4 7.8H6.6V9H5.4V7.8ZM5.4 3H6.6V6.6H5.4V3Z" fill="#00BE40" />
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column pt-3 px-3">
                        <span>
                            <button type="button" class="btn px-3 py-1 style-btn-upload-file-identity">
                                اختر الملف
                            </button>
                            <span class="style-text-Upload-identity">photo_٢٠٢١-٠٩-٢٥_١٤-١٨-٠٤</span>
                            <span>
                                <a href="#">
                                    <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.50042 0C8.27014 -6.02066e-07 9.01042 0.295826 9.56814 0.826293C10.1259 1.35676 10.4583 2.08128 10.4968 2.85L10.5006 3H14.2508C14.442 3.00021 14.6258 3.07341 14.7648 3.20464C14.9039 3.33586 14.9875 3.51521 14.9987 3.70605C15.0099 3.89688 14.9478 4.08478 14.8251 4.23137C14.7024 4.37796 14.5284 4.47217 14.3385 4.49475L14.2508 4.5H13.614L12.729 15.4147C12.6719 16.1191 12.3517 16.7761 11.8322 17.2551C11.3127 17.7341 10.632 18 9.9253 18H5.07553C4.36888 18 3.68809 17.7341 3.1686 17.2551C2.64911 16.7761 2.32897 16.1191 2.27188 15.4147L1.38608 4.5H0.750042C0.566331 4.49998 0.389019 4.43253 0.251735 4.31046C0.114451 4.18839 0.0267444 4.02019 0.00525027 3.83775L0 3.75C2.42343e-05 3.5663 0.0674707 3.389 0.189547 3.25172C0.311623 3.11444 0.479838 3.02674 0.662287 3.00525L0.750042 3H4.50025C4.50025 2.20435 4.81634 1.44129 5.37898 0.87868C5.94162 0.316071 6.70472 0 7.50042 0ZM5.81282 6.9375C5.67689 6.93751 5.54555 6.98673 5.4431 7.07608C5.34066 7.16542 5.27403 7.28883 5.25554 7.4235L5.25029 7.5V13.5L5.25554 13.5765C5.27407 13.7111 5.34071 13.8345 5.44315 13.9238C5.5456 14.0131 5.67691 14.0623 5.81282 14.0623C5.94873 14.0623 6.08005 14.0131 6.18249 13.9238C6.28493 13.8345 6.35158 13.7111 6.3701 13.5765L6.37535 13.5V7.5L6.3701 7.4235C6.35162 7.28883 6.28499 7.16542 6.18254 7.07608C6.08009 6.98673 5.94876 6.93751 5.81282 6.9375ZM9.18801 6.9375C9.05207 6.93751 8.92074 6.98673 8.81829 7.07608C8.71584 7.16542 8.64922 7.28883 8.63073 7.4235L8.62548 7.5V13.5L8.63073 13.5765C8.64925 13.7111 8.7159 13.8345 8.81834 13.9238C8.92078 14.0131 9.0521 14.0623 9.18801 14.0623C9.32392 14.0623 9.45523 14.0131 9.55768 13.9238C9.66012 13.8345 9.72676 13.7111 9.74529 13.5765L9.75054 13.5V7.5L9.74529 7.4235C9.7268 7.28883 9.66018 7.16542 9.55773 7.07608C9.45528 6.98673 9.32395 6.93751 9.18801 6.9375ZM7.50042 1.5C7.12196 1.49988 6.75745 1.6428 6.47995 1.90012C6.20245 2.15744 6.03247 2.51013 6.00408 2.8875L6.00033 3H9.0005L8.99675 2.8875C8.96836 2.51013 8.79838 2.15744 8.52088 1.90012C8.24338 1.6428 7.87887 1.49988 7.50042 1.5Z" fill="#E81919" />
                                    </svg>
    
                                </a>
                            </span>
                        </span>
                        <span class="pt-3">
                            <button type="button" class="btn style-btn-copy-link px-3 py-1">
                                اختر الملف
                            </button>
                        </span>
                    </div>
                </div>-->
                <!--end::Title-->
            <!--</div>
        </div>
        <div class="col-md-3 style-info-upload-identity">
            <div class="d-flex flex-column  style-info-upload-identity-small">
                <span class="style-text-Upload-identity" style="color:#000;">
                    تنسيقات الملفات المقبولة
                </span>
                <span class="style-text-Upload-identity pt-3" style="color:#9E9E9E;">
{{--                    {{cp('file_must_be')}}--}}
                    png , Jpg , svg , Pdf
{{--                    {{cp('at_most')}} 50 MB--}}
                    </span>
                </div>
            </div>
        </div>-->

                <div class="row style-row-identity ">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center ">

                            <div class="symbol symbol-50px me-3">
                                @if(!empty($identity_document) && $identity_document->status == 1 && $identity_document->document_file)
                                    <img src="{{asset($identity_document->document_file)}}" width="80px">
                                @else
                                    <span>
                                                                <svg width="58" height="74" viewBox="0 0 58 74"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M29 24.1141C33.8502 24.1141 37.8118 28.08 37.8118 32.9374V37.0332C37.8118 38.0546 36.984 38.8835 35.9639 38.8835H22.0361C21.016 38.8835 20.1882 38.0546 20.1882 37.0332V32.9374C20.1882 28.0809 24.1498 24.1141 29 24.1141ZM12.7089 47.1037C10.2785 47.1037 10.2785 43.4031 12.7089 43.4031H45.2911C47.7215 43.4031 47.7215 47.1037 45.2911 47.1037H12.7089ZM12.7089 63.0271C10.2785 63.0271 10.2785 59.3274 12.7089 59.3274H45.2911C47.7215 59.3274 47.7215 63.0271 45.2911 63.0271H12.7089ZM12.7089 55.0659C10.2785 55.0659 10.2785 51.3652 12.7089 51.3652H45.2911C47.7215 51.3652 47.7215 55.0659 45.2911 55.0659H12.7089ZM1.8479 0H43.5461C44.0562 0 44.5179 0.206984 44.8526 0.542102L57.4586 13.1646C57.8192 13.5257 58 13.9997 58 14.4728V72.1497C58 73.1712 57.1722 74 56.1521 74H1.8479C0.827753 74 0 73.1712 0 72.1497V1.85031C0 0.828833 0.827753 0 1.8479 0ZM42.781 3.69973H3.69491V70.3003H54.3051V15.2389L42.781 3.69973ZM29 8.83581C33.1146 8.83581 36.4498 12.1762 36.4498 16.2962C36.4498 20.4153 33.1146 23.7557 29 23.7557C24.8854 23.7557 21.5502 20.4153 21.5502 16.2962C21.5502 12.1762 24.8854 8.83581 29 8.83581ZM29 12.5364C26.9257 12.5364 25.2451 14.2192 25.2451 16.2962C25.2451 18.3723 26.9257 20.056 29 20.056C31.0743 20.056 32.7549 18.3723 32.7549 16.2962C32.7549 14.2192 31.0743 12.5364 29 12.5364ZM29 27.8138C26.1901 27.8138 23.8831 30.1229 23.8831 32.9374V35.1837H34.1169V32.9374C34.1169 30.1229 31.8099 27.8138 29 27.8138Z"
                                                                          fill="black" fill-opacity="0.5"/>
                                                                </svg>

                                                            </span>
                                @endif
                            </div>

                            <div>
                                <div class="style-text-Upload-identity px-3">
                                    <span style="color:#9E9E9E;">{{cp('do_download')}} </span>
                                    <span style="color:#000;">{{cp('your_document_type')}}</span>
                                    <span>
                                                                <svg width="12" height="12" viewBox="0 0 12 12"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M6 12C2.6862 12 0 9.3138 0 6C0 2.6862 2.6862 0 6 0C9.3138 0 12 2.6862 12 6C12 9.3138 9.3138 12 6 12ZM6 10.8C7.27304 10.8 8.49394 10.2943 9.39411 9.39411C10.2943 8.49394 10.8 7.27304 10.8 6C10.8 4.72696 10.2943 3.50606 9.39411 2.60589C8.49394 1.70571 7.27304 1.2 6 1.2C4.72696 1.2 3.50606 1.70571 2.60589 2.60589C1.70571 3.50606 1.2 4.72696 1.2 6C1.2 7.27304 1.70571 8.49394 2.60589 9.39411C3.50606 10.2943 4.72696 10.8 6 10.8ZM5.4 7.8H6.6V9H5.4V7.8ZM5.4 3H6.6V6.6H5.4V3Z"
                                                                          fill="#00BE40"/>
                                                                </svg>
                                                            </span>
                                </div>
                                <div class="d-flex flex-column pt-3 px-3">

                                                            <span class="pb-2 d-md-flex flex-row">
                                                                <span class="form-check my-2 mx-1">
                                                                    <input class="form-check-input form-check-input-identity "
                                                                           type="radio"
                                                                           name="document_type"
                                                                           @if(!empty($identity_document) && $identity_document->status == 1 && $identity_document->document_type == "passport")
                                                                           checked
                                                                           @endif
                                                                           @if(!empty($identity_document) && $identity_document->status == 1) disabled
                                                                           @endif
                                                                           value="passport"
                                                                           id="flexRadioDefault1"/>
                                                                    <label class="form-check-label"
                                                                           for="flexRadioDefault1"> {{cp('passport')}} </label>
                                                                </span>
                                                                <span class="form-check my-2 mx-1">
                                                                    <input class="form-check-input form-check-input-identity"
                                                                           type="radio"
                                                                           name="document_type"
                                                                           @if(!empty($identity_document) && $identity_document->status == 1 && $identity_document->document_type == "verification_card") checked
                                                                           @endif
                                                                           @if(!empty($identity_document) && $identity_document->status == 1) disabled
                                                                           @endif
                                                                           value="verification_card"
                                                                           id="flexRadioDefault1"/>
                                                                    <label class="form-check-label"
                                                                           for="flexRadioDefault1"> {{cp('verification_card')}}</label>
                                                                </span>

                                                                <span class="form-check my-2 mx-1">
                                                                    <input class="form-check-input form-check-input-identity"
                                                                           type="radio"
                                                                           name="document_type"
                                                                           @if(!empty($identity_document) && $identity_document->status == 1 && $identity_document->document_type == "driving_license") checked
                                                                           @endif
                                                                           @if(!empty($identity_document) && $identity_document->status == 1) disabled
                                                                           @endif
                                                                           value="driving_license"
                                                                           id="flexRadioDefault1"/>
                                                                    <label class="form-check-label"
                                                                           for="flexRadioDefault1">{{cp('driving_license')}} </label>
                                                                </span>



                                                            </span>
                                    <span>
                                        @if(empty($identity_document) || $identity_document->status != 1 )
                                            <button type="button"
                                                    class="btn px-3 py-1 style-btn-upload-file-identity"
                                                    id="document_file_btn">
                                                                    {{cp('choose_file')}}
                                                                    <input type="file" name="document_file"
                                                                           id="document_file" accept=".png, .jpg, .jpeg"
                                                                           onchange="getFileData(this, 'document_file_span');"
                                                                           style="display: none;/*width: 0 !important;height: 0 !important;overflow: hidden;opacity: 0;*/">
                                                                </button>
                                        @endif
                                                                
                                                                <span id="document_file_span"
                                                                      class="style-text-Upload-identity"></span>
                                                                <span>
                                                                    <a href="#" class="d-none">
                                                                        <svg width="15" height="18" viewBox="0 0 15 18"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M7.50042 0C8.27014 -6.02066e-07 9.01042 0.295826 9.56814 0.826293C10.1259 1.35676 10.4583 2.08128 10.4968 2.85L10.5006 3H14.2508C14.442 3.00021 14.6258 3.07341 14.7648 3.20464C14.9039 3.33586 14.9875 3.51521 14.9987 3.70605C15.0099 3.89688 14.9478 4.08478 14.8251 4.23137C14.7024 4.37796 14.5284 4.47217 14.3385 4.49475L14.2508 4.5H13.614L12.729 15.4147C12.6719 16.1191 12.3517 16.7761 11.8322 17.2551C11.3127 17.7341 10.632 18 9.9253 18H5.07553C4.36888 18 3.68809 17.7341 3.1686 17.2551C2.64911 16.7761 2.32897 16.1191 2.27188 15.4147L1.38608 4.5H0.750042C0.566331 4.49998 0.389019 4.43253 0.251735 4.31046C0.114451 4.18839 0.0267444 4.02019 0.00525027 3.83775L0 3.75C2.42343e-05 3.5663 0.0674707 3.389 0.189547 3.25172C0.311623 3.11444 0.479838 3.02674 0.662287 3.00525L0.750042 3H4.50025C4.50025 2.20435 4.81634 1.44129 5.37898 0.87868C5.94162 0.316071 6.70472 0 7.50042 0ZM5.81282 6.9375C5.67689 6.93751 5.54555 6.98673 5.4431 7.07608C5.34066 7.16542 5.27403 7.28883 5.25554 7.4235L5.25029 7.5V13.5L5.25554 13.5765C5.27407 13.7111 5.34071 13.8345 5.44315 13.9238C5.5456 14.0131 5.67691 14.0623 5.81282 14.0623C5.94873 14.0623 6.08005 14.0131 6.18249 13.9238C6.28493 13.8345 6.35158 13.7111 6.3701 13.5765L6.37535 13.5V7.5L6.3701 7.4235C6.35162 7.28883 6.28499 7.16542 6.18254 7.07608C6.08009 6.98673 5.94876 6.93751 5.81282 6.9375ZM9.18801 6.9375C9.05207 6.93751 8.92074 6.98673 8.81829 7.07608C8.71584 7.16542 8.64922 7.28883 8.63073 7.4235L8.62548 7.5V13.5L8.63073 13.5765C8.64925 13.7111 8.7159 13.8345 8.81834 13.9238C8.92078 14.0131 9.0521 14.0623 9.18801 14.0623C9.32392 14.0623 9.45523 14.0131 9.55768 13.9238C9.66012 13.8345 9.72676 13.7111 9.74529 13.5765L9.75054 13.5V7.5L9.74529 7.4235C9.7268 7.28883 9.66018 7.16542 9.55773 7.07608C9.45528 6.98673 9.32395 6.93751 9.18801 6.9375ZM7.50042 1.5C7.12196 1.49988 6.75745 1.6428 6.47995 1.90012C6.20245 2.15744 6.03247 2.51013 6.00408 2.8875L6.00033 3H9.0005L8.99675 2.8875C8.96836 2.51013 8.79838 2.15744 8.52088 1.90012C8.24338 1.6428 7.87887 1.49988 7.50042 1.5Z"
                                                                                  fill="#E81919"/>
                                                                        </svg>

                                                                    </a>
                                                                </span>
                                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 style-info-upload-identity">
                        <div class="d-flex flex-column  style-info-upload-identity-small">
                                                    <span class="style-text-Upload-identity" style="color:#000;">
                                                        {{cp('accepted_file_formats')}}
                                                    </span>
                            <span class="style-text-Upload-identity pt-3" style="color:#9E9E9E;">
                                                        {{cp('file_must_be')}}
                                                        png , Jpg , svg , Pdf
                                                        {{cp('at_most')}} 50 MB
                                                    </span>
                        </div>
                    </div>
                </div>

                <div class="row style-row-identity ">
                    <div class="col-md-9">
                        <div class="d-flex align-items-center ">
                            <div class="symbol symbol-50px me-3">
                                <div class="symbol-label bg-light-info">
                                    @if(!empty($identity_document) && $identity_document->status == 1 && $identity_document->manager_address)
                                        <img src="{{asset($identity_document->manager_address)}}" width="80px">
                                    @else
                                        <span>
                                                                <svg width="58" height="74" viewBox="0 0 58 74"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M29 24.1141C33.8502 24.1141 37.8118 28.08 37.8118 32.9374V37.0332C37.8118 38.0546 36.984 38.8835 35.9639 38.8835H22.0361C21.016 38.8835 20.1882 38.0546 20.1882 37.0332V32.9374C20.1882 28.0809 24.1498 24.1141 29 24.1141ZM12.7089 47.1037C10.2785 47.1037 10.2785 43.4031 12.7089 43.4031H45.2911C47.7215 43.4031 47.7215 47.1037 45.2911 47.1037H12.7089ZM12.7089 63.0271C10.2785 63.0271 10.2785 59.3274 12.7089 59.3274H45.2911C47.7215 59.3274 47.7215 63.0271 45.2911 63.0271H12.7089ZM12.7089 55.0659C10.2785 55.0659 10.2785 51.3652 12.7089 51.3652H45.2911C47.7215 51.3652 47.7215 55.0659 45.2911 55.0659H12.7089ZM1.8479 0H43.5461C44.0562 0 44.5179 0.206984 44.8526 0.542102L57.4586 13.1646C57.8192 13.5257 58 13.9997 58 14.4728V72.1497C58 73.1712 57.1722 74 56.1521 74H1.8479C0.827753 74 0 73.1712 0 72.1497V1.85031C0 0.828833 0.827753 0 1.8479 0ZM42.781 3.69973H3.69491V70.3003H54.3051V15.2389L42.781 3.69973ZM29 8.83581C33.1146 8.83581 36.4498 12.1762 36.4498 16.2962C36.4498 20.4153 33.1146 23.7557 29 23.7557C24.8854 23.7557 21.5502 20.4153 21.5502 16.2962C21.5502 12.1762 24.8854 8.83581 29 8.83581ZM29 12.5364C26.9257 12.5364 25.2451 14.2192 25.2451 16.2962C25.2451 18.3723 26.9257 20.056 29 20.056C31.0743 20.056 32.7549 18.3723 32.7549 16.2962C32.7549 14.2192 31.0743 12.5364 29 12.5364ZM29 27.8138C26.1901 27.8138 23.8831 30.1229 23.8831 32.9374V35.1837H34.1169V32.9374C34.1169 30.1229 31.8099 27.8138 29 27.8138Z"
                                                                          fill="black" fill-opacity="0.5"/>
                                                                </svg>

                                                            </span>
                                    @endif

                                </div>
                            </div>
                            <div>
                                <div class="style-text-Upload-identity px-3">
                                    <span style="color:#9E9E9E;">{{cp('do_download')}}</span>
                                    <span style="color:#000;">{{cp('documents_confirming_manager_address')}}</span>
                                    <span>
                                                                <svg width="12" height="12" viewBox="0 0 12 12"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M6 12C2.6862 12 0 9.3138 0 6C0 2.6862 2.6862 0 6 0C9.3138 0 12 2.6862 12 6C12 9.3138 9.3138 12 6 12ZM6 10.8C7.27304 10.8 8.49394 10.2943 9.39411 9.39411C10.2943 8.49394 10.8 7.27304 10.8 6C10.8 4.72696 10.2943 3.50606 9.39411 2.60589C8.49394 1.70571 7.27304 1.2 6 1.2C4.72696 1.2 3.50606 1.70571 2.60589 2.60589C1.70571 3.50606 1.2 4.72696 1.2 6C1.2 7.27304 1.70571 8.49394 2.60589 9.39411C3.50606 10.2943 4.72696 10.8 6 10.8ZM5.4 7.8H6.6V9H5.4V7.8ZM5.4 3H6.6V6.6H5.4V3Z"
                                                                          fill="#00BE40"/>
                                                                </svg>
                                                            </span>
                                </div>
                                <div class="d-flex flex-column pt-3 px-3">
                                                            <span>
                                                                @if(empty($identity_document) || $identity_document->status != 1)
                                                                    <button type="button"
                                                                            class="btn px-3 py-1 style-btn-upload-file-identity"
                                                                            id="manager_address_btn">
                                                                    {{cp('choose_file')}}
                                                                    <input type="file" name="manager_address"
                                                                           id="manager_address"
                                                                           accept=".png, .jpg, .jpeg"
                                                                           onchange="getFileData(this, 'manager_address_span');"
                                                                           style="display: none;/*width: 0 !important;height: 0 !important;overflow: hidden;opacity: 0;*/">
                                                                </button>
                                                                @endif
                                                                
                                                                <span class="style-text-Upload-identity"
                                                                      id="manager_address_span"></span>
                                                                <span>
                                                                    <a href="#" class="d-none">
                                                                        <svg width="15" height="18" viewBox="0 0 15 18"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M7.50042 0C8.27014 -6.02066e-07 9.01042 0.295826 9.56814 0.826293C10.1259 1.35676 10.4583 2.08128 10.4968 2.85L10.5006 3H14.2508C14.442 3.00021 14.6258 3.07341 14.7648 3.20464C14.9039 3.33586 14.9875 3.51521 14.9987 3.70605C15.0099 3.89688 14.9478 4.08478 14.8251 4.23137C14.7024 4.37796 14.5284 4.47217 14.3385 4.49475L14.2508 4.5H13.614L12.729 15.4147C12.6719 16.1191 12.3517 16.7761 11.8322 17.2551C11.3127 17.7341 10.632 18 9.9253 18H5.07553C4.36888 18 3.68809 17.7341 3.1686 17.2551C2.64911 16.7761 2.32897 16.1191 2.27188 15.4147L1.38608 4.5H0.750042C0.566331 4.49998 0.389019 4.43253 0.251735 4.31046C0.114451 4.18839 0.0267444 4.02019 0.00525027 3.83775L0 3.75C2.42343e-05 3.5663 0.0674707 3.389 0.189547 3.25172C0.311623 3.11444 0.479838 3.02674 0.662287 3.00525L0.750042 3H4.50025C4.50025 2.20435 4.81634 1.44129 5.37898 0.87868C5.94162 0.316071 6.70472 0 7.50042 0ZM5.81282 6.9375C5.67689 6.93751 5.54555 6.98673 5.4431 7.07608C5.34066 7.16542 5.27403 7.28883 5.25554 7.4235L5.25029 7.5V13.5L5.25554 13.5765C5.27407 13.7111 5.34071 13.8345 5.44315 13.9238C5.5456 14.0131 5.67691 14.0623 5.81282 14.0623C5.94873 14.0623 6.08005 14.0131 6.18249 13.9238C6.28493 13.8345 6.35158 13.7111 6.3701 13.5765L6.37535 13.5V7.5L6.3701 7.4235C6.35162 7.28883 6.28499 7.16542 6.18254 7.07608C6.08009 6.98673 5.94876 6.93751 5.81282 6.9375ZM9.18801 6.9375C9.05207 6.93751 8.92074 6.98673 8.81829 7.07608C8.71584 7.16542 8.64922 7.28883 8.63073 7.4235L8.62548 7.5V13.5L8.63073 13.5765C8.64925 13.7111 8.7159 13.8345 8.81834 13.9238C8.92078 14.0131 9.0521 14.0623 9.18801 14.0623C9.32392 14.0623 9.45523 14.0131 9.55768 13.9238C9.66012 13.8345 9.72676 13.7111 9.74529 13.5765L9.75054 13.5V7.5L9.74529 7.4235C9.7268 7.28883 9.66018 7.16542 9.55773 7.07608C9.45528 6.98673 9.32395 6.93751 9.18801 6.9375ZM7.50042 1.5C7.12196 1.49988 6.75745 1.6428 6.47995 1.90012C6.20245 2.15744 6.03247 2.51013 6.00408 2.8875L6.00033 3H9.0005L8.99675 2.8875C8.96836 2.51013 8.79838 2.15744 8.52088 1.90012C8.24338 1.6428 7.87887 1.49988 7.50042 1.5Z"
                                                                                  fill="#E81919"/>
                                                                        </svg>

                                                                    </a>
                                                                </span>
                                                            </span>
                                    <span class="pt-3">
{{--                                                                <button type="button"--}}
                                        {{--                                                                        class="btn style-btn-copy-link px-3 py-1">--}}
                                        {{--                                                                   {{cp('choose_file')}}--}}
                                        {{--                                                                </button>--}}
                                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 style-info-upload-identity">
                        <div class="d-flex flex-column  style-info-upload-identity-small">
                                                    <span class="style-text-Upload-identity" style="color:#000;">
                                                        {{cp('accepted_file_formats')}}
                                                    </span>
                            <span class="style-text-Upload-identity pt-3" style="color:#9E9E9E;">
                                                        {{cp('file_must_be')}}
                                                        png , Jpg , svg , Pdf
                                                        {{cp('at_most')}} 50 Mb                            MB</span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12 mt-5">
                        <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               @if(!empty($identity_document) && $identity_document->status == 1)
                                                               checked
                                                               disabled
                                                               @endif
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            {{cp('agree_all_information_correct')}}
                                                        </label>
                                                    </span>
                        </h1>
                    </div>
                    @if(empty($identity_document) || $identity_document->status != 1)
                        <div class="col-md-4 my-2">
                            <button type="submit" class="form-control BntAdd-Modal"
                                    id="sendToCheckBtn">{{cp('send_to_check')}}</button>
                        </div>
                    @endif

                </div>
            </div>


        </div>
    </form>


    <div class="modal fade" id="kt_modal_enter_code_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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

                            <span class="px-1">{{cp('confirm_mobile_number')}}</span>
                        </h2>
                    </div>

                    <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                        <i class="fas fa-times  style-icon-Close-Modal"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body scroll-y ">

                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="col-md-12">
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <span id="verification_code_error" style="color: red"></span>
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        {{--                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('process_number')}}</div>--}}
                                        {{--                                        <input class="text-end style-row-Invouce-text border-0"--}}
                                        {{--                                               id="success_operation_process_number"--}}
                                        {{--                                               name="success_operation_process_number" type="text">--}}

                                        <input type="text" name="mobile" style="border-radius: 0;"
                                               class="form-control"
                                               placeholder="{{cp('enter_identity_mobile_verification')}}"
                                               id="verification_code"/>
                                        <a href="#" type="button" id="checkMobilCodeeBtn">
                                                                <span class="input-group-text text-white"
                                                                      style="font-family:Almarai!important;border-radius: 0px!important;background-color:#E51C39;"
                                                                      id="basic-addon2">
                                                                    {{cp('check_confirm')}}
                                                                </span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('custom_js')
    <script>
        $(document).ready(function () {

            // $('#flexCheckDefault').attr('checked', false);
            // $("#sendToCheckBtn").prop("disabled", true);
        });

        var Identity = document.getElementById("Display_Next_Identity_block");
        var Identity_Confirem = document.getElementById("Display_Next_Identity_Hide");
        var firstNextBtn = document.getElementById("firstNextBtn");

        Identity_Confirem.style.display = "none";

        // firstNextBtn.style.display = "none";

        Identity.style.display = "block";

        $('#verification_code_error').text('')

        function ClickIdentity() {


            if (Identity_Confirem.style.display === "none") {
                Identity_Confirem.style.display = "block";
                Identity.style.display = "none";
                toastr.info('{{cp('please_verify_identity')}}')
            } else {
                Identity_Confirem.style.display = "none";
            }
        }

        document.getElementById('document_file_btn').onclick = function () {
            document.getElementById('document_file').click();
        };

        document.getElementById('manager_address_btn').onclick = function () {
            document.getElementById('manager_address').click();
        };

        function getFileData(myFile, id) {
            var file = myFile.files[0];
            var filename = file.name;
            $('#' + id).text(filename)
        }

        $('#confimMobileBtn').click(function () {
            let mobileNumber = $('#mobileNumber').val()

            if (mobileNumber === undefined || mobileNumber == '') {
                $('#kt_modal_error_text').empty()
                $('#kt_modal_error_text').append('{{cp('enter_mobile_number')}}')
                $('#kt_modal_error').modal('show')
                return;
            }

            $.ajax({
                url: '{{route('send_mobile_verification_sms')}}',
                type: "post",
                data: {_token: '{{csrf_token()}}', mobile: mobileNumber},
                success: function (response) {
                    $('#kt_modal_enter_code_modal').modal('show')
                }, error: function (response) {
                    // console.log(response)
                },
            })
        });

        $('#add_identity_document_form').submit(function (event) {
            event.preventDefault();
            let form = $(this);
            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: $(form).serialize(),
                beforeSend: function (xhr) {
                    $('#firstNextBtn').attr('disabled', true)
                },
                complete: function (xhr, status) {
                    $('#firstNextBtn').attr('disabled', false)
                },
                success: function (res) {
                    if (res.success) {
                        $('#document_id').val(res.data.document_id)
                        // showSuccessModal(res.message)
                        if (Identity_Confirem.style.display === "none") {
                            Identity_Confirem.style.display = "block";
                            Identity.style.display = "none";
                        } else {
                            Identity_Confirem.style.display = "none";
                        }
                    } else {
                        showErrorModal(res.message)
                    }
                },
                error: function (xhr, status, message) {
                    if (xhr.status === 422) {
                        let response = $.parseJSON(xhr.responseText);
                        $.each(response.errors, function (key, value) {
                            showErrorModal(value[0])
                        });
                    }
                }
            });
        });


        $('#checkMobilCodeeBtn').click(function () {
            let verification_code = $('#verification_code').val()
            // console.log(verification_code)
            $.ajax({
                url: '{{route('check_verification_code')}}',
                type: "post",
                data: {
                    _token: '{{csrf_token()}}',
                    code: verification_code
                },
                success: function (response) {
                    if (response.success) {
                        var firstNextBtn = document.getElementById("firstNextBtn");
                        var confimMobileBtn = document.getElementById("confimMobileBtn");
                        firstNextBtn.style.display = "block";
                        confimMobileBtn.style.display = "none";
                        $('#kt_modal_enter_code_modal').modal('hide')
                    } else {
                        $('#verification_code_error').text(response.message)
                    }
                }, error: function (response) {
                    // console.log(response)
                },
            })
        });
    </script>
@endsection    