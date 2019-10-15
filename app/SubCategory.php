<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class)->where('expire_date', '>=', Carbon::now());
    }

    public function subCategoryPostsByShorted($shorted,$paginateItems)
    {
        if ($shorted == 'most-viewed') {
            $table = 'clicks';
            $short = 'desc';
        } else if ($shorted == 'newest') {
            $table = 'created_at';
            $short = 'desc';
        } else if ($_GET['short'] == 'price-high-to-low') {
            $table = 'price';
            $short = 'desc';
        } else if ($_GET['short'] == 'price-low-to-high') {
            $table = 'price';
            $short = 'asc';
        } else {
            $table = 'created_at';
            $short = 'asc';
        };

        return Post
            ::where('expire_date', '>=', Carbon::now())
            ->where('sub_category_id', $this->id)
            ->orderBy($table, $short)
            ->orderBy(DB::raw('RAND()'))
            ->paginate($paginateItems);
    }


}
