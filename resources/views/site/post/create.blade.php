@extends('layout.master-layout')





@section('body')



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


                        @if( Session::has( 'success' ))



                            <br>



                            <div class="alert alert-success" role="alert">


                                {{ Session::get( 'success' ) }}


                            </div>



                            <br>



                        @endif


                        <div id="outputMsg">

                        </div>


                        <h4 class="text-center">Crea advertencia</h4>


                        <form action="#" method="post" id="post_form"


                              enctype="multipart/form-data">


                        {{csrf_field()}}



                        <!--



                            <div class="form-group">

                                <div class="toggle_radio d-flex justify-content-around">

                                    @php

                            $options = \App\Option::all();

                        @endphp

                        @foreach($options as $option)

                            <div class="check-box">

                                <input type="radio" name="option_id" value="{{$option->id}}">

                                            <label for="">{{$option->name}}</label>

                                        </div>

                                    @endforeach

                            </div>

                        </div>



-->


                            <!--

                            <div class="form-group">



                                <input type="text" maxlength="20" name="title" class="form-control rounded-0" id="title"



                                       placeholder="Titulo di e advertencia">



                            </div>

                            -->


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


                                    @foreach($categories as $category)



                                        <option value="{{$category->id}}">{{$category->name}}</option>



                                    @endforeach


                                </select>


                            </div>


                            <div class="form-group">



                                <textarea rows="3" name="description" class="form-control" id="item_desc"
                                          style="border-radius:5px;"


                                          placeholder="Describi e producto of servicio"></textarea>


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
                                       style="border-radius:5px; display: {{auth() && !empty(auth()->user()->phone) ? 'none' : ''}}"
                                       @auth()
                                       value="{{auth()->user()->phone}}"
                                       @endauth
                                       placeholder="Number di contacto (publico)">
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email"
                                       style="border-radius:5px; display: {{auth() && !empty(auth()->user()->email) ? 'none' : ''}}"
                                       @auth()
                                       value="{{auth()->user()->email}}"
                                       @endauth
                                       placeholder="E-mail adres (priva)">
                            </div>


                            <div class="form_footer">


                                <div class="row">


                                    <div class="col-md-8">


                                        <p>Atencion: pa por edit of delete e advertencia

                                            please wak den bo confirmation email.</p>


                                    </div>


                                    <div class="col-md-4 text-right">

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



@endsection







@section('footer')



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


                    url: '{{route('post.store')}}',


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


                    url: '{{route('post.store')}}',


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



@endsection
