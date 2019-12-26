@extends('layout.master-layout')

@section('header')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">

@endsection

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

                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="postImage text-center ">
                                <img style="display:block;margin: 0 auto;max-width:100%;" src="{{$post->fistImage()}}" alt="{{$post->title}}">
                            </div>


                            <div class="post_page_option">

                                <h4 class="text-center">Bo kier delete e advertencia aki?</h4>

                                <br><br>

                                <div class="row">

                                    <div class="col-3 m-auto">
                                            
                                        <div class="text-center d-flex justify-content-center">
                                            <!--
                                            <a href="{{route('confirm.delete.post',$post->uuid)}}"
                                               class="btn btn-sm btn-danger rounded-0">Si</a>

                                            <a href="/" class="btn btn-sm btn-primary rounded-0">No</a>
                                            -->
                                            
                                            <a style="margin-right:15%;" href="{{route('confirm.delete.post',$post->uuid)}}"
                                               class="btn btn-danger">Si</a>

                                            <a style="margin-left:15%;" href="/" class="btn btn-outline-dark">No</a>


                                        </div>

                                    </div> <!-- col-3 -->

                                </div> <!-- row -->

                            </div> <!-- post page option -->

                        </div> <!-- card body -->

                    </div>  <!-- card mt5 -->

                </div>  <!-- colmd8 -->

            </div>  <!-- row -->

        </div> <!-- container -->

    </div>  <!-- main content -->

@endsection



@section('footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@endsection