@guest()
    <a href="/login"
       style="font-size:medium;margin-top: -.04rem !important;padding: 0.4rem .5rem !important;"
       class="btn btn-primary">
        <i style="margin-right: 5px;" class="fas fa-sign-in-alt"></i> <span class="hide-in-desktop">Login</span>
    </a>
@endguest
@auth()
    <div class="btn btn-primary">
        <div class="dropdown">
            <div class="dropdown-toggle" id="profileDropdown"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-alt"></i> <span class="hide-in-desktop"> {{auth()->user()->name}}</span>
            </div>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a href="{{route('post.create')}}" class="dropdown-item">Create New
                    Post</a>
                <a href="{{route('customer.posts')}}" class="dropdown-item">Posts</a>
                <a href="{{route('customer.profile')}}" class="dropdown-item">Profile</a>
                <a onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                   class="dropdown-item">Logout</a>

                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                      style="display: none;">

                    {{ csrf_field() }}

                </form>
            </div>
        </div>
    </div>
@endauth
