<?php

namespace App\Http\Controllers;

use App\Category;
use App\Click;
use App\Image;
use App\Mail\MailToPostAuthor;
use App\Post;
use App\PostImage;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('site.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required',
            'email' => 'required',
            'g_undefined' => 'required',
        ], [
            'title.required' => 'Post Title field is required!',
            'price.required' => 'Post Price field is required!',
            'email.required' => 'Email field is required!',
            'g_undefined.required' => 'You have to choose the Post Image!',
        ]);


        if (!empty($request->file('g_undefined')))
            if (count($request->file('g_undefined')) > 9)
                return back()->withErrors('You can upload maximum 9 images for a post.');


        $postData = $request->all();
        $postData['expire_date'] = Carbon::now()->addDays(30);
        $newPost = Post::create($postData);

        //send mail to the user
        $this->sendMail($newPost);

        if (!empty($request->file('g_undefined'))) {
            if ($request->hasfile('g_undefined')) {
                $images = $request->file('g_undefined');
                foreach ($images as $image) {
                    $name = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('/post/images/thumb');
                    $img = \Intervention\Image\Facades\Image::make($image->getRealPath());

                    // backup status
                    $img->backup();

                    //image for thumb
                    $img->resize(400, 400)->save($destinationPath . '/' . $name);
                    $img->reset();

                    //uploading original image
                    $destinationPath = public_path('/post/images');
                    $img->save($destinationPath . '/' . $name);

                    $newImage = Image::create(
                        ['name' => $name]
                    );
                    // adding post id and image id to pivot table
                    $this->createPostImage($newPost, $newImage);
                }
            }
        }
        $url['url'] = url('sub-category/' . $newPost->subCategory->slug . '/posts?short=newest');
        return json_encode($url);

    }


    public function createPostImage($post, $image)
    {
        PostImage::create(
            [
                'post_id' => $post->id,
                'image_id' => $image->id,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $session_id = session()->getId();
        $click = Click::where('session_id', $session_id)->first();
        if (empty($click)) {
            Click::create([
                'session_id' => $session_id,
                'post_id' => $post->id,
                'clicks' => 1,
                'user_ip' => \Request::ip()
            ]);
            $post->increment('clicks');
        } else {
            $click->increment('clicks');
            $post->increment('clicks');
        }

        return view('site.post.post-modal', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    public function deletePost($id, $title, $email, $expire)
    {
        $post = $this->decodeAndFindPost($id, $title, $email, $expire);
        $categories = Category::orderBy('id', 'asc')->get();
        if (!$post)
            return view('site.post.post-not-found', compact('categories'));

        $confirmDeleteUrl = url('/post/destroy/' . $id . '/' . $title . '/' . $email . '/' . $expire);
        return view('site.post.delete', compact('categories', 'confirmDeleteUrl'));
    }


    public function confirmDeletePost($id, $title, $email, $expire)
    {
        $post = $this->decodeAndFindPost($id, $title, $email, $expire);
        $categories = Category::orderBy('id', 'asc')->get();
        if (!$post)
            return view('site.post.post-not-found', compact('categories'));
        $post->delete();
        return view('site.post.successfully-deleted', compact('categories'));
    }


    public function sendMail(Post $post)
    {
        Mail::to($post->email)->send(new MailToPostAuthor($post));
    }

    public function decodeAndFindPost($id, $title, $email, $expire)
    {
        $decoded_id = base64_decode($id);
        $decoded_title = base64_decode($title);
        $decoded_email = base64_decode($email);
        $decoded_expire = base64_decode($expire);

        $post = Post::findOrFail($decoded_id)
            ->whereTitle($decoded_title)
            ->whereEmail($decoded_email)
            ->whereExpireDate($decoded_expire)
            ->first();

        if (empty($post))
            return false;

        return $post;
    }
}
