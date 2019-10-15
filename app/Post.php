<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'price',
        'email',
        'phone',
        'description',
        'active',
        'expire_date',
        'clicks'
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'post_images');
    }

    public function fistImage()
    {
        $images = $this->images;
        if (!isset($images[0]))
            return 'https://dummyimage.com/400x400/ffffff/a8a8a8&text=Dummy+Post+Image';
        return '/post/images/thumb/' . $images[0]->name;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
