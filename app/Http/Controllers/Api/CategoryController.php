<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Purifier;

class CategoryController extends Controller
{
    public $purifierAllowedElements = 'div,h1,h2,h3,h4,h5,h6,code,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]';

    function paginatePosts($paginate) {
        return \App\Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    function paginateCategories($paginate){
        return \App\Category::orderBy('created_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    private function allPosts(){
        return \App\Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->get();
    } 
    private function allCategories() {
        return \App\Category::orderBy('created_at', 'DESC')->where("deleted_at", null)->get();
    }
    private function allCategoriesAsc() {
        return \App\Category::orderBy('created_at', 'ASC')->where("deleted_at", null)->get();
    }


    public function index() {
        $posts = self::paginatePosts(5);
        $all_posts = self::allPosts();
        $recent_post = $all_posts->first();

        $categories = self::allCategoriesAsc();
        $recent_category = $categories->first();

        return (compact('categories', 'recent_category', 'recent_post'));
    }


    public function categories_all() {
        
        $posts = self::allPosts();
        $categories = self::allCategories();
        return (compact('posts', 'categories'));
    }


    public function show($category = null) {
        if ($category == null) {
            return redirect("/categories");
        }
        $category = \App\Category::where("title", $category)->whereNull('deleted_at')->firstOrFail();

        $posts_in_category = \App\Post::orderBy('created_at', 'DESC')->where("category_id", $category->id)->whereNull('deleted_at')->get();
        
        $recent_posts = self::allPosts();
        $posts = self::allPosts();
        $recent_post = $posts->first();

        // if recent posts is more than 3, cut it down to a max of 3
        if(count($recent_posts) > 3) {
            $newArray = [];
            $i = 0;
            foreach ($recent_posts as $item) {

                if($i < 3) { $newArray[] = $item; $i++;}
                else{ break;} 
            }

            $recent_posts = $newArray;
        }

        $categories = self::allCategories();
        $recent_category = $categories->first();        

        return compact('category', 'recent_posts', 'recent_post', 'recent_category', 'posts_in_category');
    }


}
