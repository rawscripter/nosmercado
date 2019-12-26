<?php $__env->startSection('body'); ?>

    <div class="main_content">

        <!-- shorting option markup -->

        <div class="bg-white rounded-0 mt-0">


            <div class="shorting_area">


                <div class="row">


                    <div class="col-md-12">


                        <div class="container">


                            <div class="shorting-menu">

                                <div class="scrollmenu">

                                    <a href="<?php echo e(route('all.category.products')); ?>">Tur Advertencia</a>


                                    <?php

                                        $categories = \App\Category::orderBy('name','asc')->get();

                                    ?>



                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <a href="<?php echo e(route('category.products',$category->slug)); ?>"><?php echo e($category->name); ?></a>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </div>


                                <ul class="short-ul d-flex justify-content-between">

                                <!--

                                    <li>



                                        <a href="#">



                                            <?php



                                    if(isset($shortCategory)){
                                            echo $shortCategory->name;

                                    }elseif (isset($selectedCategory)){
                                            echo $selectedCategory ;
                                    }else{
                                            echo 'Categoria';
                                    }



                                ?>


                                    <i



                                                    class="fas fa-angle-down"></i><i



                                                    class="fas fa-angle-up cat_up"></i></a>



                            <ul class="left-on-desktop custom-scrollbar shorting_dropdown_menu">



                                    <li><a href="<?php echo e(route('all.category.products')); ?>">Tur Advertencia</a></li>



                                            <?php

                                    $categories = \App\Category::orderBy('name','asc')->get();

                                ?>



                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                    <li>



                                            <a href="<?php echo e(route('category.products',$category->slug)); ?>"><?php echo e($category->name); ?>


                                        (<?php echo e(count($category->posts)); ?>)</a>



                                                </li>



                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </ul>



                            </li>

-->


                                <!--

                                    <li class="short-li"><a href="#"><span

                                                    disable></span> <questionmark php echo e(isset($_GET['short']) ? str_replace('-', ' ', ucfirst($_GET['short'])) : 'Sortia'); ?>

                                            <i

                                                    class="fas fa-angle-down"></i><i



                                                    class="fas fa-angle-up short_up"></i></a>

                                        <ul>

                                            <?php

                                    $previousGetReq = isset($_GET['query'])? 'query=' . $_GET['query'] . '&' : '';

                                ?>

                                    <li>

                                            <a href="?<?php echo e($previousGetReq); ?>short=mas-nobo">Mas nobo </a>

                                            </li>

                                            <li><a href="?<?php echo e($previousGetReq); ?>short=mas-bieu">Mas bieu </a></li>

                                            <li><a href="?<?php echo e($previousGetReq); ?>short=mas-mira">Mas mira </a></li>

                                            <li><a href="?<?php echo e($previousGetReq); ?>short=mas-caro">Mas caro </a></li>

                                            <li><a href="?<?php echo e($previousGetReq); ?>short=mas-barata">Mas barata </a>

                                            </li>

                                        </ul>

                                    </li>

                                    -->

                                </ul>


                            </div>


                        </div>


                    </div>


                </div>


            </div>


        </div>


    <!--

        <div class="container">

        <a href="<?php echo e(route('post.create')); ?>"><img style="max-width:100%;margin-bottom:1px;margin-left:1px;margin-right:1px;" src="images/headline_1.png"></a>

        </div>

        -->


        <div class="infinite-scroll">

            <!--end shorting option markup -->

            <div class="container">


                <div class="col-md-12 col-lg-12">


                    <?php if($posts->count() > 0): ?>

                        <div class="home_page_product d-flex">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product_single view_product_details">
                                    <img src="<?php echo e($post->fistImage()); ?>">
                                    <div class="product_single_shadow">
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if($post->user_id === auth()->user()->id): ?>
                                                <div class="hide-in-desktop">
                                                    <a href="<?php echo e(route('post.update.email.url',$post->uuid)); ?>"> <i
                                                            class="fas fa-edit btn btn-primary editBtn"></i></a>

                                                    <a onClick="return confirm('Are you sure you want to delete the post?')"
                                                       href="<?php echo e(route('confirm.delete.post',$post->uuid)); ?>"><i
                                                            class="fas fa-trash-alt btn btn-danger dltBtn"></i></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <p class="view_product_details post-details-ajax-request"
                                           data-id="<?php echo e($post->id); ?>">
                                            <i
                                                class="fas fa-eye"></i><?php echo e($post->clicks); ?> <span
                                                class="hide-in-desktop"><br>Details</span></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    <?php else: ?>

                        <div class="text-center mt-5">

                            <div class="card">

                                <div class="card-body">

                                    <h1 class="text-danger no-post">No tin advertencia</h1>

                                </div>

                            </div>

                        </div>

                    <?php endif; ?>


                </div>


            </div>


            <div class="paginatio">
                <div class="m-auto">
                    <?php if($posts->links()): ?>
                        <?php if(isset($_GET['short'])): ?>
                            <?php echo e($posts->appends(['short' => $_GET['short']])->links()); ?>

                        <?php else: ?>
                            <?php echo e($posts->links()); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>











    <div id="outputModal"></div>



<?php $__env->stopSection(); ?>







<?php $__env->startSection('footer'); ?>



    <script src="<?php echo e(asset('js/jsscroll.js')); ?>"></script>

    <script type="text/javascript">

        $('ul.pagination').hide();

        $(function () {

            $('.infinite-scroll').jscroll({

                autoTrigger: true,

                

                padding: 0,

                nextSelector: '.pagination li.active + li a',

                contentSelector: 'div.infinite-scroll',

                callback: function () {

                    $('ul.pagination').remove();

                }

            });

        });

    </script>





    <script>
        $(document).ready(function () {
            $(document).on('click', '.view_product_details.post-details-ajax-request', function () {
                    let item = $(this).data('id');

                    $.get(`/post/${item}/details`, function (data, status) {
                        $("#outputModal").html(data);
                        $("#product_overview_modal").modal('show');
                        let owl = $(".owl-carousel");
                        owl.owlCarousel({
                            items: 1,
                        });
                    });

                }
            )
            ;
            $(document).on('click', '.add-to-cart', function () {
                let product = $(this).data('product');
                let button = $(this);

                $.get(`/cart/${product}/add`, function (data, status) {
                    let res = JSON.parse(data);
                    if (res.status === 'success') {
                        button.removeClass('btn-primary');
                        button.removeClass('add-to-cart');
                        button.addClass('btn-success');
                        button.find('.cart-text').text('Added to Cart');

                        if (res.action === 'added') {
                            let cart = $(".cart-counter");
                            let old_count = cart.text();
                            let new_count = parseInt(old_count) + 1;
                            cart.html(new_count);

                        }
                    }
                });


            });


        });


    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/site/index.blade.php ENDPATH**/ ?>