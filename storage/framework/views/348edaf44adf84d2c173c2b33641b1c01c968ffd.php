<?php $__env->startSection('content'); ?>
    <section class="m-5 style-right">
        <div class="card ">


            <div class="card-body table-responsive style-card-body-tabs">

                <ul class="nav nav-custom nav-tabs style-card-body-tabs-links  nav-line-tabs nav-line-tabs-2x border-0 ">

                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-bs-toggle="tab"
                           href="#kt_Tab_view_Porfile_info">
                            <?php echo e(cp('personal_account')); ?>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-bs-toggle="tab"
                           href="#kt_Identity_Documentation_tab">
                            <?php echo e(cp('identity_documentation')); ?>

                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Protection_and_security_tab">
                            <?php echo e(cp('protection_and_safety')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Tab_change_Porfile_Password">
                            <?php echo e(cp('restore_password')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_noitifications_tab">
                            <?php echo e(cp('notifications')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Record_activities_tab">
                            <?php echo e(cp('record_activities')); ?>

                        </a>
                    </li>
                </ul>


            </div>
        </div>


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="kt_Tab_view_Porfile_info" role="tabpanel">
                <?php echo $__env->make('profile.partials.personal_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            
            <div class="tab-pane fade show" id="kt_Identity_Documentation_tab" role="tabpanel">
                <?php if(empty($identity_document)): ?>
                    <?php echo $__env->make('profile.partials.identity_documentation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php if($identity_document->status == 0): ?>
                        <div class="card m-5 ">
                            <div class="row ">
                                <div class="col-md-12 p-8">
                                    <?php echo e(cp('identity_documentation_under_review')); ?>

                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php echo $__env->make('profile.partials.identity_documentation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="tab-pane fade show" id="kt_Protection_and_security_tab" role="tabpanel">
                <?php echo $__env->make('profile.partials.protection_and_security', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade show " id="kt_Tab_change_Porfile_Password" role="tabpanel">
                <?php echo $__env->make('profile.partials.restore_password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="tab-pane fade show " id="kt_noitifications_tab" role="tabpanel">
                <?php echo $__env->make('profile.partials.noitifications_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade show " id="kt_Record_activities_tab" role="tabpanel">
                <?php echo $__env->make('profile.partials.record_activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div class="modal fade" id="kt_modal_master_key" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-350px">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.4998 7.5L18.9998 4M20.9998 2L18.9998 4L20.9998 2ZM11.3898 11.61C11.9061 12.1195 12.3166 12.726 12.5975 13.3948C12.8785 14.0635 13.0244 14.7813 13.0268 15.5066C13.0292 16.232 12.8882 16.9507 12.6117 17.6213C12.3352 18.2919 11.9288 18.9012 11.4159 19.4141C10.903 19.9271 10.2937 20.3334 9.62309 20.6099C8.95247 20.8864 8.23379 21.0275 7.50842 21.025C6.78305 21.0226 6.06533 20.8767 5.39658 20.5958C4.72782 20.3148 4.12125 19.9043 3.61179 19.388C2.60992 18.3507 2.05555 16.9614 2.06808 15.5193C2.08061 14.0772 2.65904 12.6977 3.67878 11.678C4.69853 10.6583 6.078 10.0798 7.52008 10.0673C8.96216 10.0548 10.3515 10.6091 11.3888 11.611L11.3898 11.61ZM11.3898 11.61L15.4998 7.5L11.3898 11.61ZM15.4998 7.5L18.4998 10.5L21.9998 7L18.9998 4L15.4998 7.5Z"
                                          stroke="#9B9B9B" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                <span class="px-1">المفتاح الرئيسي</span>
                            </h2>
                            <h2 class="pt-1">
                                <span class="style-bio-Modal-trasfer">الرجاء إدخال 3 أرقام </span>
                            </h2>
                        </div>


                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>


                    <div class="modal-body scroll-y ">
                        <form class="form" action="#">

                            <div class="row">
                                <div class="col-md-12 mx-4 mb-4">
                                    <div class="d-flex  flex-row mw-md-600px w-100">
                                                    <span>
                                                        <button type="button" onclick="ClicksuccesInputCodeConifrem()"
                                                                class="btn style-btn-calut-modal">OK</button>
                                                    </span>
                                        <span class="px-3">
                                                        <input type="text" style="width:185px;" class="form-control"
                                                               placeholder="XXX"/>
                                                    </span>
                                    </div>
                                    <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">9</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">8</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">7</button>
                                                    </span>

                                    </div>
                                    <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">6</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">5</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">4</button>
                                                    </span>

                                    </div>
                                    <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">3</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">2</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">1</button>
                                                    </span>

                                    </div>
                                    <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button" class="btn style-btn-calut-modal-number"
                                                                style="width:165px;">BKSP</button>
                                                    </span>
                                        <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">0</button>
                                                    </span>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>


    <div class="modal fade" id="profile_image_modal" tabindex="-1" role="dialog" aria-labelledby="modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header   col-md-12">
                    <div class=" col-md-10 row ">
                        <div class="col-md-2 text-right">
                            <div class="circle_icon " style="background-color: red"><i
                                        class="fas fa-info"></i></div>
                        </div>
                    </div>


                    <div class=" text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="inner">
                        <div class="form-row form-row-date">
                            <div class="form-holder form-holder-2 col-md-12">
                                <div class="container" style="text-align: center;">
                                    <form id="data" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-12 col-md-offset-3 "
                                                 style="text-align: center;">
                                                <div class="btn-container">
                                                    <!--the three icons: default, ok file (img), error file (not an img)-->

                                                    <h1 class="imgupload"><i
                                                                class="zmdi zmdi-cloud-upload"
                                                                style="color: #0B4879;"></i>
                                                    </h1>
                                                    <h1 class="imgupload ok"><i
                                                                class="zmdi zmdi-check"></i></h1>
                                                    <h1 class="imgupload stop"><i
                                                                class="zmdi zmdi-close-circle"></i>
                                                    </h1>
                                                    <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                    <p id="namefile"><?php echo e(trans('lang.img-extension')); ?>

                                                        (jpg,jpeg,bmp,png)</p>
                                                    <!--our custom btn which which stays under the actual one-->
                                                    <button type="button" id="btnup" class="btn  btn-lg"
                                                            style="background-color: #0B4879; color: white">
                                                        <?php echo e(trans('lang.brows-imgs')); ?>

                                                    </button>
                                                    <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                    <input type="file" value="" name="fileup"
                                                           id="fileup">
                                                    <input type="hidden" name="order_id" id="model_order_id" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--additional fields-->


                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                
                
                
                
            </div>
        </div>
    </div>

    <script type="text/javascript">

        let allowed_hash = ['#kt_Tab_view_Porfile_info', '#kt_Identity_Documentation_tab', '#kt_Protection_and_security_tab', '#kt_Tab_change_Porfile_Password', '#kt_noitifications_tab', '#kt_Record_activities_tab'];

        let hash = window.location.hash;
        if (!hash || !allowed_hash.includes(hash)) {
            hash = '#kt_Tab_view_Porfile_info';
        }

        let anchor_element = document.querySelectorAll("a[href='" + hash + "']");
        anchor_element = anchor_element[0];

        let div_element = document.getElementById("" + hash.replace("#", "") + "");

        anchor_element.classList.add('active')
        div_element.classList.add('active')
        
        $(document).on("click", '.show_add_file_model', function (e) {
            e.preventDefault();
            $('#profile_image_modal').modal('show');

        });

        $('#fileup').change(function () {

            // Check file selected or not
            // if (files.length > 0)

//here we take the file extension and set an array of valid extensions
            var res = $('#fileup').val();
            var arr = res.split("\\");
            var filename = arr.slice(-1)[0];
            filextension = filename.split(".");
            filext = "." + filextension.slice(-1)[0];
            valid = [".jpg", ".png", ".jpeg", ".bmp"];
//if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase()) == -1) {
                $(".imgupload").hide("slow");
                $(".imgupload.ok").hide("slow");
                $(".imgupload.stop").show("slow");

                $('#namefile').css({"color": "red", "font-weight": 700});
                $('#namefile').html("File " + filename + " is not  pic!");

                $("#submitbtn").hide();
                $("#fakebtn").show();
            } else {
                var formData = new FormData($("form#data")[0]);
                $.ajax({
                    url: "<?php echo e(route('update_img_profile')); ?>",
                    type: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        $("#img_path").attr("src", response.data);
                        $("#prfile_image_nav").attr("src", response.data);
                        console.log(response);
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: response.message,
                            icon: 'success'
                        });

                        $('#profile_image_modal').modal('hide');
                    }
                });


                $(".imgupload").hide("slow");
                $(".imgupload.stop").hide("slow");
                $(".imgupload.ok").show("slow");

                $('#namefile').css({"color": "green", "font-weight": 700});
                $('#namefile').html(filename);

                $("#submitbtn").show();
                $("#fakebtn").hide();
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/profile/profile2.blade.php ENDPATH**/ ?>