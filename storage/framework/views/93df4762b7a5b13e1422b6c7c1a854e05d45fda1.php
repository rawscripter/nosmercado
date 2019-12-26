<div class="modal fade" id="product_overview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"


     aria-hidden="true">


    <div id="modal" class="modal-dialog" role="document">


        <div class="modal-content">


            <div class="modal-header">


                <h5 class="modal-title text-center" id="exampleModalLabel">


                    <?php



                        $to = Carbon\Carbon::now();



                        $from = $post->created_at;



                        $diff_in_minutes = $to->diffInMinutes($from);



                        if ($diff_in_minutes == 1){

                            echo ($diff_in_minutes . " minuut pasa...");

                        }

                        elseif ($diff_in_minutes > 1 and $diff_in_minutes < 60 ) {

                            echo ($diff_in_minutes . " minuut pasa...");

                        }



                        elseif ($diff_in_minutes >= 60 and $diff_in_minutes < 120){

                            $hours = 1;

                            echo ($hours . " ora pasa...");

                        }

                        elseif ($diff_in_minutes >= 120 and $diff_in_minutes < 1440){

                            $hours = round($diff_in_minutes*0.0166667);

                            echo ($hours . " ora pasa...");

                        }



                        elseif ($diff_in_minutes >= 1440 and $diff_in_minutes < 2880){

                            $days = 1;

                            echo ($days . " dia pasa...");

                        }



                        else {

                            $days = round($diff_in_minutes*0.000694444);

                            echo ($days . " dia pasa..." );

                        }





                    ?>


                </h5> <!-- (#<?php echo e($post->id); ?>) <?php echo e($post->title); ?> #<?php echo e($post->id); ?> -->


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">


                    <span aria-hidden="true">&times;</span>


                </button>


            </div>


            <div class="modal-body">


                <div id="postImageSlider" class="carousel slide" data-ride="carousel">


                    <div class="carousel-inner">


                        <?php



                            $i= 1;



                        ?>



                        <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                            <div class="carousel-item <?php echo e($i == 1 ? 'active' : ''); ?>">


                                <img src="/post/images/<?php echo e($image->name); ?>" style="max-width: 100%" alt="images">


                            </div>



                            <?php



                                $i++;



                            ?>



                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>


                    <!-- Left and right controls -->


                    
                    <?php if($post->images->count() > 1): ?>
                        <a class="carousel-control-prev" href="#postImageSlider" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#postImageSlider" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    <?php endif; ?>

                </div>


                <div class="product_overview_content pb-3">


                    <br>
                    <p><?php echo e($post->description); ?></p>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                <h4 class="mb-0"><i class="fas fa-mobile-alt"></i> Afl. <?php echo e($post->price); ?> </h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php if(!empty($post->user_id)): ?>
                                <div class="m-3">
                                    <img style="max-width: 200px" src="<?php echo e($post->user->userLogo()); ?>" alt="">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            
                            <button data-product="<?php echo e($post->id); ?>" class="btn add-to-cart btn-primary text-white"><i
                                    class="fas fa-cart-plus "></i> <span class="cart-text">Add To Cart</span>
                            </button>
                        </div>
                    </div>


                    <?php if(!empty($post->link)): ?>

                        <div class="m-3">

                            <a href="<?php echo e($post->link); ?>" target="_blank" class="btn btn-primary"><?php echo e($post->link); ?></a>

                        </div>

                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($post->user_id === auth()->user()->id): ?>
                            <div>
                                <a href="<?php echo e(route('post.update.email.url',$post->uuid)); ?>"> <i
                                        class="fas fa-edit btn btn-primary editBtn"></i></a>

                                <a onClick="return confirm('Are you sure you want to delete the post?')"
                                   href="<?php echo e(route('confirm.delete.post',$post->uuid)); ?>"><i
                                        class="fas fa-trash-alt btn btn-danger dltBtn"></i></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>


</div>
<?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/site/post/post-modal.blade.php ENDPATH**/ ?>