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


                        <?php if( Session::has( 'success' )): ?>



                            <br>



                            <div class="alert alert-success" role="alert">


                                <?php echo e(Session::get( 'success' )); ?>



                            </div>



                            <br>



                        <?php endif; ?>


                        <div id="outputMsg">

                        </div>


                        <h4 class="text-center">Create New Post</h4>


                        <form action="#" method="post" id="post_form"


                              enctype="multipart/form-data">


                        <?php echo e(csrf_field()); ?>




                        <!--



                            <div class="form-group">

                                <div class="toggle_radio d-flex justify-content-around">

                                    <?php

                            $options = \App\Option::all();

                        ?>

                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="check-box">

                                <input type="radio" name="option_id" value="<?php echo e($option->id); ?>">

                                            <label for=""><?php echo e($option->name); ?></label>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
-->
                            <div class="form-group">
                                <input type="text" required maxlength="20" name="title" class="form-control rounded-0"
                                       id="title"
                                       placeholder="Titulo">
                            </div>

                            <!-- -->


                            <!-- image that is dropped is automatically categorized -->

                            <div class="form-group">


                                <div id="dropzone" class="dropzone"
                                     style="border: 2px dashed #0087F7;border-radius: 5px;background: white;">

                                    <img src="/public/images/img.png"
                                         style="width:20%;margin-left:40%;margin-right:40%;">

                                </div>


                            </div>


                            <div class="form-group">


                                <select name="category_id" id="main_category" class="form-control"
                                        style="border-radius:5px;">


                                    <option selected disabled>Selecta categoria</option>


                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>



                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </select>


                            </div>


                            <div class="form-group">



                                <textarea rows="3" name="description" class="form-control" id="item_desc"
                                          style="border-radius:5px;"


                                          placeholder="Describi e producto"></textarea>


                            </div>
                            <div class="form-group">
                                <input type="text" pattern="\d*(\.\d+)?" maxlength="7" name="price" class="form-control"
                                       id="price" style="border-radius:5px;"
                                       placeholder="Prijs den florin por ehempel 20.00 ">
                            </div>


                            <!--

                            <div class="form-group">



                                <input type="url" name="link" class="form-control rounded-0"



                                       placeholder="Website/Facebook">



                            </div>

                            -->


                            <div class="form-group">


                                <input type="text" name="phone" class="form-control" id="phone_no"
                                       style="border-radius:5px; display: <?php echo e(auth() && !empty(auth()->user()->phone) ? 'none' : ''); ?>"
                                       <?php if(auth()->guard()->check()): ?>
                                       value="<?php echo e(auth()->user()->phone); ?>"
                                       <?php endif; ?>
                                       placeholder="Number di contacto (publico)">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email"
                                       style="border-radius:5px; display: <?php echo e(auth() && !empty(auth()->user()->email) ? 'none' : ''); ?>"
                                       <?php if(auth()->guard()->check()): ?>
                                       value="<?php echo e(auth()->user()->email); ?>"
                                       <?php endif; ?>
                                       placeholder="E-mail adres (priva)">
                            </div>


                            <div class="form_footer">


                                <div class="row">


                                    <div class="col-md-12 text-right">

                                        <input type="submit" class="btn submitButton btn-primary">

                                    </div>


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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>







    <script>

        Dropzone.autoDiscover = false;

        Dropzone.maxFilesize = 20;


        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Click of drop bo potret aki pa upload.";


        $(document).ready(() => {


            const dropzones = []


            $('.dropzone').each(function (i, el) {


                const name = 'g_' + $(el).data('field')


                var myDropzone = new Dropzone(el, {


                    url: '<?php echo e(route('post.store')); ?>',


                    autoProcessQueue: false,


                    uploadMultiple: true,


                    parallelUploads: 5,


                    maxFiles: 5,


                    paramName: name,


                    addRemoveLinks: true,


                })


                dropzones.push(myDropzone)


            })


            // document.querySelector("input[type=submit]").addEventListener("click", function (e) {


            // Make sure that the form isn't actually being sent.


            $('form#post_form').submit(function (e) {


                e.preventDefault();


                let form = new FormData($(this)[0]);


                dropzones.forEach(dropzone => {


                    let {paramName} = dropzone.options


                    dropzone.files.forEach((file, i) => {


                        form.append(paramName + '[' + i + ']', file)


                    })


                });


                $(".submitButton").val('Publicando...');


                $(".submitButton").prop("disabled", true);


                $.ajax({


                    method: 'POST',


                    url: '<?php echo e(route('post.store')); ?>',


                    data: form,


                    processData: false,


                    contentType: false,


                    success: function (response) {


                        var data = JSON.parse(response);


                        Swal.fire(
                            'Pabien!',


                            'Bo advertencia to online.',


                            'success',


                            "#000000"
                        ).then((res) => {


                            window.location.href = data.url;


                        });


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


                        $(".submitButton").val('Purba atrobe');


                        $(".submitButton").prop("disabled", false);


                    }


                });


            });


        })


    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/site/post/create.blade.php ENDPATH**/ ?>