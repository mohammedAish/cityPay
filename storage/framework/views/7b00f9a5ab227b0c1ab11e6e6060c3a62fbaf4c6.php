

<li filter-name="<?php echo e($filter->name); ?>"
    filter-type="<?php echo e($filter->type); ?>"
    filter-key="<?php echo e($filter->key); ?>"
	class="nav-item dropdown <?php echo e(Request::get($filter->name) ? 'active' : ''); ?>">
	<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($filter->label); ?> <span class="caret"></span></a>
	<div class="dropdown-menu p-0">
		<div class="form-group backpack-filter mb-0">
			<div class="input-group">
		        <input class="form-control pull-right"
		        		id="text-filter-<?php echo e($filter->key); ?>"
		        		type="text"
						<?php if($filter->currentValue): ?>
							value="<?php echo e($filter->currentValue); ?>"
						<?php endif; ?>
		        		>
		        <div class="input-group-append text-filter-<?php echo e($filter->key); ?>-clear-button">
		          <a class="input-group-text" href=""><i class="la la-times"></i></a>
		        </div>
		    </div>
		</div>
	</div>
</li>








<?php $__env->startPush('crud_list_scripts'); ?>
	<!-- include select2 js-->
  <script>
		jQuery(document).ready(function($) {
			$('#text-filter-<?php echo e($filter->key); ?>').on('change', function(e) {

				var parameter = '<?php echo e($filter->name); ?>';
				var value = $(this).val();

		    	// behaviour for ajax table
				var ajax_table = $('#crudTable').DataTable();
				var current_url = ajax_table.ajax.url();
				var new_url = addOrUpdateUriParameter(current_url, parameter, value);

				// replace the datatables ajax url with new_url and reload it
				new_url = normalizeAmpersand(new_url.toString());
				ajax_table.ajax.url(new_url).load();

				// add filter to URL
				crud.updateUrl(new_url);

				// mark this filter as active in the navbar-filters
				if (URI(new_url).hasQuery('<?php echo e($filter->name); ?>', true)) {
					$('li[filter-key=<?php echo e($filter->key); ?>]').removeClass('active').addClass('active');
				} else {
					$('li[filter-key=<?php echo e($filter->key); ?>]').trigger('filter:clear');
				}
			});

			$('li[filter-key=<?php echo e($filter->key); ?>]').on('filter:clear', function(e) {
				$('li[filter-key=<?php echo e($filter->key); ?>]').removeClass('active');
				$('#text-filter-<?php echo e($filter->key); ?>').val('');
			});

			// datepicker clear button
			$(".text-filter-<?php echo e($filter->key); ?>-clear-button").click(function(e) {
				e.preventDefault();

				$('li[filter-key=<?php echo e($filter->key); ?>]').trigger('filter:clear');
				$('#text-filter-<?php echo e($filter->key); ?>').val('');
				$('#text-filter-<?php echo e($filter->key); ?>').trigger('change');
			})
		});
  </script>
<?php $__env->stopPush(); ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/filters/text.blade.php ENDPATH**/ ?>