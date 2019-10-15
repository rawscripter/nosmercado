<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class)->where('expire_date', '>=', Carbon::now());
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

}
