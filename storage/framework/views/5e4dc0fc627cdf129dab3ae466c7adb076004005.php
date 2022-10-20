
<li filter-name="<?php echo e($filter->name); ?>"
    filter-type="<?php echo e($filter->type); ?>"
    filter-key="<?php echo e($filter->key); ?>"
	class="nav-item dropdown <?php echo e(Request::get($filter->name)?'active':''); ?>">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($filter->label); ?> <span class="caret"></span></a>
    <div class="dropdown-menu p-0">
      <div class="form-group backpack-filter mb-0">
			<select id="filter_<?php echo e($filter->key); ?>" name="filter_<?php echo e($filter->key); ?>" data-filter-key="<?php echo e($filter->key); ?>" class="form-control input-sm select2" data-filter-type="select2" data-filter-name="<?php echo e($filter->name); ?>" placeholder="<?php echo e($filter->placeholder); ?>">
				<option value="">-</option>
				<?php if(is_array($filter->values) && count($filter->values)): ?>
					<?php $__currentLoopData = $filter->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key); ?>"
							<?php if($filter->isActive() && $filter->currentValue == $key): ?>
								selected
							<?php endif; ?>
							>
							<?php echo e($value); ?>

						</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</select>
		</div>
    </div>
  </li>







<?php $__env->startPush('crud_list_styles'); ?>
    <!-- include select2 css-->
    <link href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
	  .form-inline .select2-container {
	    display: inline-block;
	  }
	  .select2-drop-active {
	  	border:none;
	  }
	  .select2-container .select2-choices .select2-search-field input, .select2-container .select2-choice, .select2-container .select2-choices {
	  	border: none;
	  }
	  .select2-container-active .select2-choice {
	  	border: none;
	  	box-shadow: none;
	  }
	  .select2-container--bootstrap .select2-dropdown {
	  	margin-top: -2px;
	  	margin-left: -1px;
	  }
	  .select2-container--bootstrap {
	  	position: relative!important;
	  	top: 0px!important;
	  }
    </style>
<?php $__env->stopPush(); ?>





<?php $__env->startPush('crud_list_scripts'); ?>
	<!-- include select2 js-->
    <script src="<?php echo e(asset('packages/select2/dist/js/select2.full.min.js')); ?>"></script>
    <?php if(app()->getLocale() !== 'en'): ?>
    <script src="<?php echo e(asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js')); ?>"></script>
    <?php endif; ?>

    <script>
        jQuery(document).ready(function($) {
            // trigger select2 for each untriggered select2 box
            $('select[data-filter-type=select2]').not('[data-filter-enabled]').each(function () {
            	var filterName = $(this).attr('data-filter-name');
                var filter_key = $(this).attr('data-filter-key');
            	var element = $(this);

            	$(this).attr('data-filter-enabled', 'true');

            	var obj = $(this).select2({
	            	allowClear: true,
		            closeOnSelect: false,
					theme: "bootstrap",
					dropdownParent: $(this).parent('.form-group'),
	        	    placeholder: $(this).attr('placeholder'),
	            });

				$(this).change(function() {
					var value = $(this).val();
					var parameter = $(this).attr('data-filter-name');

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
					if (URI(new_url).hasQuery(parameter, true)) {
						$("li[filter-key="+filter_key+"]").addClass('active');
					}
					else
					{
						$("li[filter-key="+filter_key+"]").removeClass("active");
						$("li[filter-key="+filter_key+"]").find('.dropdown-menu').removeClass("show");
					}
				});

				// when the dropdown is opened, autofocus on the select2
				$("li[filter-key="+filter_key+"]").on('shown.bs.dropdown', function () {
					$('select[data-filter-key='+filter_key+']').select2('open');
				});

				// clear filter event (used here and by the Remove all filters button)
				$("li[filter-key="+filter_key+"]").on('filter:clear', function(e) {
					// console.log('select2 filter cleared');
					$("li[filter-key="+filter_key+"]").removeClass('active');
	                $('#filter_'+filter_key).val(null).trigger('change');
				});
            });
		});
	</script>
<?php $__env->stopPush(); ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/filters/select2.blade.php ENDPATH**/ ?>