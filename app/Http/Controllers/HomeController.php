<?php

namespace App\Http\Controllers;

use App\Click;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalPosts = Post::all()->count();
        $totalVisitors = Click::all()->count();
        $totalClicks = Click::all()->sum('clicks');
        $activePosts = $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->where('status', 1)
            ->get()
            ->count();
        return view('home', compact('totalPosts', 'activePosts', 'totalVisitors', 'totalClicks'));
    }

    public function home()
    {
        if (auth()->user()->role == 'customer') {
            return redirect()->route('customer.posts');
        }

        if (auth()->user()->role == 'admin') {
            return redirect('/admin');
        }
    }

    public function loginAsCustomer(User $user)
    {
        Auth::login($user);
        return redirect('/home');
    }
}
