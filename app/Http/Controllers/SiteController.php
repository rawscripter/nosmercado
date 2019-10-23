<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    protected $paginateItem = 15;

    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            if ($_GET['short'] == 'most-viewed') {
                $table = 'clicks';
                $short = 'desc';
            } else if ($_GET['short'] == 'newest') {
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
            $posts = Post
                ::where('expire_date', '>=', Carbon::now())
                ->orderBy($table, $short)
                ->orderBy(DB::raw('RAND()'))
                ->paginate(20);
        }
        return view('site.index', compact('posts', 'categories'));
    }

    public function categoryProducts($category)
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $category = Category::whereSlug($category)->first();
        $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->where('category_id', $category->id)
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            $short = $_GET['short'];
            $posts = $category->categoryPostsByShorted($short, $this->paginateItem);
        }
        $shortCategory = $category;
        return view('site.index', compact('posts', 'categories', 'shortCategory'));
    }

    public function subCategoryProducts($cate, $subCategory)
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $subCategory = SubCategory::whereSlug($subCategory)->first();
        $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->where('sub_category_id', $subCategory->id)
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            $short = $_GET['short'];
            $posts = $subCategory->subCategoryPostsByShorted($short, $this->paginateItem);
        }

        $selectedCategory = $cate;
        $selectedSubCategory = $subCategory->slug;
        return view('site.index', compact('posts', 'categories', 'selectedCategory', 'selectedSubCategory'));
    }

    public function allCategoryProducts()
    {
        $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        $categories = Category::orderBy('id', 'asc')->get();
        $allSubCategories = SubCategory::orderBy('id', 'asc')->get();
        return view('site.index', compact('posts', 'categories', 'allSubCategories'));
    }

    public function shortedPosts()
    {
        if (isset($_GET['short'])) {
            $short = $_GET['short'] == 'newest' ? 'desc' : 'asc';
            return $posts = Post::where('expire_date', '>=', Carbon::now())->orderBy('created_at', $short)->get();
        }
    }
}