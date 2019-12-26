@extends('layout.master-layout')



@section('body')



    <style>

        div.scrollmenu {

            background-color: white;

            overflow: auto;

            white-space: nowrap;

            padding: 15px;

            margin-left: -15px;

            margin-top: -10px;

        }


        div.scrollmenu a {

            display: inline-block;

            color: #2B62D9;

            text-align: center;

            padding: 5px;

            text-decoration: none;

            border-radius: 5px;

            font-weight: 700;

            border: 1px solid #2B62D9;

            font-size: 0.8rem;

        }


        div.scrollmenu a:hover {

            /* background-color: #777; */

        }


    </style>



    <div class="main_content">

        <!-- shorting option markup -->

        <div class="bg-white rounded-0 mt-0">


            <div class="shorting_area">


                <div class="row">


                    <div class="col-md-12">


                        <div class="container">


                            <div class="shorting-menu">

                                <div class="scrollmenu">

                                    <a href="{{route('all.category.products')}}">Tur Advertencia</a>


                                    @php

                                        $categories = \App\Category::orderBy('name','asc')->get();

                                    @endphp



                                    @foreach($categories as $category)

                                        <a href="{{route('category.products',$category->slug)}}">{{$category->name}}</a>

                                    @endforeach


                                </div>


                                <ul class="short-ul d-flex justify-content-between">

                                <!--

                                    <li>



                                        <a href="#">



                                            @php



                                    if(isset($shortCategory)){
                                        echo $shortCategory->name;

                                    }elseif (isset($selectedCategory)){
                                        echo $selectedCategory ;
                                    }else{
                                        echo 'Categoria';
                                    }



                                @endphp


                                    <i



                                            class="fas fa-angle-down"></i><i



                                            class="fas fa-angle-up cat_up"></i></a>



                                <ul class="left-on-desktop custom-scrollbar shorting_dropdown_menu">



                                    <li><a href="{{route('all.category.products')}}">Tur Advertencia</a></li>



                                            @php

                                    $categories = \App\Category::orderBy('name','asc')->get();

                                @endphp



                                @foreach($categories as $category)



                                    <li>



                                        <a href="{{route('category.products',$category->slug)}}">{{$category->name}}

                                        ({{count($category->posts)}})</a>



                                                </li>



                                            @endforeach


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

                                            @php

                                    $previousGetReq = isset($_GET['query'])? 'query=' . $_GET['query'] . '&' : '';

                                @endphp

                                    <li>

                                        <a href="?{{$previousGetReq}}short=mas-nobo">Mas nobo </a>

                                            </li>

                                            <li><a href="?{{$previousGetReq}}short=mas-bieu">Mas bieu </a></li>

                                            <li><a href="?{{$previousGetReq}}short=mas-mira">Mas mira </a></li>

                                            <li><a href="?{{$previousGetReq}}short=mas-caro">Mas caro </a></li>

                                            <li><a href="?{{$previousGetReq}}short=mas-barata">Mas barata </a>

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

        <a href="{{route('post.create')}}"><img style="max-width:100%;margin-bottom:1px;margin-left:1px;margin-right:1px;" src="images/headline_1.png"></a>

        </div>

        -->


        <div class="infinite-scroll">

            <!--end shorting option markup -->

            <div class="container">


                <div class="col-md-12 col-lg-12">


                    @if($posts->count() > 0)

                        <div class="home_page_product d-flex">
                            @foreach($posts as $post)
                                <div class="product_single view_product_details">
                                    <img src="{{$post->fistImage()}}">
                                    <div class="product_single_shadow">
                                        @auth()
                                            @if($post->user_id === auth()->user()->id)
                                                <div class="hide-in-desktop">
                                                    <a href="{{route('post.update.email.url',$post->uuid)}}"> <i
                                                            class="fas fa-edit btn btn-primary editBtn"></i></a>

                                                    <a onClick="return confirm('Are you sure you want to delete the post?')"
                                                       href="{{route('confirm.delete.post',$post->uuid)}}"><i
                                                            class="fas fa-trash-alt btn btn-danger dltBtn"></i></a>
                                                </div>
                                            @endif
                                        @endauth
                                        <p class="view_product_details" data-post="{{$post->id}}"><i
                                                class="fas fa-eye"></i>{{$post->clicks}} <span
                                                class="hide-in-desktop"><br>Details</span></p>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    @else

                        <div class="text-center mt-5">

                            <div class="card">

                                <div class="card-body">

                                    <h1 class="text-danger no-post">No tin advertencia</h1>

                                </div>

                            </div>

                        </div>

                    @endif


                </div>


            </div>


            <div class="paginatio">
                <div class="m-auto">
                    @if($posts->links())
                        @if(isset($_GET['short']))
                            {{ $posts->appends(['short' => $_GET['short']])->links() }}
                        @else
                            {{ $posts->links() }}
                        @endif
                    @endif
                </div>
            </div>

        </div>

    </div>











    <div id="outputModal"></div>



@endsection







@section('footer')



    <script src="{{asset('js/jsscroll.js')}}"></script>

    <script type="text/javascript">

        $('ul.pagination').hide();

        $(function () {

            $('.infinite-scroll').jscroll({

                autoTrigger: true,

                {{--loadingHtml: '<img class="center-block text-center m-auto" src="{{asset('images/giphy.gif')}}" alt="" />',--}}

                padding: 0,

                nextSelector: '.pagination li.active + li a',

                contentSelector: 'div.infinite-scroll',

                callback: function () {

                    $('ul.pagination').remove();

                }

            });

        });

    </script>





    <script defer>


        $(document).ready(function () {


            $(document).on('click', '.view_product_details', function () {


                let item = $(this);


                let post = item.data('post');


                $.get(`/post/${post}/details`, function (data, status) {


                    $("#outputModal").html(data);


                    $("#product_overview_modal").modal('show');


                    var owl = $(".owl-carousel");


                    owl.owlCarousel({


                        items: 1,


                    });


                });


            });


        });


    </script>



@endsection
