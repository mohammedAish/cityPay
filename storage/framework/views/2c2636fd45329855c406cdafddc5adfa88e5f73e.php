<?php echo $__env->make('backpack::base.inc.wallet_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('content'); ?>
    <button type="button" data-target="#newModal" data-toggle="modal" class="btn btn-success"><i
                class="fa fa-fw fa-plus"></i>Add New
    </button>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.frontend.update', $caption->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" placeholder="Member Name" name="title"
                                           value="<?php echo e(@$caption->value->title); ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label>Short Details</label>
                                    <input type="text" class="form-control" placeholder="Member Designation"
                                           name="short_details" value="<?php echo e(@$caption->value->short_details); ?>" required/>
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


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__empty_1 = true; $__currentLoopData = $howItWorks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <a href="#"
                                           class="avatar avatar-sm rounded-circle mr-3">
                                            <img src="<?php echo e(get_image(config('constants.frontend.team.path') .'/'. $post->value->image)); ?>"
                                                 alt="image">
                                        </a>
                                        <div class="media-body">
                                            <a href="#"><span
                                                        class="name mb-0"><?php echo e($post->value->name); ?></span></a>
                                        </div>

                                    </div>
                                </td>
                                <td><?php echo e($post->value->designation); ?></td>
                                <td><?php echo e(diffForHumans($post->created_at)); ?></td>
                                <td>
                                    <button type="button" class="btn btn-rounded btn-primary editBtn"
                                            data-name="<?php echo e($post->value->name); ?>"
                                            data-designation="<?php echo e($post->value->designation); ?>"
                                            data-facebook="<?php echo e($post->value->facebook); ?>"
                                            data-twitter="<?php echo e($post->value->twitter); ?>"
                                            data-linkedin="<?php echo e($post->value->linkedin); ?>"
                                            data-action="<?php echo e(route('admin.frontend.update', $post->id)); ?>">
                                        <i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger removeBtn" data-id="<?php echo e($post->id); ?>"><i
                                                class="fa fa-trash"></i></button>
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
                    <h5 class="modal-title">New </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.frontend.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="team">
                    <input type="hidden" name="has_image" value="1">
                    <div class="modal-body">
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview"
                                                 style="background-image: url(<?php echo e(get_image(config('constants.frontend.team.path') .'/'. $post->value->image)); ?>)">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image_input"
                                                   id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload1" class="bg-primary">Post image</label>
                                            <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image
                                                will be resized into
                                                <b><?php echo e(Config::get('constants.frontend.team.size')); ?>px</b> </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Name</label>
                                <input type="text" class="form-control" placeholder="Member Name" name="name"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label>Member Designation</label>
                                <input type="text" class="form-control" placeholder="Member Designation"
                                       name="designation" required/>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link</label>
                                <input type="url" class="form-control" placeholder="Facebook Link" name="facebook"
                                />
                            </div>
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="url" class="form-control" placeholder="Twitter Link" name="twitter"
                                />
                            </div>
                            <div class="form-group">
                                <label>Linkedin Link</label>
                                <input type="url" class="form-control" placeholder="Linkedin Link" name="linkedin"
                                />
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
                    <input type="hidden" name="key" value="team">
                    <div class="modal-body">
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview"
                                                 style="background-image: url(<?php echo e(get_image(config('constants.frontend.team.path') .'/'. $post->value->image)); ?>)">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image_input"
                                                   id="profilePicUpload2" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload2" class="bg-primary">Post image</label>
                                            <small class="mt-2 text-facebook">Supported files: <b>jpeg, jpg</b>. Image
                                                will be resized into
                                                <b><?php echo e(Config::get('constants.frontend.team.size')); ?>px</b> </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Member Name</label>
                                <input type="text" class="form-control" placeholder="Member Name" name="name"
                                       value="<?php echo e(@$post->value->name); ?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Member Designation</label>
                                <input type="text" class="form-control" placeholder="Member Designation"
                                       name="designation" value="<?php echo e(@$post->value->designation); ?>" required/>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link</label>
                                <input type="url" class="form-control" placeholder="Facebook Link" name="facebook"
                                       value="<?php echo e(@$post->value->facebook); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="url" class="form-control" placeholder="Twitter Link" name="twitter"
                                       value="<?php echo e(@$post->value->twitter); ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Linkedin Link</label>
                                <input type="url" class="form-control" placeholder="Linkedin Link" name="linkedin"
                                       value="<?php echo e(@$post->value->linkedin); ?>"/>
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
                    <h5 class="modal-title"> Removal Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.frontend.remove')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Are you sure to remove this ?</p>
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
    <?php echo $__env->make('backpack::base.inc.wallet_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>

    <script>
        $('.removeBtn').on('click', function () {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.editBtn').on('click', function () {
            var modal = $('#editModal');
            loadJS();
            modal.find('input[name=author]').val($(this).data('author'));
            modal.find('input[name=designation]').val($(this).data('designation'));
            modal.find('input[name=quote]').val($(this).data('quote'));
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

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/frontend/team.blade.php ENDPATH**/ ?>