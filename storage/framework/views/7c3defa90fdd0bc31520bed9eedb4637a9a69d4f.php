<?php echo $__env->make('backpack::base.inc.wallet_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body text-center border-bottom">
                    <img src="<?php echo e(get_image(config('constants.user.profile.path') .'/'. $user->img_profile)); ?>"
                         alt="profile-image" class="user-image">
                    <h5 class="card-title mt-3"><?php echo e($user->name); ?></h5>
                </div>
                <div class="card-body">
                    <p class="clearfix">
                        <span class="float-left">Username</span>
                        <span class="float-right font-weight-bold"><a
                                    href=""><?php echo e($user->name); ?></a></span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">E-mail</span>
                        <span class="float-right text-muted"><?php echo e($user->email); ?></span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">Phone</span>
                        <span class="float-right text-muted"><?php echo e($user->phone ?: 'Not available'); ?></span>
                    </p>

                    <p class="clearfix">
                        <span class="float-left">Status</span>
                        <span class="float-right text-muted">
                        <?php switch($user->active):
                                case (1): ?>
                                <span class="badge badge-pill badge-success">Active</span>
                                <?php break; ?>
                                <?php case (0): ?>
                                <span class="badge badge-pill badge-danger">Banned</span>
                                <?php break; ?>
                            <?php endswitch; ?>
                    </span>
                    </p>


                        <ul class="list-group">
                            <li class="list-group-item"><span class="float-left">USD</span>
                                <span class="float-right text-dark font-weight-bold">
                                    <?php echo e(formatter_money($user->balanceFloat)); ?>  </span>
                            </li>
                        </ul>


                </div>


            </div>

        </div>
        <div class="col-lg-9">
            <div class="card">

                <div class="row p-4">
                    <div class="col-lg-4">
                        <div class="card outline-success">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="mb-0 text-success"> <?php echo e(formatter_money($withdrawals)); ?></h4>
                                        <span class="text-success">Total Withdrawals</span>
                                    </div>
                                    <div class="align-self-center icon-lg">
                                        <i class="fa fa-money text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="text-white text-center">
                                <div class="card-footer btn btn-block btn-success">View All</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card outline-dark">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="mb-0 text-dark"> <?php echo e(formatter_money($deposits)); ?></h4>
                                        <span class="text-dark">Total Deposits</span>
                                    </div>
                                    <div class="align-self-center icon-lg">
                                        <i class="fa fa-money text-dark"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="text-white text-center">
                                <div class="card-footer btn btn-block btn-dark">View All</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card outline-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="mb-0 text-primary"><?php echo e($transactions); ?></h4>
                                        <span class="text-primary">Total Transactions</span>
                                    </div>
                                    <div class="align-self-center icon-lg">
                                        <i class="fa fa-exchange text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="text-white text-center">
                                <div class="card-footer btn-block btn btn-primary">View All</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <a class="text-white text-center btn-block" data-toggle="modal" href="#addSubModal">
                            <div class="card outline-primary">
                                <div class="card-body bg-primary">Add/Subtract Balance</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href=""
                           class="text-white text-center btn-block">
                            <div class="card  bg-success">
                                <div class="card-body">Login Logs</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href=""
                           class="text-white text-center btn-block">
                            <div class="card  bg-orange">
                                <div class="card-body">Send Email</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href=""
                           class="text-white text-center btn-block">
                            <div class="card  bg-blue">
                                <div class="card-body">Money Transfer</div>
                            </div>
                        </a>
                    </div>



                </div>

                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name"
                                           value="<?php echo e($user->first_name); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name"
                                           value="<?php echo e($user->last_name); ?>" required>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="<?php echo e($user->email); ?>"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" type="text" name="phone" value="<?php echo e($user->phone); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">


                      
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <p class="text-muted">Status</p>
                                <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                                       data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-on="Active" data-off="Banned" data-width="100%" name="status"
                                       <?php if($user->active): ?> checked <?php endif; ?>>
                            </div>






                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <input type="submit" class="btn btn-block btn-primary mt-2" value="Save Changes">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add / Subtract Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="success"
                                       data-offstyle="danger" data-toggle="toggle" data-on="Add Balance"
                                       data-off="Subtract Balance" name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label>Amount<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                           placeholder="Please provide positive amount">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="sendEmailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Subject<span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control" placeholder="Email Subject">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Message<span class="text-danger">*</span></label>
                                <textarea rows="5" name="message" class="form-control nicEdit"
                                          placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('after_scripts'); ?>
<?php echo $__env->make('backpack::base.inc.wallet_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .user-image {
            width: 200px;
            height: 200px;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/vendor/backpack/base/user_detail.blade.php ENDPATH**/ ?>