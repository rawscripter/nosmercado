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

        return view('site.index', compact('posts', 'categories'));
    }

    public function subCategoryProducts($subCategory)
    {
        $categories = Category::orderBy('id', 'asc')->get();
        $subCategory = SubCategory::whereSlug($subCategory)->first();
        $posts = Post
            ::where('expire_date', '>=', Carbon::now())
            ->where('sub_category_id', $subCategory->id)
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);

        return view('site.index', compact('posts', 'categories'));
    }

    public function filerPosts(Request $request)
    {
        $categories = Category::orderBy('id', 'asc')->get();
        if (!empty($request->subcategory)) {
            $subCategory = SubCategory::whereSlug($request->subcategory)->first();
            $filterSubCategory = $this->filterAbleSubCategories($request->category);
            $posts = Post
                ::where('expire_date', '>=', Carbon::now())
                ->where('sub_category_id', $subCategory->id)
                ->orderBy(DB::raw('RAND()'))
                ->paginate($this->paginateItem);

            if (isset($_GET['short']) && !empty($_GET['short'])) {
                $short = $this->getShortAbleColumnAndOrder();
                $posts = Post
                    ::where('expire_date', '>=', Carbon::now())
                    ->where('sub_category_id', $subCategory->id)
                    ->orderBy($short['column'], $short['order'])
                    ->paginate($this->paginateItem);
            }
            return view('site.index', compact('posts', 'categories', 'filterSubCategory'));
        }

        if (!empty($request->category)) {
            if ($request->category == 'tur-advertencia') {
                $filterSubCategory = $this->filterAbleSubCategories($request->category);
                $posts = Post
                    ::where('expire_date', '>=', Carbon::now())
                    ->orderBy(DB::raw('RAND()'))
                    ->paginate($this->paginateItem);

                if (isset($_GET['short']) && !empty($_GET['short'])) {
                    $short = $this->getShortAbleColumnAndOrder();
                    $posts = Post
                        ::where('expire_date', '>=', Carbon::now())
                        ->orderBy($short['column'], $short['order'])
                        ->paginate($this->paginateItem);
                }

            } else {
                $category = Category::whereSlug($request->category)->first();
                $filterSubCategory = $this->filterAbleSubCategories($request->category);
                $posts = Post
                    ::where('expire_date', '>=', Carbon::now())
                    ->where('category_id', $category->id)
                    ->orderBy(DB::raw('RAND()'))
                    ->paginate($this->paginateItem);


                if (isset($_GET['short']) && !empty($_GET['short'])) {
                    $short = $this->getShortAbleColumnAndOrder();
                    $posts = Post
                        ::where('expire_date', '>=', Carbon::now())
                        ->where('category_id', $category->id)
                        ->orderBy($short['column'], $short['order'])
                        ->paginate($this->paginateItem);
                }
            }
        }

        if (isset($_GET['short']) && !empty($_GET['short']) && empty($request->category)) {
            $filterSubCategory = null;
            $short = $this->getShortAbleColumnAndOrder();
            $posts = Post
                ::where('expire_date', '>=', Carbon::now())
                ->orderBy($short['column'], $short['order'])
                ->paginate($this->paginateItem);
        }


        return view('site.index', compact('posts', 'categories', 'filterSubCategory'));
    }

    public function filterAbleSubCategories($category)
    {
        if (!empty($category)) {
            if ($category == 'tur-advertencia') {
                return $filterSubCategory = SubCategory::all();
            } else {
                $category = Category::whereSlug($category)->first();
                return $category->subCategories;
            }
        }
        return '';
    }

    public function getShortAbleColumnAndOrder()
    {
        if ($_GET['short'] == 'most-viewed') {
            $res['column'] = 'clicks';
            $res['order'] = 'desc';
        } else if ($_GET['short'] == 'newest') {
            $res['column'] = 'created_at';
            $res['order'] = 'desc';
        } else if ($_GET['short'] == 'price-high-to-low') {
            $res['column'] = 'price';
            $res['order'] = 'desc';
        } else if ($_GET['short'] == 'price-low-to-high') {
            $res['columnv'] = 'price';
            $res['order'] = 'asc';
        } else {
            $res['column'] = 'created_at';
            $res['order'] = 'asc';
        };

        return $res;
    }


}
