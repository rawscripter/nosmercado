<div class="shorting-menu">
    <div class="container shorting-items d-flex flex-row-reverse">

        <form action="<?php echo e(route('filter.posts')); ?>">
            <select name="category" id="" onchange="this.form.submit()">

                <?php
                    if(isset($_GET['category']) && !empty($_GET['category'])){
                        if($_GET['category'] == 'tur-advertencia'){
                                $categoryName = 'Tur Advertencia';
                                $categorySlug = 'tur-advertencia';
                        }else{
                            $category = \App\Category::where('slug',$_GET['category'])->first();
                            $categoryName = $category->name;
                            $categorySlug = $category->slug;
                        }
                    }else{
                    $categoryName = 'Categoria';
                    $categorySlug = '';
                    }
                ?>

                <option value="<?php echo e($categorySlug); ?>"><?php echo e($categoryName); ?></option>
                <?php if(isset($categories)): ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>--}}
                    <option value="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="tur-advertencia">Tur advertencia</option>
                <?php endif; ?>
            </select>

            <?php
                if(isset($_GET['subcategory']) && !empty($_GET['subcategory'])){
                        $subCategory = \App\SubCategory::where('slug',$_GET['subcategory'])->first();
                        $subCategoryName = $subCategory->name;
                        $subCategorySlug = $subCategory->slug;
                }else{
                $subCategoryName = 'Sub Categoria';
                $subCategorySlug = '';
                }
            ?>
            <select name="subcategory" id="" onchange="this.form.submit()">
                <option value="<?php echo e($subCategorySlug); ?>"><?php echo e($subCategoryName); ?></option>
                <?php if(isset($filterSubCategory)): ?>
                    <?php $__currentLoopData = $filterSubCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>--}}
                    <option value="<?php echo e($subCategory->slug); ?>"><?php echo e($subCategory->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>

            <?php
                if(isset($_GET['short']) && !empty($_GET['short'])){
                    $short = $_GET['short'];
                    $short = str_replace('-',' ',$short);
                    $short = ucwords($short);
                }else{
                    $short = 'Sorteer';
                }
            ?>


            <select name="short" class="mr-0" id="" onchange="this.form.submit()">
                <option value=""><?php echo e($short); ?></option>
                <option value="newest">Mas nobo</option>
                <option value="oldest">Mas bieu</option>
                <option value="most-viewed">Mas mira</option>
                <option value="price-high-to-low">Mas caro</option>
                <option value="price-low-to-high">Mas barata</option>
            </select>
        </form>
    </div>
</div><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/layout/short.blade.php ENDPATH**/ ?>