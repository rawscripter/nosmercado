@extends('layouts.admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Posts table
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('success'))
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <p class="alert alert-success">{{ Session::get('success') }}</p>
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="create-btn text-right">
                            <a href="{{route('post.create')}}"
                               class="btn btn-primary">Add New Post</a><br>
                        </div>
                    </div>
                    <div class="col-12 mt-5">

                        <div id="order-listing_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table class="table  no-footer" role="grid"
                                   aria-describedby="order-listing_info">
                                <thead>
                                <tr role="row">
                                    <th>Post Id</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Phone</th>
                                    <th>Custom Link</th>
                                    <th>Posted At</th>
                                    <th>Expire Date</th>
                                    <th>Archive</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($posts->count() > 0)
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->price }}</td>
                                            <td>{{ $post->phone }}</td>
                                            <td>{{ $post->link }}</td>
                                            <td>{{ $post->created_at->format('m-d-Y H:s:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->expire_date)->format('m-d-Y H:s:i') }}</td>
                                            <td>
                                                @if($post->status == 1)
                                                    <a href="{{route('admin.post.archive',$post->id)}}"
                                                       class="badge rounded-0 badge-warning">Archive Post</a>
                                                @else
                                                    <a href="{{route('admin.post.active',$post->id)}}"
                                                       class="badge rounded-0 badge-success">Active Post</a>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST"
                                                      action="{{route('admin.post.destroy',$post->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input onClick="return confirm('Are you sure you want to delete the Post?')"
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

                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection

