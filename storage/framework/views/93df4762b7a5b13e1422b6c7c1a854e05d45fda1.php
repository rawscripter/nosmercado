<div class="modal fade" id="product_overview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div id="modal" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    

                    <?php echo e($post->title); ?> #<?php echo e($post->id); ?>

                </h5>
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

                    <?php if(!empty($post->user_id)): ?>
                        <?php if(!empty($post->user->userLogo())): ?>
                            <div class="d-flex justify-content-around mb-5">
                                <img style="max-width: 120px; margin: 0 auto" src="<?php echo e($post->user->userLogo()); ?>" alt="">
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="d-flex justify-content-around">
                        <div>
                            <h4 class="mb-3 "><i class="fas fa-mobile-alt"></i> Afl. <?php echo e($post->price); ?> </h4>
                        </div>
                        <div class="">
                            <button data-product="<?php echo e($post->id); ?>" class="btn add-to-cart btn-primary text-white"><i
                                    class="fas fa-cart-plus "></i> <span class="cart-text">Add To Cart</span>
                            </button>
                        </div>
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