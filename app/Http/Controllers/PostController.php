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

use Illuminate\Support\Facades\File;
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

        $categories = Category::orderBy('name', 'asc')->get();

        return view('site.post.create', compact('categories'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)

    {


        $request->validate([

            //'title' => 'required|max:20',

            //'option_id' => 'required',

            //'category_id' => 'required',

            'price' => 'required|max:7',

            'email' => 'required',

            'phone' => 'required',

            'description' => 'required',

            'g_undefined' => 'required',

        ], [

            //'title.required' => 'Post Title field is required!',


            //'option_id.required' => 'Please selecta Ta benda, Ta huur, Ta hasi of Ta busca!',

            //'category_id.required' => 'Please selecta un categoria!',

            'price.required' => 'Please pone un prijs!',

            'g_undefined.required' => 'Please pone un potret!',

            'description.required' => 'Please describi bo producto of servicio!',

            'phone.required' => 'Please jena bo number di contacto!',

            'email.required' => 'Please jena bo email!',


        ]);


        //One single post can have max 5 images

        $images = $request->file('g_undefined');

        if (count($images) > 5)

            return response()->json('error', 500);


        $postData = $request->all();

        if (auth()->user() && auth()->user()->role == 'customer') {
            $postData['user_id'] = auth()->user()->id;
            $postData['priority'] = 1;
        }
        //adding expire days for the post
        $postData['expire_date'] = Carbon::now()->addDays(30);
        $postImages = $this->uploadPostImage($request);
        if (!empty($postImages)) {
            $newPost = Post::create($postData);
            $this->createPostImage($newPost, $postImages);
            //send mail to the user
            $this->sendMail($newPost);
            // if everything all right then redirect user to post image category with newest filter
            $url['url'] = url('category/' . $newPost->category->slug . '/posts?short=mas-nobo');
            return json_encode($url);

        }

        return response()->json('Algo a bai malo. Please purba atrobe.', 500);


    }


    public function updatePost($uuid, Request $request)

    {

        $request->validate([

            //'title' => 'required|max:20',

            //'price' => 'required',

            //'option_id' => 'required',

            //'category_id' => 'required',

            //'description' => 'required',

            //'email' => 'required',


            //'title' => 'required|max:20',

            //'option_id' => 'required',

            //'category_id' => 'required',

            //'price' => 'required|max:6',

            'email' => 'required',

            'phone' => 'required',

            'description' => 'required',

            //'g_undefined' => 'required', //not required because in first post image was already posted.


        ], [

            //'title.required' => 'Post Title field is required!',

            //'price.required' => 'Post Price field is required!',

            //'email.required' => 'Email field is required!',

            //'description.required' => 'Description field is required!',

            //'category_id.required' => 'Category field is required!',

            //'title.required' => 'Post Title field is required!',


            //'option_id.required' => 'Please selecta Ta benda, Ta huur, Ta hasi of Ta busca!',

            //'category_id.required' => 'Please selecta un categoria!',

            //'price.required' => 'Please pone un prijs cu 6 number maximo!',

            //'g_undefined.required' => 'Please pone minimo 1 of maximo 5 potret!',

            'description.required' => 'Please describi bo producto of servicio!',

            'phone.required' => 'Please jena bo number di contacto!',

            'email.required' => 'Please jena bo email!',


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


        return response()->json('Algo a bai malo. Please purba atrobe.', 500);

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
        $images = $post->images;

        foreach ($images as $image) {
            File::delete('post/images/' . $image->name);
            File::delete('post/images/thumb/' . $image->name);
            $image->delete();
        }


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

                    $img->orientate();


                    $img->save($destinationPath . '/' . $name);  #img saved using constraint


                    $cropedImage = \Intervention\Image\Facades\Image::make($destinationPath . '/' . $name);

                    $cropedImage->resize(500, 500)->save($destinationPath . '/' . $name);  #400 x 400


                    //uploading original image
                    $img->reset();
                    $img->orientate();

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

