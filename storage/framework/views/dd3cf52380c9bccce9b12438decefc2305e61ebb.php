<?php echo $__env->make('backpack::base.inc.wallet_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
    $preventDeletes=[68,21,69,99,124,125];

?>
<?php $__env->startSection('content'); ?>
    <button type="button" data-target="#newModal" data-toggle="modal" class="btn btn-success"><i
                class="fa fa-fw fa-plus"></i>Add New
    </button>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Posted</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $howItWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td scope="row">

                                    <?php echo e($post->value->title); ?>

                                </td>
                                <td><?php echo e(\Carbon\Carbon::parse($post->created_at)->diffForHumans()); ?></td>
                                <td>
                                    <button type="button" class="btn btn-rounded btn-primary editBtn"
                                            data-title="<?php echo e($post->value->title); ?>"
                                            data-body="<?php echo e($post->value->body); ?>"
                                            data-slug="<?php echo e($post->value->slug); ?>"
                                            data-action="<?php echo e(route('admin.frontend.update', $post->id)); ?>">
                                        <i class="fa fa-edit"></i></button>
                                    <?php if(!in_array($post->id,$preventDeletes)): ?>
                                        <button class="btn btn-danger removeBtn" data-id="<?php echo e($post->id); ?>"><i
                                                    class="fa fa-trash"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <?php echo e($howItWorks->links()); ?>

                    </nav>
                </div>

            </div>
        </div>
    </div>
    
    <div id="newModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Social Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.frontend.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="company_policy">
                    <input type="hidden" name="slug" id="slug">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Policy Title</label>
                                        <input type="text" class="form-control" placeholder="Your Post Title"
                                               name="title"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Policy Content</label>
                                        <textarea rows="10" class="form-control nicEdit" placeholder="Post description"
                                                  name="body"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Social Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="company_policy">
                    <input type="hidden" name="slug" id="slug">
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Policy Title</label>
                                        <input type="text" class="form-control" placeholder="Your Post Title"
                                               name="title"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Policy Content</label>
                                        <textarea rows="10" class="form-control nicEdit" placeholder="Post description"
                                                  name="body"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blog Post Removal Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.frontend.remove')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Are you sure to remove this post?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Remove</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('after_styles'); ?>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-iconpicker.min.css')); ?>">
<?php $__env->stopPush(); ?>



<?php $__env->startPush('after_scripts'); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>

    <script>
        $('.removeBtn').on('click', function () {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.editBtn').on('click', function () {
            var modal = $('#editModal');
            modal.find('input[type=text], textarea').val($(this).data('body'));
            modal.find('input[name=title]').val($(this).data('title'));
            modal.find('#slug').val($(this).data('slug'));
            console.log("slug :"+$(this).data('slug'));
            modal.find('form').attr('action', $(this).data('action'));
            modal.modal('show');
        });

        $('#editModal').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });
        $('#newModal').on('shown.bs.modal', function (e) {
            $(document).off('focusin.modal');
        });

        $('.iconPicker').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 10,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: false,
            searchText: 'Search icon',
            selectedClass: 'btn-success',
            unselectedClass: ''
        }).on('change', function (e) {
            $(this).parent().siblings('input[name=icon]').val(`<i class="${e.icon}"></i>`);
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/frontend/company_policy.blade.php ENDPATH**/ ?>