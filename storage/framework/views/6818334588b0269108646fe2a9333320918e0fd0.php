<?php $__env->startSection('content'); ?>
    <section class="m-5 style-right">
        <div class="card style-right">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            <?php echo e(cp('notifications')); ?>

                                        </span>
                        </h1>

                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex align-items-center py-3 style-border-bottom-Notifications">
                        <div class="symbol symbol-35px me-4">
                            <svg width="40" height="40" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="15" fill="#E51C39"/>
                                <g clip-path="url(#clip0_348_13287)">
                                    <path d="M10.8002 13.5999C10.7998 12.7273 11.0713 11.8762 11.5768 11.1649C12.0824 10.4536 12.7969 9.91744 13.6212 9.63092C13.5893 9.43094 13.6011 9.22641 13.6559 9.03145C13.7107 8.83649 13.8072 8.65574 13.9386 8.50167C14.07 8.34759 14.2333 8.22387 14.4172 8.13903C14.6011 8.05419 14.8012 8.01025 15.0037 8.01025C15.2062 8.01025 15.4063 8.05419 15.5902 8.13903C15.7741 8.22387 15.9374 8.34759 16.0688 8.50167C16.2002 8.65574 16.2967 8.83649 16.3515 9.03145C16.4063 9.22641 16.4181 9.43094 16.3862 9.63092C17.2092 9.91861 17.9222 10.4553 18.4264 11.1665C18.9307 11.8776 19.2011 12.7281 19.2002 13.5999V17.7999L21.3002 19.1999V19.8999H8.7002V19.1999L10.8002 17.7999V13.5999ZM16.4002 20.5999C16.4002 20.9712 16.2527 21.3273 15.9901 21.5899C15.7276 21.8524 15.3715 21.9999 15.0002 21.9999C14.6289 21.9999 14.2728 21.8524 14.0102 21.5899C13.7477 21.3273 13.6002 20.9712 13.6002 20.5999H16.4002Z"
                                          fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_348_13287">
                                        <rect width="15" height="16" fill="white" transform="translate(8 8)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="mb-0 ">
                            <a href="<?php echo e(route('notification_show', ['id' => $notification->id])); ?>" class="fs-6 style-text-Notifications-read fw-bolder">
                                <?php if(strpos($notification->data['subject'], '_') !== false): ?>
                                    <?php echo e(cp($notification->data['subject'])); ?>

                                <?php else: ?>
                                    <?php echo e($notification->data['subject']); ?>

                                <?php endif; ?>
                            </a>
                            <div class="text-gray-400 style-text-Notifications-read-time fs-7">منذ 20 ساعة</div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/notifications.blade.php ENDPATH**/ ?>