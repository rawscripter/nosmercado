<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'option_id',
        'title',
        'uuid',
        'price',
        'email',
        'phone',
        'description',
        'active',
        'expire_date',
        'clicks',
        'link',
        'user_id',
        'priority'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'post_images');
    }

    public function fistImage()
    {
        $images = $this->images;
        if (!isset($images[0]))
            return 'https://dummyimage.com/400x400/ffffff/a8a8a8&text=Dummy+Post+Image';
        #return asset('/post/images/' . $images[0]->name);
        return asset('/post/images/thumb/' . $images[0]->name);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



