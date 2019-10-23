<div class="modal fade" id="product_overview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div id="modal" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><?php echo e($post->title); ?> (#<?php echo e($post->id); ?>)</h5>
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
                    <a class="carousel-control-prev" href="#postImageSlider" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#postImageSlider" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>


                <div class="product_overview_content pl-3">
                    <br>
                    <p><?php echo e($post->description); ?></p>
                    <br>
                        <h4> 
                            <div style="float:left;width:50%;">
                                <?php echo e($post->price); ?> florin
                            </div>
                            <div style="float:left;width:50%;">
                                <i class="fas fa-mobile-alt"></i>
                                <?php echo e($post->phone); ?>
                            </div>
                      </h4>
                    <br> 
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/coastaru/nosmercado.com/resources/views/site/post/post-modal.blade.php ENDPATH**/ ?>