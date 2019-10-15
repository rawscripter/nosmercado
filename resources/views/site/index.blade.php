@extends('layout.master-layout')

@section('body')

    <div class="main_content">

        <!-- shorting option markup -->
        <div class="shadow bg-white rounded-0 mt-0">
            <div class="shorting_area">
                @include('layout.short')
            </div>
        </div>
        <!--end shorting option markup -->

        <div class="container">
            <div class="col-md-12 col-lg-12">
                @if($posts->count() > 0)
                    <div class="home_page_product d-flex">
                        @foreach($posts as $post)
                            <div class="product_single view_product_details" data-post="{{$post->id}}">
                                <img src="{{$post->fistImage()}}">
                                <div class="product_single_shadow">
                                    <p><i class="fas fa-eye"></i>{{$post->clicks}}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="text-center mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="text-danger no-post">No Post Available</h1>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="pagination mt-5 ">
            <div class="m-auto">

                @if(isset($_GET['short']))
                    {{ $posts->appends(['short' => $_GET['short']])->links() }}
                @else
                    {{ $posts->links() }}
                @endif

            </div>
        </div>
    </div>


    <div id="outputModal"></div>
@endsection

@section('footer')
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