<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>


    <div class="main_content">

        <div class="container">

            <div class="row">

                <div class="col-md-8 offset-md-2 col-lg-8 offset-md-2">

                    <div class="post_page_option">

                        <?php if( Session::has( 'success' )): ?>

                            <br>

                            <div class="alert alert-success" role="alert">

                                <?php echo e(Session::get( 'success' )); ?>


                            </div>

                            <br>

                        <?php endif; ?>

                        <div id="outputMsg">

                        </div>


                        <h4 class="text-center">Update Profile</h4>


                        <form action="<?php echo e(route('customer.profile.update',$user->id)); ?>" method="post"
                              id="post_update_form"
                              enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>



                            <div class="form-group">
                                <label for="">Logo:</label>
                                <input type="file" name="logo" class="dropify">
                                <div class="text-center">
                                    <img style="max-width: 100%" src="<?php echo e(auth()->user()->userLogo()); ?>" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Name:</label>
                                <input type="text" name="name"
                                       class="form-control rounded-0"
                                       value="<?php echo e($user->name); ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" name="email"
                                       class="form-control rounded-0"
                                       value="<?php echo e($user->email); ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Phone:</label>
                                <input type="text" name="phone"
                                       class="form-control rounded-0"
                                       value="<?php echo e($user->phone); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Address:</label>
                                <input type="text" name="address"
                                       class="form-control rounded-0"
                                       value="<?php echo e($user->address); ?>">
                            </div>

                            <div class="row">
                                <div class="col-12 mr-auto text-right">
                                    <input type="submit" class="btn submitButton btn-primary"
                                           value="Update">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(() => {
            $('.dropify').dropify();
            $('form#post_update_form').submit(function (e) {
                e.preventDefault();
                let form = new FormData($(this)[0]);
                let formUrl = $("#post_update_form").attr('action');
                $(".submitButton").val('Updating...');

                $.ajax({
                    method: 'POST',
                    url: formUrl,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire(
                            'Pabien!',
                            'Bo advertencia to online.',
                            'success',
                            "#000000"
                        );
                        $(".submitButton").val('Update');
                    },
                    error: function (data) {
                        Swal.fire(
                            'Oops!',
                            'Algo a bai malo, please purba atrobe.',
                            'error',
                            "#000000"
                        );

                        var response = JSON.parse(data.responseText);
                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                        $.each(response.errors, function (key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';
                        $("#outputMsg").html(errorString).fadeIn();
                        $(".submitButton").val('Try Again...');
                    }
                });
            });
        })

    </script>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/site/user/profile.blade.php ENDPATH**/ ?>