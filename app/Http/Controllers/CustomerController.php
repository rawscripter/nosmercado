<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->orderBy('created_at', 'desc')
            ->paginate(25);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect()->back()->withMessage('Customer Created Successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->withMessage('Customer has been Deleted.');
    }

    public function posts()
    {
        $user = auth()->user();
        $posts = $user->posts();
        return view('site.index', compact('posts'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('site.user.profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Please jena bo name!',
            'address.required' => 'Please jena bo address!',
            'phone.required' => 'Please jena bo number di contacto!',
            'email.required' => 'Please jena bo email!',
        ]);
        if ($request->hasFile('logo'))
            $data['logo'] = $this->uploadLogo($request->logo);
        $user = auth()->user()->update($data);
        if ($user) {
            return response()->json('Successfully updated.');
        }
        return response()->json('Algo a bai malo. Please purba atrobe.', 500);
    }

    public function uploadLogo($image)
    {
        $name = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/post/user/logo');
        $img = \Intervention\Image\Facades\Image::make($image->getRealPath());
        $img->save($destinationPath . '/' . $name);  #img saved using constraint
        return $name;
    }
}
