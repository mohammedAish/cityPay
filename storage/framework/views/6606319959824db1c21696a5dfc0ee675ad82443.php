<?php echo $__env->make('backpack::base.inc.wallet_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.frontend.update', $post->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="title" value="<?php echo e(@$post->value->title); ?>" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Sub Title </label>
                                    <input type="text" class="form-control" placeholder="Write content" name="sub_title" value="<?php echo e(@$post->value->sub_title); ?>" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Details </label>
                                    <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="10"><?php echo e(@$post->value->details); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Web Footer </label>
                                    <textarea name="web_footer" class="form-control " placeholder="Write content"  rows="4"><?php echo e(@$post->value->web_footer); ?></textarea>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .user-image {
            width: 200px;
            height: 200px;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/frontend/homecontent.blade.php ENDPATH**/ ?>