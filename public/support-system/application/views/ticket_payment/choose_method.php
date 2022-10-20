<?php
/**
 * @var AppPaymentBase[] $active_methods
 * @var $ticket_id;
 * @var $reply_id;
 * @var $payment_id;
 * @var Mticket_payment $payment_obj
 */
if(!empty($active_methods)) {
    ?>
        <h2 class="text-center mb-3"><?php _e("Choose Payment method") ; ?></h2>
            <h3 class="text-center mb-5 text-success" ><?php _e("Amount - %s",$payment_obj->payment_currency.' '.$payment_obj->amount) ; ?></h3>
            <div class="d-flex justify-content-center section-mb">
    <?php
    foreach ($active_methods as $active_method) {
        ?>
        <a class="payment-method" href="<?php echo site_url("ticket-payment/process/{$active_method->ID}/$ticket_id/$reply_id/$payment_id") ?>">
            <?php echo $active_method->getButtonImageHTML(); ?>
        </a>
        <?php
    }
    ?>
            </div>

    <?php
}