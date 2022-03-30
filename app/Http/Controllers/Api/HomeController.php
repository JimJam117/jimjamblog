<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Purifier;

class HomeController extends Controller
{
    public $purifierAllowedElements = 'div,h1,h2,h3,h4,h5,h6,code,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]';

   

    public function index() {
        $posts = self::paginatePosts(5);
        $all_posts = self::allPosts();
        $recent_post = $all_posts->first();

        $categories = self::allCategories();
        $recent_category = $categories->first();

        return (compact('posts', 'recent_category', 'recent_post'));
    }


    public function show($post = null) {
        // if the post is null return a redirect
        if ($post == null) {
            return redirect("/posts");
        }

        //grab the post
        $post = \App\Post::where("slug", $post)->whereNull('deleted_at')->firstOrFail();

        // grab the most recent post, if it is the same as the $post then find the next most recent one
        $posts = self::allPosts();
        $recent_post = $posts->first();
        foreach ($posts as $item) {
            if($item->slug != $post->slug) {
                $recent_post = $item;
                break;
            }
        }


        $category = null;
        if($post->category != null) {
            $category = $post->category;
        }

        return (compact('post', 'recent_post', 'category'));
    }

}
