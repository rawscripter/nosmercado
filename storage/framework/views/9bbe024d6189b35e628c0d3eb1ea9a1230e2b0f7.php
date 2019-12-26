<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Posts table
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                <?php if(Session::has('success')): ?>
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <p class="alert alert-success"><?php echo e(Session::get('success')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <div class="col-12">
                        <div class="create-btn text-right">
                            <a href="<?php echo e(route('post.create')); ?>"
                               class="btn btn-primary">Add New Post</a><br>
                        </div>
                    </div>
                    <div class="col-12 mt-5">

                        <div id="order-listing_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table class="table  no-footer" role="grid"
                                   aria-describedby="order-listing_info">
                                <thead>
                                <tr role="row">
                                    <th>Post Id</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Phone</th>
                                    <th>Custom Link</th>
                                    <th>Posted At</th>
                                    <th>Expire Date</th>
                                    <th>Archive</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if($posts->count() > 0): ?>
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($post->id); ?></td>
                                            <td><?php echo e($post->category->name); ?></td>
                                            <td><?php echo e($post->title); ?></td>
                                            <td><?php echo e($post->price); ?></td>
                                            <td><?php echo e($post->phone); ?></td>
                                            <td><?php echo e($post->link); ?></td>
                                            <td><?php echo e($post->created_at->format('m-d-Y H:s:i')); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($post->expire_date)->format('m-d-Y H:s:i')); ?></td>
                                            <td>
                                                <?php if($post->status == 1): ?>
                                                    <a href="<?php echo e(route('admin.post.archive',$post->id)); ?>"
                                                       class="badge rounded-0 badge-warning">Archive Post</a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('admin.post.active',$post->id)); ?>"
                                                       class="badge rounded-0 badge-success">Active Post</a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                      action="<?php echo e(route('admin.post.destroy',$post->id)); ?>">
                                                    <?php echo e(csrf_field()); ?>
                                                    <?php echo e(method_field('DELETE')); ?>
                                                    <input onClick="return confirm('Are you sure you want to delete the Post?')"
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

                <?php echo e($posts->links()); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/admin/post/index.blade.php ENDPATH**/ ?>