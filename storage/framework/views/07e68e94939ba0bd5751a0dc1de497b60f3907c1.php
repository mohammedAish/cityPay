<?php if(backpack_auth()->check()): ?>
    <!-- Left side column. contains the sidebar -->
    <div class="<?php echo e(config('backpack.base.sidebar_class')); ?>">
      <!-- sidebar: style can be found in sidebar.less -->
      <nav class="sidebar-nav overflow-hidden">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav">
          <!-- <li class="nav-title"><?php echo e(trans('backpack::base.administration')); ?></li> -->
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->

          <?php echo $__env->make(backpack_view('inc.sidebar_content'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <!-- ======================================= -->
          <!-- <li class="divider"></li> -->
          <!-- <li class="nav-title">Entries</li> -->
        </ul>
      </nav>
      <!-- /.sidebar -->
    </div>
<?php endif; ?>

<?php $__env->startPush('before_scripts'); ?>
  <script type="text/javascript">
    // Save default sidebar class
    let sidebarClass = (document.body.className.match(/sidebar-(sm|md|lg|xl)-show/) || ['sidebar-lg-show'])[0];
    let sidebarTransition = value => document.querySelector('.app-body > .sidebar').style.transition = value || '';

    // Recover sidebar state
    let sessionState = sessionStorage.getItem('sidebar-collapsed');
    if (sessionState) {
      // disable the transition animation temporarily, so that if you're browsing across
      // pages with the sidebar closed, the sidebar does not flicker into the view
      sidebarTransition("none");
      document.body.classList.toggle(sidebarClass, sessionState === '1');

      // re-enable the transition, so that if the user clicks the hamburger menu, it does have a nice transition
      setTimeout(sidebarTransition, 100);
    }
  </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts'); ?>
  <script>
      // Store sidebar state
      document.querySelectorAll('.sidebar-toggler').forEach(toggler => 
        toggler.addEventListener('click', () => 
          sessionStorage.setItem('sidebar-collapsed', Number(!document.body.classList.contains(sidebarClass)))
        )
      );
      // Set active state on menu element
      var full_url = "<?php echo e(Request::fullUrl()); ?>";
      var $navLinks = $(".sidebar-nav li a, .app-header li a");

      // First look for an exact match including the search string
      var $curentPageLink = $navLinks.filter(
          function() { return $(this).attr('href') === full_url; }
      );

      // If not found, look for the link that starts with the url
      if(!$curentPageLink.length > 0){
          $curentPageLink = $navLinks.filter( function() {
            if ($(this).attr('href').startsWith(full_url)) {
              return true;
            }

            if (full_url.startsWith($(this).attr('href'))) {
              return true;
            }

            return false;
          });
      }

      // for the found links that can be considered current, make sure 
      // - the parent item is open
      $curentPageLink.parents('li').addClass('open');
      // - the actual element is active
      $curentPageLink.each(function() {
        $(this).addClass('active');
      });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/base/inc/sidebar.blade.php ENDPATH**/ ?>