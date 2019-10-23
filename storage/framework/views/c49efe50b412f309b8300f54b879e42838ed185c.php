
<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <style>
        div#up_images img {
            padding: 10px;
        }
    </style>
    <div class="main_content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-lg-8 offset-md-2">
                    <div class="post_page_option">
                        <h4 class="text-center">Are you Sure You Want to Delete the Post?</h4>
                        <br><br>
                        <div class="row">
                            <div class="col-6 m-auto">
                                <div class="text-center d-flex justify-content-around">
                                    <a href="<?php echo e($confirmDeleteUrl); ?>" class="btn btn-sm btn-danger">Confirm</a>
                                    <a href="/" class="btn btn-sm btn-primary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coastaru/nosmercado.com/resources/views/site/post/delete.blade.php ENDPATH**/ ?>