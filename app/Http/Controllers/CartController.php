<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('site.cart.index');
    }

    public function addToCart(Post $post)
    {
        if (!$post) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $post->id => [
                    "id" => $post->id,
                    "name" => $post->title,
                    "category" => $post->category->name,
                    "quantity" => 1,
                    "price" => $post->price,
                    "image" => $post->fistImage()
                ]
            ];
            session()->put('cart', $cart);
            $res['status'] = 'success';
            $res['action'] = 'added';
            $res['response'] = 'Added To Cart';
            return json_encode($res);
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$post->id])) {
            $cart[$post->id]['quantity']++;
            session()->put('cart', $cart);
            $res['status'] = 'success';
            $res['action'] = 'updated';
            $res['response'] = 'Cart has been updated.';
            return json_encode($res);
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$post->id] = [
            "id" => $post->id,
            "name" => $post->description,
            "category" => $post->category->name,
            "quantity" => 1,
            "price" => $post->price,
            "image" => $post->fistImage()
        ];
        session()->put('cart', $cart);

        $res['status'] = 'success';
        $res['action'] = 'added';
        $res['response'] = 'Added To Cart';
        return json_encode($res);
    }


    public function removeFromCart(Post $post)
    {
        if ($post->id) {

            $cart = session()->get('cart');

            if (isset($cart[$post->id])) {

                unset($cart[$post->id]);

                session()->put('cart', $cart);
            }
            return redirect()->back()->withSuccess('Product removed successfully');
        }
    }
}
