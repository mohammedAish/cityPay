<?php $__currentLoopData = $deposit_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="odd  style-row-table">
        <td class="style-text-row-table"><?php echo e($order->created_at->format('Y/m/d')); ?></td>
        <td class="style-text-row-table"><?php echo e($order->agency->name); ?></td>


        <td class="style-text-row-table">$<?php echo e($order->amount); ?></td>
        <td class="style-text-row-table"><?php echo e($order->deposit_type); ?></td>
        <td class="style-text-row-table">
            <button type="button" class="btn show-deposit-details-modal" 
                    order_agency="<?php echo e($order->agency->name); ?>"
                    order_method="<?php echo e($order->agency->depositMethod->name); ?>"
                    order_amount="<?php echo e($order->amount); ?>"
                    order_id="<?php echo e($order->id); ?>"
                    order_currency="<?php echo e($order->currency->name); ?>"
                    order_total_amount="<?php echo e($order->final_amount); ?>"
                    order_commission="<?php echo e($order->agency->fixed_charge_deposit + $order->agency->deposit_fee_percent); ?>"
            >
                <?php echo e($order->id); ?>

            </button>
        </td>
        <td class="style-text-row-table">
            <?php if($order->current_status == 'pending'): ?>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                    <path d="M7.86089 4.25003C7.86089 4.44946 7.69922 4.61114 7.49978 4.61114C7.30035 4.61114 7.13867 4.44946 7.13867 4.25003C7.13867 4.05059 7.30035 3.88892 7.49978 3.88892C7.69922 3.88892 7.86089 4.05059 7.86089 4.25003Z"
                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                    <path d="M7.5 11.111V6.05542" stroke="#E51C39" stroke-width="1.5"/>
                </svg>

                

                <span class="px-1">
                    <img id="img_path_<?php echo e($order->id); ?>" src="<?php echo e(asset($order->img_path)); ?>" alt=""
                         style="max-width: 40px;">
                    <a href="#" data-order_id="<?php echo e($order->id); ?>" class="show_add_file_model"> 
                        <?php echo e(cp('pending')); ?><?php echo e('- ايصال الدفع'); ?></a></span>

            <?php elseif($order->current_status == 'rejected'): ?>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                    <path d="M7.86089 4.25003C7.86089 4.44946 7.69922 4.61114 7.49978 4.61114C7.30035 4.61114 7.13867 4.44946 7.13867 4.25003C7.13867 4.05059 7.30035 3.88892 7.49978 3.88892C7.69922 3.88892 7.86089 4.05059 7.86089 4.25003Z"
                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                    <path d="M7.5 11.111V6.05542" stroke="#E51C39" stroke-width="1.5"/>
                </svg>
                <span class="px-1"><?php echo e(cp('rejected')); ?></span>
            <?php else: ?>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.33388 6.05569L7.48087 7.66594C7.89934 7.97979 8.48899 7.91811 8.83344 7.52444L13.2783 2.44458"
                          stroke="#3ABE32" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M14 7.5C14 8.85813 13.5746 10.1822 12.7835 11.2861C11.9924 12.3901 10.8754 13.2185 9.58936 13.655C8.3033 14.0916 6.9128 14.1144 5.61315 13.7201C4.3135 13.3259 3.16998 12.5344 2.3432 11.4569C1.51642 10.3795 1.04792 9.07008 1.00348 7.71267C0.959043 6.35527 1.34091 5.01804 2.09545 3.88879C2.84999 2.75955 3.93929 1.89501 5.21037 1.41661C6.48146 0.938209 7.87047 0.869972 9.18232 1.22148"
                          stroke="#3ABE32" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
                <span class="px-1"><?php echo e(cp('completed')); ?></span>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    <?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/processes/partials/tables/_deposit_requests.blade.php ENDPATH**/ ?>