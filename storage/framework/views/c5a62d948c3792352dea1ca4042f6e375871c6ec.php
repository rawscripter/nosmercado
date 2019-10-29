<?php $__env->startSection('content'); ?>

    <style>
        .card.card-statistics {
            background: linear-gradient(85deg, #06b76b, #f5a623);
            color: #ffffff;
        }
    </style>
    <div class="main-panel" style="width: 100% !important;">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Dashboards
                </h3>
            </div>
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fab fa-trello menu-icon mr-2"></i>
                                        Total Posts
                                    </p>
                                    <h2><?php echo e($totalPosts); ?></h2>
                                </div>
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fab fa-wpforms menu-icon mr-2"></i>
                                        Active Posts
                                    </p>
                                    <h2><?php echo e($activePosts); ?></h2>

                                </div>
                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                                        Total Visitors
                                    </p>
                                    <h2><?php echo e($totalVisitors); ?></h2>

                                </div>

                                <div class="statistics-item">
                                    <p>
                                        <i class="icon-sm fas fa-users mr-2"></i>
                                        Total Clicks
                                    </p>
                                    <h2><?php echo e($totalClicks); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/home.blade.php ENDPATH**/ ?>