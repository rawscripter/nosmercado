<div class="cart {{$cartClass}}">
    <a href="/cart">
        <i class="fa" style="font-size:24px">&#xf07a;</i>
        <span class='badge badge-success cart-counter' id='lblCartCount'>
                    @if(session('cart'))
                {{count(session('cart'))}}
            @else
                {{'0'}}
            @endif
                </span>
    </a>
</div>
