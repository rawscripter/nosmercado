<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nosmercado</title>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

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
                                    <span class="open_nave_btn" onclick="openNav()">&#9776;</span>
                                </div>
                                <div class="header-logo">
                                    <h4 class="text-center"><a href="/">
                                            <img src="{{asset('images/logo.png')}}" id="logo" alt="Nosmercado">
                                        </a></h4>
                                </div>
                                <div class="header_top_button_mobile">
                                    <a href="{{route('post.create')}}"
                                       class="btn btn-primary rounded-0 btn-sm float-right mt-1 pl-3 pr-3"><i
                                                class="fas fa-thumbtack"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-8">
                                <div class="main_search mt-0 mb-2">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded-0" name="search_val"
                                                   placeholder="Busca advertencia..">
                                            <span class="input-group-btn">
									<button type="submit" class="btn btn-primary rounded-0 pl-3 pr-3"><i
                                                class="fas fa-search"></i></button>
								</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="header_top_button">
                            <a href="{{route('post.create')}}"
                               class="btn btn-primary rounded-0 btn-sm float-right mt-1"><i
                                        class="fas fa-thumbtack"></i> Publica advertencia</a>
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


                            @foreach($categories as $category)
                                <div class="col-md-2 m-auto">
                                    <div class="menu_single_row">

                                        <div class="menu_single_heading">
                                            <a style="color: #000;"
                                               href="{{route('category.products',$category->slug)}}">
                                                <h2>
                                                    {{$category->name}}
                                                </h2>
                                            </a>
                                            <i class="fas fa-chevron-down mobile_menu_down_icon show_menu_items"></i>
                                        </div>
                                        @if($category->subCategories->count() > 0)
                                            <div class="menu_single_item">
                                                @foreach($category->subCategories as $subCategory)
                                                    <a href="{{route('subCategory.products',$subCategory->slug)}}">{{$subCategory->name}}</a>
                                                @endforeach
                                            </div>
                                        @endif
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
            website aki.
            tampoco ta para responsabel pa pagonan cu tin cu wordo haci entre uzarionan di e website.
            Contact: info@nosmercado.com..</p>
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