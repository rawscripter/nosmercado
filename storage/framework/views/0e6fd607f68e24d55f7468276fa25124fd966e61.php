<?php if(auth()->guard()->guest()): ?>
    <a href="/login"
       style="font-size:medium;margin-top: -.04rem !important;padding: 0.4rem .5rem !important;"
       class="btn btn-primary">
        <i style="margin-right: 5px;" class="fas fa-sign-in-alt"></i> <span class="hide-in-desktop">Login</span>
    </a>
<?php endif; ?>
<?php if(auth()->guard()->check()): ?>
    <div class="btn btn-primary">
        <div class="dropdown">
            <div class="dropdown-toggle" id="profileDropdown"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-alt"></i> <span class="hide-in-desktop"> <?php echo e(auth()->user()->name); ?></span>
            </div>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a href="<?php echo e(route('post.create')); ?>" class="dropdown-item">Create New
                    Post</a>
                <a href="<?php echo e(route('customer.posts')); ?>" class="dropdown-item">Posts</a>
                <a href="<?php echo e(route('customer.profile')); ?>" class="dropdown-item">Profile</a>
                <a onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                   class="dropdown-item">Logout</a>

                <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST"
                      style="display: none;">

                    <?php echo e(csrf_field()); ?>


                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/layout/inc/login-menu.blade.php ENDPATH**/ ?>