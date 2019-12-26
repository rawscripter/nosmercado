<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Create New User
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.customers')); ?>">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Customer</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                <?php if(Session::has('message')): ?>
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <p class="alert alert-success"><?php echo e(Session::get('message')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-12 col-md-6 m-auto">
                        <form action="<?php echo e(route('admin.customer.store')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="collection">Name</label>
                                <input type="text" required name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="collection">Email</label>
                                <input type="email" required name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="collection">Password</label>
                                <input type="password" required name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="collection">Confirm Password</label>
                                <input type="password" required name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-info rounded-0"
                                       value="Add New Customer">
                            </div>
                        </form>
                    </div>
                </div>
                <?php if(isset($errors) && count($errors) > 0): ?>
                    <div class="row">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/admin/customers/create.blade.php ENDPATH**/ ?>