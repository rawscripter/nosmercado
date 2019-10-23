@extends('layout.master-layout')@section('body')    <div class="main_content">        <!-- shorting option markup -->        <div class="shadow bg-white rounded-0 mt-0">            <div class="shorting_area">                <div class="row">                    <div class="col-md-12">                        <div class="shorting-menu">                            <div class="container">                                <ul class="short-ul">                                    <li class="short-li"><a href="#"><span                                                    disable></span> <?php echo e(isset($_GET['short']) ? str_replace('-', ' ', ucfirst($_GET['short'])) : 'Sortia'); ?>                                            <i                                                    class="fas fa-angle-down"></i><i                                                    class="fas fa-angle-up short_up"></i></a>                                        <ul>                                            <li><a href="?short=newest">Mas nobo </a></li>                                            <li><a href="?short=oldest">Mas bieu </a></li>                                            <li><a href="?short=most-viewed">Mas mira </a></li>                                            <li><a href="?short=price-high-to-low">Mas caro </a></li>                                            <li><a href="?short=price-low-to-high">Mas barata </a></li>                                        </ul>                                    </li>                                    <li>                                        <a href="#"> <span                                                    class="text">                                                        @php                                                            if(isset($shortedSubCategory)){                                                                echo $shortedSubCategory->name;                                                            }elseif (isset($selectedSubCategory)){                                                                echo $selectedSubCategory ;                                                            }else{                                                                echo 'Sub-categoria';                                                            }                                                        @endphp                                            </span>                                            <i class="fas fa-angle-down"></i><i                                                    class="fas fa-angle-up margin-6px cat_up"></i>                                        </a>                                        <ul class="left-on-desktop">                                            @php                                                if(isset($shortCategory)) {                                                $subCategories = $shortCategory->subCategories;                                                }                                                if(isset($allSubCategories)) {                                                    $subCategories = $allSubCategories;                                                }                                            @endphp                                            @if(!empty($subCategories))                                                @foreach($subCategories  as $subCategory)                                                    <li>                                                        <a href="/sub-category/{{$subCategory->category->name}}/{{$subCategory->slug}}/posts">{{$subCategory->name}}</a>                                                    </li>                                                @endforeach                                            @endif                                        </ul>                                    </li>                                    <li>                                        <a href="#">                                            @php                                                if(isset($shortCategory)){                                                    echo $shortCategory->name;                                                }elseif (isset($selectedCategory)){                                                    echo $selectedCategory ;                                                }else{                                                    echo 'Categoria';                                                }                                            @endphp                                            <i                                                    class="fas fa-angle-down"></i><i                                                    class="fas fa-angle-up cat_up"></i></a>                                        <ul class="left-on-desktop">                                            @foreach($categories as $category)                                                <li>                                                    <a href="{{route('category.products',$category->slug)}}">{{$category->name}}</a>                                                </li>                                            @endforeach                                            <li><a href="{{route('all.category.products')}}">Tur advertencia</a></li>                                        </ul>                                    </li>                                </ul>                            </div>                        </div>                    </div>                </div>            </div>        </div>        <!--end shorting option markup -->        <div class="container">            <div class="col-md-12 col-lg-12">                @if($posts->count() > 0)                    <div class="home_page_product d-flex">                        @foreach($posts as $post)                            <div class="product_single view_product_details" data-post="{{$post->id}}">                                <img src="{{$post->fistImage()}}">                                <div class="product_single_shadow">                                    <p><i class="fas fa-eye"></i>{{$post->clicks}}</p>                                </div>                            </div>                        @endforeach                    </div>                @else                    <div class="text-center mt-5">                        <div class="card">                            <div class="card-body">                                <h1 class="text-danger no-post">No Post Available</h1>                            </div>                        </div>                    </div>                @endif            </div>        </div>        <div class="pagination mt-5 ">            <div class="m-auto">                @if(isset($_GET['short']))                    {{ $posts->appends(['short' => $_GET['short']])->links() }}                @else                    {{ $posts->links() }}                @endif            </div>        </div>    </div>    <div id="outputModal"></div>@endsection@section('footer')    <script defer>        $(document).ready(function () {            $(document).on('click', '.view_product_details', function () {                let item = $(this);                let post = item.data('post');                $.get(`/post/${post}/details`, function (data, status) {                    $("#outputModal").html(data);                    $("#product_overview_modal").modal('show');                    var owl = $(".owl-carousel");                    owl.owlCarousel({                        items: 1,                    });                });            });        });    </script>@endsection