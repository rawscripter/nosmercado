<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    protected $paginateItem = 12;

    public function index()
    {
        $posts = Post
            ::where('status', '=', 1)
            ->where('expire_date', '>=', Carbon::now())
            ->orderBy('priority', 'desc')
            ->orderBy('clicks', 'desc')  #order by fitness desc,  fitness = current clicks / ( post with max clicks )   +  1 - ( current minutes / max minutes (60*24*30) )
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            // if GET['short'] param is set then run this query.
            $short = $this->filterGetRequest();
            $posts = Post
                ::where('status', '=', 1)
                ->where('expire_date', '>=', Carbon::now())
                ->orderBy($short['column'], $short['value'])
                ->paginate($this->paginateItem);
        }
        return view('site.index', compact('posts'));
    }

    public function categoryProducts($category)
    {
        $category = Category::whereSlug($category)->first();
        $posts = Post
            ::where('status', '=', 1)
            ->where('expire_date', '>=', Carbon::now())
            ->where('category_id', $category->id)
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            $short = $_GET['short'];
            $posts = $category->categoryPostsByShorted($short, $this->paginateItem);
        }
        $shortCategory = $category;
        return view('site.index', compact('posts', 'shortCategory'));
    }

    public function allCategoryProducts()
    {
        $posts = Post
            ::where('status', '=', 1)
            ->where('expire_date', '>=', Carbon::now())
            ->orderBy(DB::raw('RAND()'))
            ->paginate($this->paginateItem);
        return view('site.index', compact('posts'));
    }

    public function postSearch()
    {
        $query = $_GET['query'];
        if (empty($query))
            return redirect()->route('home');
        $posts = Post
            ::where('status', '=', 1)
            ->where('expire_date', '>=', Carbon::now())
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate($this->paginateItem);
        if (isset($_GET['short'])) {
            $short = $this->filterGetRequest();
            $posts = Post
                ::where('status', '=', 1)
                ->where('expire_date', '>=', Carbon::now())
                ->where('title', 'LIKE', "%{$query}%")
                ->orderBy($short['column'], $short['value'])
                ->orderBy(DB::raw('RAND()'))
                ->paginate($this->paginateItem);
        }
        $posts->appends(['query' => $query]);
        return view('site.index', compact('posts'));
    }

    public function shortedPosts()
    {
        if (isset($_GET['short'])) {
            $short = $_GET['short'] == 'newest' ? 'desc' : 'asc';
            return $posts = Post::where('status', '=', 1)->where('expire_date', '>=', Carbon::now())->orderBy('created_at', $short)->get();
        }
        return false;
    }

    public function filterGetRequest()
    {
        if ($_GET['short'] == 'mas-mira') {
            $res['column'] = 'clicks';
            $res['value'] = 'desc';
        } else if ($_GET['short'] == 'mas-nobo') {
            $res['column'] = 'created_at';
            $res['value'] = 'desc';
        } else if ($_GET['short'] == 'mas-caro') {
            $res['column'] = 'price';
            $res['value'] = 'desc';
        } else if ($_GET['short'] == 'mas-barata') {
            $res['column'] = 'price';
            $res['value'] = 'asc';
        } else {
            $res['column'] = 'created_at';
            $res['value'] = 'asc';
        };
        return $res;
    }
}
