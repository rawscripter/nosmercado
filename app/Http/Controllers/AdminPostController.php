<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.post.index', compact('posts'));
    }

    public function archivePosts()
    {
        $posts = Post::where('status', 0)->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.post.index', compact('posts'));
    }

    public function postArchive(Request $request, Post $post)
    {
        $post->status = 0;
        $post->save();

        return redirect()->back()->withSuccess('Advertencia a wordo poni den archivo');
    }  public function postActive(Request $request, Post $post)
    {
        $post->status = 1;
        $post->save();

        return redirect()->back()->withSuccess('Advertencia a wordo activa');
    }
}
