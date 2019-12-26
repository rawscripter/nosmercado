<!DOCTYPE html>


<html>


<head>


    <meta charset="utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <meta name="description" content="Cumpra y Bende Online na Aruba!">

    <meta name="keywords" content="Vraag,Aanbod,Aruba,Post,Tur,Cos,VAPTC,Cumpra,Bende,NosMercado">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Nosmercado</title>


    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css">


    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">


    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153525056-1"></script>

    <script>

        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());


        gtag('config', 'UA-153525056-1');

    </script>


    <style>


        button.swal2-confirm.swal2-styled {


            color: #fff;


            background-color: #2b62d9;


            border-color: #2b62d9;


        }


        #post_form {

            border: none;

        }


        label {

            display: inline-block;

            position: relative;

            height: auto;

            width: auto;

        }


        @media (max-width: 720px) {

            .justify-content-around {

                flex-direction: column;

            }

        }

    </style>


    @yield('header')


</head>


<body>


<div class="bg-white rounded">


    <header class="header_area">


        <div class="header_top">


            <div id="no-padding" class="container-fluid">


                <div class="row">


                    <div class="col-md-9 col-lg-9">


                        <div class="row">


                            <div class="col-md-6 col-lg-4">


                                <div class="menu_btn">


                                    <span class="open_nave_btn" style="color:white" onclick="">&#9776;</span>
                                    <!-- openNav() -->


                                </div>


                                <div class="header-logo">


                                    <h4 class="text-center"><a href="/">


                                            <img src="{{asset('images/logo.png')}}" id="logo" alt="Nosmercado">


                                        </a></h4>


                                </div>


                                <div class="header_top_button_mobile">

                                    @include('layout.inc.login-menu')

                                </div>


                            </div>


                            <div class="col-md-6 col-lg-8">


                                <div class="main_search mt-0 mb-2"
                                     style="border: 1px solid #ced4da;border-radius: 5px;">


                                    <form action="{{route('post.search')}}" method="get">


                                        <div class="input-group">


                                            <button type="submit" class="btn rounded-0 pl-3 pr-3"><i


                                                    class="fas fa-search"></i></button>


                                            <input type="text" class="form-control rounded-0" name="query"

                                                   style="border: 1px solid transparent; !important"

                                                   placeholder="Busca algo..."

                                                   value="{{isset($_GET['query']) ? $_GET['query']:'' }}">


                                            <span class="input-group-btn">

								</span>


                                        </div>


                                    </form>


                                </div>


                            </div>


                        </div>


                    </div>


                    <div class="col-md-3 col-lg-3">


                        <div class="header_top_button">


                            {{--                            <a href="{{route('post.create')}}"--}}

                            {{--                               style="font-size:medium;margin-top: -.04rem !important;padding: 0.4rem .5rem !important;"--}}

                            {{--                               class="btn btn-primary">--}}

                            {{--                                <i style="margin-right: 5px;" class="fas fa-plus fa-lg"></i> Crea advertencia--}}

                            {{--                            </a>--}}

                            @include('layout.inc.login-menu')



                        </div>


                    </div>


                </div>


            </div>


        </div>

        <div class="main_menu">


            <div id="myNav" class="overlay">


                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>


                <div class="overlay-content">


                    <h1><img src="{{asset('images/logo.png')}}" id="menu_logo" alt="Nosmercado">


                    </h1>


                    <div class="main_menu_item_area">


                        <div class="row">


                            @php

                                $categories = \App\Category::orderBy('name','asc')->get();

                            @endphp





                            @foreach($categories as $category)



                                <div class="col-md-2 m-auto">


                                    <div class="menu_single_row">


                                        <div class="menu_single_heading">


                                            <a style="color: #000;"


                                               href="{{route('category.products',$category->slug)}}">


                                                <h2 style="font-size: 18px">

                                                    {{$category->name}} ({{count($category->posts)}})

                                                </h2>

                                            </a>

                                            <i class="fas fa-chevron-down mobile_menu_down_icon show_menu_items"></i>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                    </div>


                </div>


            </div>


        </div>


    </header>


</div>


@yield('body')


<footer class="footer_area">


    <div class="container">


        <p>Nosmercado.com no ta responsabel pa ningun forma di daño causa na e producto / servicionan bendi riba e


            website aki y tampoco ta para responsabel pa pagonan cu tin cu wordo haci entre uzarionan di e website.</p>

        <!--

        <p>



            Contact: info@nosmercado.com.</p> -->


    </div>


</footer>


</body>


<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script src="{{asset('assets/js/owl.carousel.js')}}"></script>


<script src="{{asset('assets/js/main.js')}}"></script>


<script>


    $(document).ready(function () {


        var owl = $('.owl-carousel');


        owl.owlCarousel({


            margin: 10,


            nav: true,


            loop: true,


            responsive: {


                0: {


                    items: 1


                },


                1000: {


                    items: 1


                }


            }


        })


    })


</script>


@yield('footer')


</html>
