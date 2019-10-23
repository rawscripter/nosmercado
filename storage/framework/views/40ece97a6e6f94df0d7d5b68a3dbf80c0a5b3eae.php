
<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <style>
        button.swal2-confirm.swal2-styled {
            color: #fff;
            background-color: #2b62d9;
            border-color: #2b62d9;
        }
    </style>
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


                        <h4 class="text-center">Crea advertencia nobo</h4>
                        
                        <form action="#" method="post" id="post_form"
                              enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <select required name="category_id" id="main_category" class="form-control rounded-0">
                                    <option selected disabled>Selecta tipo di servicio</option> 
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data="<?php echo e($category->subCategories); ?>"
                                                value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select required name="sub_category_id" id="sub_catagories"
                                        class="form-control rounded-0">
                                    <option selected disabled>Selecta categoria</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control rounded-0" id="title"
                                       placeholder="Titulo di e advertencia">
                            </div>
                            <div class="form-group">
                                <input type="number" step="0.01" name="price" class="form-control rounded-0" id="price"
                                       placeholder="Prijs den florin por ehempel 20.00 ">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control rounded-0" id="email"
                                       placeholder="E-mail adres (no ta visibel den e advertencia)">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control rounded-0" id="phone_no"
                                       placeholder="Number di contacto (ta visibel den e advertencia)">
                            </div>
                            <div class="form-group">
                                <textarea rows="5" name="description" class="form-control rounded-0" id="item_desc"
                                          placeholder="Describi e producto of servicio"></textarea>
                            </div>

                            <div class="form-group">
                                <div id="dropzone" class="dropzone"></div>
                            </div>
                            <div class="form_footer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>Atencion: tur advertencia lo keda visibel riba nosmercado.com pa 30 dia, si e
                                            no wordo kita di e persona cu a pone. Pa por update of delete e advertencia please wak den bo confirmation email.</p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <input type="submit" class="btn submitButton btn-primary rounded-0">
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

        $("#main_category").change(function () {
            let subCategory = JSON.parse($(this).find(':selected').attr('data'));
            let subHtml = "";
            subHtml += "<option disabled selected>Selecta sub-categoria</option>";
            subCategory.forEach(function (cat) {
                subHtml += `<option value='${cat.id}'>${cat.name}</option>`;
            });
            $("#sub_catagories").html(subHtml);
        });

        Dropzone.autoDiscover = false;
        Dropzone.prototype.defaultOptions.dictDefaultMessage = "Upload un of mas potret";

        $(document).ready(() => {
            const dropzones = []
            $('.dropzone').each(function (i, el) {
                const name = 'g_' + $(el).data('field')
                var myDropzone = new Dropzone(el, {
                    url: '<?php echo e(route('post.store')); ?>',
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 2,
                    paramName: name,
                    addRemoveLinks: true,
                })
                dropzones.push(myDropzone)
            })
            // document.querySelector("input[type=submit]").addEventListener("click", function (e) {
            // Make sure that the form isn't actually being sent.
            $('form').submit(function (e) {
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
                        var response = JSON.parse(data.responseText);
                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                        $.each(response.errors, function (key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';

                        $("#outputMsg").html(errorString).fadeIn();

                        $(".submitButton").val('Submit Again');
                        $(".submitButton").prop("disabled", false);
                    }
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coastaru/nosmercado.com/resources/views/site/post/create.blade.php ENDPATH**/ ?>