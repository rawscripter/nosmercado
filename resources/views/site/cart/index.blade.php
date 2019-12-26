@extends('layout.master-layout')
@section('header')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/basic.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <link rel="stylesheet" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('body')


    <div class="main_content mb-3">

        <div class="px-4 px-lg-0">
            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                        @endif
                        <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-2 px-3 text-uppercase">Product</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Price</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Quantity</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Total</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-2 text-uppercase">Remove</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(session('cart'))
                                        <?php $total = 0 ?>
                                        @foreach(session('cart') as $id => $post)
                                            <?php $total += $post['price'] * $post['quantity'] ?>
                                            <tr>
                                                <th scope="row" class="border-0">
                                                    <div class="p-2">
                                                        <img
                                                            src="{{$post['image']}}"
                                                            alt="" width="70" class="img-fluid rounded shadow-sm">
                                                        <div class="ml-3 d-inline-block align-middle">
                                                            <h5 class="mb-0">
                                                                <a href="#"
                                                                   class="text-dark d-inline-block align-middle">
                                                                    {{$post['name']}}
                                                                </a>
                                                            </h5><span
                                                                class="text-muted font-weight-normal font-italic d-block">Category: {{$post['category']}}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="border-0 align-middle">
                                                    <strong>Afl.{{$post['price']}}</strong>
                                                </td>
                                                <td class="border-0 align-middle"><strong>{{$post['quantity']}}</strong>
                                                </td>
                                                <td class="border-0 align-middle">
                                                    <strong>Afl. {{$post['price'] * $post['quantity']}} </strong>
                                                </td>
                                                <td class="border-0 align-middle">
                                                    <a href="{{route('remove.from.cart',$post['id'])}}"
                                                       class="text-dark"><i class="fa fa-trash"></i></a></td>
                                            </tr>


                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>

                    <div class="row py-5 p-4 bg-white rounded shadow-sm">
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions
                                for seller
                            </div>
                            <div class="p-4">
                                <p class="font-italic mb-4">If you have some information for the seller you can leave
                                    them in the box below</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary
                            </div>
                            <div class="p-4">
                                <p class="font-italic mb-4">Shipping and additional costs are calculated based on values
                                    you have entered.</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Order
                                            Subtotal </strong><strong>Afl. {{$total ?? '0.00'}}</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Shipping and handling</strong><strong>Afl. 0.00</strong>
                                    </li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Tax</strong><strong>Afl. 0.00</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Total</strong>
                                        <h5 class="font-weight-bold">Afl. {{$total ?? '0.00'}}</h5>
                                    </li>
                                </ul>
                                <a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection



