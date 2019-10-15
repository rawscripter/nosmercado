<div class="modal fade" id="product_overview_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div id="modal" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">{{$post->title}} (#{{$post->id}})</h5>
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
                    <a class="carousel-control-prev" href="#postImageSlider" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#postImageSlider" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>


                <div class="product_overview_content pl-3">
                    <br>
                    <p>{{$post->description}}</p>
                    <br>
                    <h4>AWG {{$post->price}}  {{$post->phone ? '| T: ' . $post->phone : ''}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>