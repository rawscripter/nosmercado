<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">

        <div class="page-header">

            <h3 class="page-title">

                Customers table

            </h3>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Customers</li>
                </ol>
            </nav>
        </div>

        <div class="card">

            <div class="card-body">
                <?php if(Session::has('message')): ?>
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <p class="alert alert-success"><?php echo e(Session::get('message')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <div class="col-12">
                        <div class="create-btn text-right">
                            <a href="<?php echo e(route('admin.customer.create')); ?>"
                               class="btn btn-primary">Add New Customer</a><br>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <div id="order-listing_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table class="table  no-footer" role="grid"
                                   aria-describedby="order-listing_info">
                                <thead>
                                <tr role="row">
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Added At</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($customers->count() > 0): ?>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($customer->id); ?></td>
                                            <td><?php echo e($customer->name); ?></td>
                                            <td><?php echo e($customer->email); ?></td>
                                            <td><?php echo e($customer->role); ?></td>
                                            <td><?php echo e($customer->created_at->format('m-d-Y H:s:i')); ?></td>
                                            <td><a href="<?php echo e(route('admin.login.as.customer',$customer->id)); ?>"
                                                   class="btn btn-primary">Login </a></td>
                                            <td>
                                                <form method="POST"
                                                      action="<?php echo e(route('admin.customer.destroy',$customer->id)); ?>">
                                                    <?php echo e(csrf_field()); ?>

                                                    <?php echo e(method_field('DELETE')); ?>

                                                    <input
                                                        onClick="return confirm('Are you sure you want to delete the User?')"
                                                        type="submit" class="btn rounded-0 btn-danger"
                                                        value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo e($customers->links()); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>