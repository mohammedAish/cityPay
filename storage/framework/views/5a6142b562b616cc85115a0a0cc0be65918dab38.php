<div class="tab-pane fade show " id="pay_bills_requests_tab" role="tabpanel">
    <div class="card m-5 ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="page-title style-boder-titel-card d-flex flex-column   ">
                    <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    <?php echo e(cp('pay_bills_requests')); ?>

                                                </span>
                    </h1>

                </div>
            </div>
        </div>
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                                            <span class="svg-icon svg-icon-1 position-absolute style-icon-search-Teble-padd">
                                                <svg class="style-icon-search-Teble" xmlns="http://www.w3.org/2000/svg"
                                                     width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                          height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                          fill="black"></rect>
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                          fill="black"></path>
                                                </svg>
                                            </span>
                    <input type="text" data-kt-user-table-filter="search"
                           id="kt_project_Bill_payment_requests_Search_All"
                           class="form-control form-control-solid style-input-search-Data-Teable ps-14"
                           placeholder="<?php echo e(cp('search_for')); ?>">
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="dataTables_wrapper style-boder-titel-Table dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                           id="kt_project_Bill_payment_requests">
                        <thead>
                        <tr class="style-row-table">
                            <th class="min-w-125px style-Title-colume-table"><?php echo e(cp('process_date')); ?></th>
                            <th class="min-w-80px style-Title-colume-table"><?php echo e(cp('original_price')); ?></th>
                            <th class="min-w-100px style-Title-colume-table"><?php echo e(cp('commission')); ?></th>
                            <th class="min-w-100px style-Title-colume-table"><?php echo e(cp('final_price')); ?></th>
                            <th class="min-w-80px style-Title-colume-table"><?php echo e(cp('process_number')); ?></th>
                            <th class="min-w-125px style-Title-colume-table"><?php echo e(cp('status')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $__env->make('wallet.processes.partials.tables._pay_bills_requests', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/processes/partials/pay_bills_requests_tab.blade.php ENDPATH**/ ?>