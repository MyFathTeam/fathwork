<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;
use App\Models\Blog\PostCategory;
use App\Models\Master\Product;
use App\Models\Master\ProductCategory;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        // if (config('config.site.enable_site')) {
        //     return \Site::view('index');
        // }

        return redirect()->route('app');
    }
    
    public function index(Request $request)
    {
        $data_front_end = $this->getDataFrontEnd($request);
    $social_network = $data_front_end['social_network'] ?? [];
    $general = $data_front_end['general'] ?? [];
    $copyright = $data_front_end['copyright'] ?? [];
    $footer = $data_front_end['footer'] ?? [];
    
        try {
            $posts = Schema::hasTable('posts') ? Post::with('postcategory')->orderBy('id', 'DESC')->limit(4)->get() : collect();
        } catch (QueryException $e) {
            $posts = collect();
        }
    
        try {
            $products = Schema::hasTable('products') ? Product::with('productcategory')->orderBy('id', 'DESC')->limit(4)->get() : collect();
        } catch (QueryException $e) {
            $products = collect();
        }
    
        try {
            $projects = Schema::hasTable('projects') ? Project::orderBy('id', 'DESC')->limit(4)->get() : collect();
        } catch (QueryException $e) {
            $projects = collect();
        }
    
        $data = [
          'social_network' => $social_network,
        'general' => $general,
        'copyright' => $copyright,
        'footer' => $footer,
        'posts' => $posts,
        'products' => $products,
        'projects' => $projects,
        ];
    
        return view('landing.pages.home', $data);
    }
    

    public function products(Request $request){
        $productcategories = ProductCategory::orderBy('id', 'ASC')->get();
        $selectedProductcategoryId = $request->input('productcategory');
    
        $productsQuery = Product::with('productcategory')->orderBy('id', 'DESC');
    
        if ($selectedProductcategoryId !== null) {
            $productsQuery->where('product_category_id', $selectedProductcategoryId);
        }
    
        $products = $productsQuery->paginate(6);
    
        return view('landing.pages.product', compact('products', 'productcategories', 'selectedProductcategoryId'));
    }

    public function posts(Request $request){
        $postcategories = PostCategory::orderBy('id', 'ASC')->get();
        $selectedPostcategoryId = $request->input('postcategory');
    
        $postsQuery = Post::with('postcategory')->orderBy('id', 'DESC');
    
        if ($selectedPostcategoryId !== null) {
            $postsQuery->where('post_category_id', $selectedPostcategoryId);
        }
    
        $posts = $postsQuery->paginate(6);
    
        return view('landing.pages.post', compact('posts', 'postcategories', 'selectedPostcategoryId'));
    }

    public function projects(Request $request){
    
        $projects = Project::orderBy('id', 'DESC')->paginate(6);

        return view('landing.pages.project', compact('projects'));
    }

    public function productdetail($uuid, Request $request){ 
        $product = Product::where('uuid',$uuid)->first(); 
        $productcategory = Product::orderBy('id', 'desc')->where('product_category_id',$product->product_category_id)->limit(3)->get(); 
        $product_category_id = $product->product_category_id; 
        return view('landing.pages.product-detail', compact('product', 'productcategory', 'product_category_id')); 
    }

    public function projectdetail($uuid, Request $request){ 
        $project = Project::where('uuid',$uuid)->first(); 
        return view('landing.pages.project-detail', compact('project')); 
    }

    public function postdetail($uuid, Request $request)
    {
    $post = Post::where('uuid', $uuid)->first();
    
    if ($post) {
        $postcategory = Post::where('post_category_id', $post->post_category_id)->limit(3)->get();
        $post_category_id = $post->post_category_id;

        return view('landing.pages.post-detail', compact('post', 'postcategory', 'post_category_id'));
    } else {
        abort(404);
    }
    }

    public function demo(){  
        return view('landing.pages.demo'); 
    }
}