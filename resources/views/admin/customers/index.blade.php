@extends('layouts.admin.layout')



@section('content')

    <div class="content-wrapper">

        <div class="page-header">

            <h3 class="page-title">

                Customers table

            </h3>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Customers</li>
                </ol>
            </nav>
        </div>

        <div class="card">

            <div class="card-body">
                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="create-btn text-right">
                            <a href="{{route('admin.customer.create')}}"
                               class="btn btn-primary">Add New Customer</a><br>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <div id="order-listing_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table class="table  no-footer" role="grid"
                                   aria-describedby="order-listing_info">
                                <thead>
                                <tr role="row">
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Total Posts</th>
                                    <th>Active Posts</th>
                                    <th>Added At</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($customers->count() > 0)
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$customer->id}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->role}}</td>
                                            <td>{{$customer->totalPosts->count()}}</td>
                                            <td>{{$customer->activePosts->count()}}</td>
                                            <td>{{ $customer->created_at->format('m-d-Y H:s:i') }}</td>
                                            <td><a href="{{route('admin.login.as.customer',$customer->id)}}"
                                                   class="btn btn-primary">Login </a></td>
                                            <td>
                                                <form method="POST"
                                                      action="{{route('admin.customer.destroy',$customer->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input
                                                        onClick="return confirm('Are you sure you want to delete the User?')"
                                                        type="submit" class="btn rounded-0 btn-danger"
                                                        value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{$customers->links()}}
            </div>
        </div>
    </div>

@endsection



