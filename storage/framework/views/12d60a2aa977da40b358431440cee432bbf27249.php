
<li filter-name="<?php echo e($filter->name); ?>"
    filter-type="<?php echo e($filter->type); ?>"
    filter-key="<?php echo e($filter->key); ?>"
	class="nav-item dropdown <?php echo e(Request::get($filter->name)?'active':''); ?>">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($filter->label); ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">
		<a class="dropdown-item" parameter="<?php echo e($filter->name); ?>" dropdownkey="" href="">-</a>
		<div role="separator" class="dropdown-divider"></div>
		<?php if(is_array($filter->values) && count($filter->values)): ?>
			<?php $__currentLoopData = $filter->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($key === 'dropdown-separator'): ?>
					<div role="separator" class="dropdown-divider"></div>
				<?php else: ?>
					<a  class="dropdown-item <?php echo e(($filter->isActive() && $filter->currentValue == $key)?'active':''); ?>"
						parameter="<?php echo e($filter->name); ?>"
						href=""
						dropdownkey="<?php echo e($key); ?>"
						><?php echo e($value); ?></a>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
    </ul>
  </li>








    





<?php $__env->startPush('crud_list_scripts'); ?>
    <script>
		jQuery(document).ready(function($) {
			$("li.dropdown[filter-key=<?php echo e($filter->key); ?>] .dropdown-menu a").click(function(e) {
				e.preventDefault();

				var value = $(this).attr('dropdownkey');
				var parameter = $(this).attr('parameter');

		    	// behaviour for ajax table
				var ajax_table = $("#crudTable").DataTable();
				var current_url = ajax_table.ajax.url();
				var new_url = addOrUpdateUriParameter(current_url, parameter, value);

				// replace the datatables ajax url with new_url and reload it
				new_url = normalizeAmpersand(new_url.toString());
				ajax_table.ajax.url(new_url).load();

				// add filter to URL
				crud.updateUrl(new_url);

				// mark this filter as active in the navbar-filters
				// mark dropdown items active accordingly
				if (URI(new_url).hasQuery('<?php echo e($filter->name); ?>', true)) {
					$("li[filter-key=<?php echo e($filter->key); ?>]").removeClass('active').addClass('active');
					$("li[filter-key=<?php echo e($filter->key); ?>] .dropdown-menu a").removeClass('active');
					$(this).addClass('active');
				}
				else
				{
					$("li[filter-key=<?php echo e($filter->key); ?>]").trigger("filter:clear");
				}
			});

			// clear filter event (used here and by the Remove all filters button)
			$("li[filter-key=<?php echo e($filter->key); ?>]").on('filter:clear', function(e) {
				// console.log('dropdown filter cleared');
				$("li[filter-key=<?php echo e($filter->key); ?>]").removeClass('active');
				$("li[filter-key=<?php echo e($filter->key); ?>] .dropdown-menu a").removeClass('active');
			});
		});
	</script>
<?php $__env->stopPush(); ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/filters/dropdown.blade.php ENDPATH**/ ?>