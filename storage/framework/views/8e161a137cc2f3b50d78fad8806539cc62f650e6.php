
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
                        <h2 class="text-center">Post Has Been Deleted.</h2>
                        <br> <br>
                        <div class="text-center">
                            <a href="/" class="btn btn-primary">Go Back To Home</a>
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
<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coastaru/nosmercado.com/resources/views/site/post/successfully-deleted.blade.php ENDPATH**/ ?>