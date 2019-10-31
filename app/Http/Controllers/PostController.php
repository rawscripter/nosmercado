<?php

namespace App\Http\Controllers;

use App\Category;
use App\Click;
use App\Image;
use App\Mail\MailToPostAuthor;
use App\Post;
use App\PostImage;
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
            'title' => 'required|max:55',
            'price' => 'required',
            'email' => 'required',
            'g_undefined' => 'required',
        ], [
            'title.required' => 'Post Title field is required!',
            'price.required' => 'Post Price field is required!',
            'email.required' => 'Email field is required!',
            'g_undefined.required' => 'You have to choose the Post Image!',
        ]);


        //One single post can have max 9 images
        $images = $request->file('g_undefined');
        if (count($images) > 9)
            return response()->json('error', 500);

        $postData = $request->all();
        //adding expire days for the post
        $postData['expire_date'] = Carbon::now()->addDays(30);
        $postImages = $this->uploadPostImage($request);

        if (!empty($postImages)) {
            $newPost = Post::create($postData);
            $this->createPostImage($newPost, $postImages);
            //send mail to the user
            $this->sendMail($newPost);

            // if everything all right then redirect user to post image category with newest filter
            $url['url'] = url('category/' . $newPost->category->slug . '/posts?short=newest');

            return json_encode($url);
        }
        return response()->json('Something Went wrong. Please try again.', 500);

    }

    public function updatePost($uuid, Request $request)
    {


        $request->validate([
            'title' => 'required|max:55',
            'price' => 'required',
            'email' => 'required',
        ], [
            'title.required' => 'Post Title field is required!',
            'price.required' => 'Post Price field is required!',
            'email.required' => 'Email field is required!',
        ]);
        $post = Post::findOrFail($uuid);


        //delete old images from database
        if (isset($request->removedImage)) {
            if (!empty($request->removedImage)) {
                $removeImages = $request->removedImage;
                foreach ($removeImages as $i) {
                    $image = Image::find($i);
                    if (!empty($image))
                        $image->delete();
                }
            }
        }

        $postData = $request->all();
        $updatePost = $post->update($postData);

        $postImages = $this->uploadPostImage($request);

        if (!empty($postImages)) {
            $this->createPostImage($post, $postImages);
        }

        if ($updatePost) {
            $url['url'] = url('category/' . $post->category->slug . '/posts?short=newest');

            return json_encode($url);
        }

        return response()->json('Something Went wrong. Please try again.', 500);
    }


    public function createPostImage($post, $images)
    {
        foreach ($images as $image) {
            PostImage::create(
                [
                    'post_id' => $post->id,
                    'image_id' => $image,
                ]
            );
        }

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


    public function editPost($uuid)
    {
        $post = Post::whereUuid($uuid)->first();
        return view('site.post.edit', compact('post'));
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


    public function deletePost($uuid)
    {
        $post = Post::whereUuid($uuid)->first();
        $categories = Category::orderBy('id', 'asc')->get();
        if (!$post)
            return view('site.post.post-not-found', compact('categories'));

        return view('site.post.delete', compact('categories', 'post'));
    }


    public function confirmDeletePost($uuid)
    {
        $post = Post::whereUuid($uuid)->first();;
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

    public function uploadPostImage($request)
    {
        $postImages = [];
        if (!empty($request->file('g_undefined'))) {
            if ($request->hasfile('g_undefined')) {
                $images = $request->file('g_undefined');
                foreach ($images as $image) {


                    $name = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('/post/images/thumb');
                    $img = \Intervention\Image\Facades\Image::make($image->getRealPath());

                    // backup status
                    $img->backup();

                    $imagedetails = getimagesize($image);


                    $width = $imagedetails[0];
                    $height = $imagedetails[1];
                    if ($width > $height) {
                        $newHeight = $height;
                    } else {
                        $newHeight = $width;
                    }

                    $img->fit($newHeight, $newHeight, function ($constraint) {
                        $constraint->upsize();
                    });

                    $img->save($destinationPath . '/' . $name);
                    //$img->resize(400, 400)->save($destinationPath . '/' . $name);
                    $img->reset();

                    $cropedImage = \Intervention\Image\Facades\Image::make($destinationPath . '/' . $name);
                    $cropedImage->resize(400, 400)->save($destinationPath . '/' . $name);

                    //uploading original image
                    $destinationPath = public_path('/post/images');
                    $img->save($destinationPath . '/' . $name);

                    $newImage = Image::create(
                        ['name' => $name]
                    );
                    array_push($postImages, $newImage->id);
                }

            }

        }
        return $postImages;
    }
}
