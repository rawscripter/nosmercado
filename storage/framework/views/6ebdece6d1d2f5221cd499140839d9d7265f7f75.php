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
                        <?php if( Session::has( 'success' )): ?>
                            <br>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(Session::get( 'success' )); ?>
                            </div>
                            <br>
                        <?php endif; ?>
                        <div id="outputMsg">
                        </div>

                        <h4 class="text-center">Edit bo advertencia</h4>

                        <form action="<?php echo e(route('post.update',$post->uuid)); ?>" method="post" id="post_update_form"

                            enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>
                    
                            <div class="form-group">
                                <!-- <p>Potretnan</p> -->
                                <div class="row">
                                    <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3 col-6 mt-2">
                                            <div class="post-image">
                                                <img src="/post/images/thumb/<?php echo e($image->name); ?>" class="di" width="100%"
                                                     alt="images">
                                                <div class="text-white removePostImage bg-danger mt-2 text-center"
                                                     data-image="<?php echo e($image->id); ?>">Delete
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="removedImages"></div>
                            
                            <div class="form-group">
                                
                                <div id="dropzone" class="dropzone" style="border: 2px dashed #0087F7;border-radius: 5px;background: white;">
                                    <img src="/public/images/img.png" style="width:20%;margin-left:40%;margin-right:40%;">
                                </div>

                            </div>

                            <div class="form-group">

                                <select  name="category_id" id="main_category" class="form-control rounded-0">
                                    <?php
                                        $categories = \App\Category::orderBy('name','asc')->get();
                                    ?>

                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $post->category->id ? 'selected' :''); ?>><?php echo e($category->name); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>

                            </div>

                            <!--
                            <div class="form-group">

                                <input  type="text" maxlength="20" name="title" class="form-control rounded-0" id="title"
                                       value="<?php echo e($post->title); ?>"
                                       placeholder="Titulo di e advertencia">
                            </div>
                            -->

                            <div class="form-group">

                                <input   type="text" pattern="\d*(\.\d+)?" maxlength="7" name="price" class="form-control rounded-0" id="price"
                                       value="<?php echo e($post->price); ?>"
                                       placeholder="Prijs den florin por ehempel 20.00 ">

                            </div>

                            <div class="form-group">

                                <input  type="email" name="email" class="form-control rounded-0" id="email"
                                       value="<?php echo e($post->email); ?>"
                                       placeholder="E-mail adres (no ta visibel den e advertencia)">

                            </div>

                            <!--

                            <div class="form-group">

                                <input type="url" name="link" class="form-control rounded-0"
                                       value="<?php echo e($post->link); ?>"
                                       placeholder="Website Url">

                            </div>

                            -->

                            <div class="form-group">

                                <input type="text" name="phone" class="form-control rounded-0" id="phone_no"
                                       value="<?php echo e($post->phone); ?>"
                                       placeholder="Number di contacto (ta visibel den e advertencia)">

                            </div>

                            <div class="form-group">

                                <textarea rows="3" name="description" class="form-control rounded-0" id="item_desc"
                                          placeholder="Describi e producto of servicio"><?php echo e($post->description); ?></textarea>

                            </div>


                            <div class="form_footer">

                                <div class="row">

                                    <div class="col-md-8">

                                        <p>Atencion: tur advertencia lo keda visibel riba nosmercado.com pa 30 dia, si e
                                            no wordo kita door di e persona cu a pone. Pa por update of delete e advertencia
                                            please wak den bo confirmation email.</p>

                                    </div>

                                    <div class="col-md-4 text-right">
                                        <input type="submit" class="btn submitButton btn-primary"
                                               value="Update">
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
        Dropzone.maxFilesize = 5;

        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Maximo 5 potret";


        $(document).ready(() => {

            const dropzones = []

            $('.dropzone').each(function (i, el) {

                const name = 'g_' + $(el).data('field')

                var myDropzone = new Dropzone(el, {

                    url: '<?php echo e(route('post.store')); ?>',

                    autoProcessQueue: true,

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

            $('form#post_update_form').submit(function (e) {

                e.preventDefault();

                let form = new FormData($(this)[0]);

                dropzones.forEach(dropzone => {

                    let {paramName} = dropzone.options

                    dropzone.files.forEach((file, i) => {

                        form.append(paramName + '[' + i + ']', file)

                    })

                });

                $(".submitButton").val('Publicando...');

                //$(".submitButton").prop("disabled", true);

                $.ajax({

                    method: 'POST',

                    url: '<?php echo e(route('post.update',$post->id)); ?>',

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

        $(document).ready(function () {
            $(".removePostImage").click(function () {
                let clickedButton = $(this);

                let postImageID = clickedButton.data('image');
                let removePostImageInput = `<input type="hidden" name="removedImage[]" value="${postImageID}">`;
                $(".removedImages").append(removePostImageInput);
                clickedButton.parent().parent().hide();
            })
        })

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fiverr\nosmercado\resources\views/site/post/edit.blade.php ENDPATH**/ ?>