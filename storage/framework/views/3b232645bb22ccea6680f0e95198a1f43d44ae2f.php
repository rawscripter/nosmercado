<div class="cart <?php echo e($cartClass); ?>">
    <a href="/cart">
        <i class="fa" style="font-size:24px">&#xf07a;</i>
        <span class='badge badge-success cart-counter' id='lblCartCount'>
                    <?php if(session('cart')): ?>
                <?php echo e(count(session('cart'))); ?>

            <?php else: ?>
                <?php echo e('0'); ?>

            <?php endif; ?>
                </span>
    </a>
</div>
<?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/layout/inc/cart.blade.php ENDPATH**/ ?>