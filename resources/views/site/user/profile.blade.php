@extends('layout.master-layout')
@section('header')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('body')


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


                        <h4 class="text-center">Update Profile</h4>


                        <form action="{{route('customer.profile.update',$user->id)}}" method="post"
                              id="post_update_form"
                              enctype="multipart/form-data">
                            {{csrf_field()}}


                            <div class="form-group">
                                <label for="">Logo:</label>
                                <input type="file" name="logo" class="dropify">
                                <div class="text-center">
                                    <img src="{{auth()->user()->userLogo()}}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Name:</label>
                                <input type="text" name="name"
                                       class="form-control rounded-0"
                                       value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="text" name="email"
                                       class="form-control rounded-0"
                                       value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="">Phone:</label>
                                <input type="text" name="phone"
                                       class="form-control rounded-0"
                                       value="{{$user->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="">Address:</label>
                                <input type="text" name="address"
                                       class="form-control rounded-0"
                                       value="{{$user->address}}">
                            </div>

                            <div class="row">
                                <div class="col-12 mr-auto text-right">
                                    <input type="submit" class="btn submitButton btn-primary"
                                           value="Update">
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
    <script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(() => {
            $('.dropify').dropify();
            $('form#post_update_form').submit(function (e) {
                e.preventDefault();
                let form = new FormData($(this)[0]);
                let formUrl = $("#post_update_form").attr('action');
                $(".submitButton").val('Updating...');

                $.ajax({
                    method: 'POST',
                    url: formUrl,
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire(
                            'Pabien!',
                            'Bo advertencia to online.',
                            'success',
                            "#000000"
                        );
                        $(".submitButton").val('Update');
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
                        $(".submitButton").val('Try Again...');
                    }
                });
            });
        })

    </script>



@endsection



