<section class="upPage">
    <div class="item btn-group dropup">

    <div id="body">





























    </div>
    </div>
    <div class="item btn-group dropup">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <i class="fas fa-comment-dots"></i>
            <i class="fas fa-times"></i>
        </button>
        <div class="dropdown-menu">
            <div class="icons">
                <a href="https://wa.me/<?php echo e((isset($footer->whatsapp)?$footer->whatsapp:'whatsappnumber')); ?>"
                   class="icon-link whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="<?php echo e((isset($footer->telegram)?$footer->telegram:'telegram number here')); ?>"
                   class="icon-link telegram">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="<?php echo e((isset($footer->messenger)?$footer->messenger:'messenger account here')); ?>"
                   class="icon-link facebook">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
                <a href="<?php echo e((isset($footer->viber)?$footer->viber:'viber number here')); ?>" class="icon-link viber">
                    <i class="fab fa-viber"></i>
                </a>
                <a href="<?php echo e((isset($footer->skype)?$footer->skype:'skype number here')); ?>" class="icon-link skype">
                    <i class="fab fa-skype"></i>
                </a>


            </div>
        </div>
    </div>
    <button class="item upBtn" onclick="scrollToTop()"><i class="fas fa-chevron-up"></i></button>
</section>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/org_web/social_media.blade.php ENDPATH**/ ?>