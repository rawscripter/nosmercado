<?php


namespace App;


use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Notifications\Notifiable;


class User extends Authenticatable


{


    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'logo', 'slug'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return Post
            ::where('user_id', '=', $this->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function totalPosts()
    {
        return $this->hasMany(Post::class);
    }

    public function activePosts()
    {
        return $this->hasMany(Post::class)
            ->where('status', '=', 1)
            ->where('expire_date', '>=', Carbon::now());
    }

    public function userLogo()
    {
        return '/post/user/logo/' . $this->logo;
    }
}


