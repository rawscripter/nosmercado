@extends('layouts.admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Create New User
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.customers')}}">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Customer</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-md-6 m-auto">
                        <form action="{{route('admin.customer.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="collection">Name</label>
                                <input type="text" required name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="collection">Email</label>
                                <input type="email" required name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="collection">Password</label>
                                <input type="password" required name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="collection">Confirm Password</label>
                                <input type="password" required name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-info rounded-0"
                                       value="Add New Customer">
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($errors) && count($errors) > 0)
                    <div class="row">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
