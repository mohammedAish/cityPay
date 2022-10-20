<li class="nav-item dropdown pr-4">
  <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <img class="img-avatar" src="<?php echo e(backpack_avatar_url(backpack_auth()->user())); ?>" alt="<?php echo e(backpack_auth()->user()->name); ?>">
  </a>
  <div class="dropdown-menu <?php echo e(config('backpack.base.html_direction') == 'rtl' ? 'dropdown-menu-left' : 'dropdown-menu-right'); ?> mr-4 pb-1 pt-1">
    <a class="dropdown-item" href="<?php echo e(route('backpack.account.info')); ?>"><i class="la la-user"></i> <?php echo e(trans('backpack::base.my_account')); ?></a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo e(backpack_url('logout')); ?>"><i class="la la-lock"></i> <?php echo e(trans('backpack::base.logout')); ?></a>
  </div>
</li>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/base/inc/menu_user_dropdown.blade.php ENDPATH**/ ?>