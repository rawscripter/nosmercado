<div class="modal fade" id="product_overview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div id="modal" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    {{--                    @php--}}
                    {{--                        $to = Carbon\Carbon::now();--}}
                    {{--                        $from = $post->created_at;--}}
                    {{--                        $diff_in_minutes = $to->diffInMinutes($from);--}}
                    {{--                        if ($diff_in_minutes == 1){--}}
                    {{--                            echo ($diff_in_minutes . " minuut pasa...");--}}
                    {{--                        }--}}
                    {{--                        elseif ($diff_in_minutes > 1 and $diff_in_minutes < 60 ) {--}}
                    {{--                            echo ($diff_in_minutes . " minuut pasa...");--}}
                    {{--                        }--}}
                    {{--                        elseif ($diff_in_minutes >= 60 and $diff_in_minutes < 120){--}}
                    {{--                            $hours = 1;--}}
                    {{--                            echo ($hours . " ora pasa...");--}}
                    {{--                        }--}}
                    {{--                        elseif ($diff_in_minutes >= 120 and $diff_in_minutes < 1440){--}}
                    {{--                            $hours = round($diff_in_minutes*0.0166667);--}}
                    {{--                            echo ($hours . " ora pasa...");--}}
                    {{--                        }--}}
                    {{--                        elseif ($diff_in_minutes >= 1440 and $diff_in_minutes < 2880){--}}
                    {{--                            $days = 1;--}}
                    {{--                            echo ($days . " dia pasa...");--}}
                    {{--                        }--}}
                    {{--                        else {--}}
                    {{--                            $days = round($diff_in_minutes*0.000694444);--}}

                    {{--                            echo ($days . " dia pasa..." );--}}
                    {{--                        }--}}
                    {{--                    @endphp--}}

                    {{$post->title}} #{{$post->id}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="postImageSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $i= 1;
                        @endphp
                        @foreach($post->images as $image)
                            <div class="carousel-item {{$i == 1 ? 'active' : ''}}">
                                <img src="/post/images/{{$image->name}}" style="max-width: 100%" alt="images">
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                    <!-- Left and right controls -->
                    {{--show previous and next button if only there multiple images of the post--}}
                    @if($post->images->count() > 1)
                        <a class="carousel-control-prev" href="#postImageSlider" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#postImageSlider" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    @endif
                </div>
                <div class="product_overview_content pb-3">
                    <br>
                    <p>{{$post->description}}</p>
                    <br>

                    @if(!empty($post->user_id))
                        @if(!empty($post->user->userLogo()))
                            <div class="d-flex justify-content-around mb-5">
                                <img style="max-width: 120px; margin: 0 auto" src="{{$post->user->userLogo()}}" alt="">
                            </div>
                        @endif
                    @endif
                    <div class="d-flex justify-content-around">
                        <div>
                            <h4 class="mb-3 "><i class="fas fa-mobile-alt"></i> Afl. {{$post->price}} </h4>
                        </div>
                        <div class="">
                            <button data-product="{{$post->id}}" class="btn add-to-cart btn-primary text-white"><i
                                    class="fas fa-cart-plus "></i> <span class="cart-text">Add To Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                @if(!empty($post->link))
                    <div class="m-3">
                        <a href="{{$post->link}}" target="_blank" class="btn btn-primary">{{$post->link}}</a>
                    </div>
                @endif
                @auth()
                    @if($post->user_id === auth()->user()->id)
                        <div>
                            <a href="{{route('post.update.email.url',$post->uuid)}}"> <i
                                    class="fas fa-edit btn btn-primary editBtn"></i></a>
                            <a onClick="return confirm('Are you sure you want to delete the post?')"
                               href="{{route('confirm.delete.post',$post->uuid)}}"><i
                                    class="fas fa-trash-alt btn btn-danger dltBtn"></i></a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
</div>
