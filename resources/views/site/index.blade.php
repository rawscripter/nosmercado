@extends('layout.master-layout')

@section('body')

    <div class="main_content">
        <div class="container">
            <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                <div class="home_page_product">
                    <div class="product_single" data-toggle="modal" data-target="#product_overview_modal">
                        <img src="assets/images/koel.png">
                        <div class="product_single_shadow">
                            <p><i class="fas fa-eye"></i>100</p>
                        </div>
                    </div>
                    <div class="product_single" data-toggle="modal" data-target="#product_overview_modal">
                        <img src="assets/images/birds.png">
                        <div class="product_single_shadow">
                            <p><i class="fas fa-eye"></i>32</p>
                        </div>
                    </div>
                    <div class="product_single" data-toggle="modal" data-target="#product_overview_modal">

                        <img src="assets/images/koel.png">
                        <div class="product_single_shadow">
                            <p><i class="fas fa-eye"></i>99</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection