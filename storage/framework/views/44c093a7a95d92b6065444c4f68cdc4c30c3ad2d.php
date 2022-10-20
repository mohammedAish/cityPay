<?php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
?>

<?php $__env->startSection('header'); ?>
	<section class="container-fluid d-print-none">
    	<a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
		<h2>
	        <span class="text-capitalize"><?php echo $crud->getHeading() ?? $crud->entity_name_plural; ?></span>
	        <small><?php echo $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name; ?>.</small>
	        <?php if($crud->hasAccess('list')): ?>
	          <small class=""><a href="<?php echo e(url($crud->route)); ?>" class="font-sm"><i class="la la-angle-double-left"></i> <?php echo e(trans('backpack::crud.back_to_all')); ?> <span><?php echo e($crud->entity_name_plural); ?></span></a></small>
	        <?php endif; ?>
	    </h2>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="<?php echo e($crud->getShowContentClass()); ?>">

	<!-- Default box -->
	  <div class="">
	  	<?php if($crud->model->translationEnabled()): ?>
			<div class="row">
				<div class="col-md-12 mb-2">
					<!-- Change translation button group -->
					<div class="btn-group float-right">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo e(trans('backpack::crud.language')); ?>: <?php echo e($crud->model->getAvailableLocales()[request()->input('locale')?request()->input('locale'):App::getLocale()]); ?> &nbsp; <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php $__currentLoopData = $crud->model->getAvailableLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a class="dropdown-item" href="<?php echo e(url($crud->route.'/'.$entry->getKey().'/show')); ?>?locale=<?php echo e($key); ?>"><?php echo e($locale); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
					</div>
				</div>
			</div>
	    <?php endif; ?>
	    <div class="card no-padding no-border">
			<table class="table table-striped mb-0">
		        <tbody>
		        <?php $__currentLoopData = $crud->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		            <tr>
		                <td>
		                    <strong><?php echo $column['label']; ?>:</strong>
		                </td>
                        <td>
							<?php if(!isset($column['type'])): ?>
		                      <?php echo $__env->make('crud::columns.text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		                    <?php else: ?>
		                      <?php if(view()->exists('vendor.backpack.crud.columns.'.$column['type'])): ?>
		                        <?php echo $__env->make('vendor.backpack.crud.columns.'.$column['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		                      <?php else: ?>
		                        <?php if(view()->exists('crud::columns.'.$column['type'])): ?>
		                          <?php echo $__env->make('crud::columns.'.$column['type'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		                        <?php else: ?>
		                          <?php echo $__env->make('crud::columns.text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		                        <?php endif; ?>
		                      <?php endif; ?>
		                    <?php endif; ?>
                        </td>
		            </tr>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php if($crud->buttons()->where('stack', 'line')->count()): ?>
					<tr>
						<td><strong><?php echo e(trans('backpack::crud.actions')); ?></strong></td>
						<td>
							<?php echo $__env->make('crud::inc.button_stack', ['stack' => 'line'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</td>
					</tr>
				<?php endif; ?>
		        </tbody>
			</table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

	</div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('after_styles'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after_scripts'); ?>
	<script src="<?php echo e(asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string')); ?>"></script>
	<script src="<?php echo e(asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/show.blade.php ENDPATH**/ ?>