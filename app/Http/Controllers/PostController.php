<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class PostController extends Controller
{
    function paginatePosts($paginate) {
        return \App\Post::orderBy('updated_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    function paginateCategories($paginate){
        return \App\Category::orderBy('updated_at', 'DESC')->where("deleted_at", null)->paginate($paginate);
    }
    private function allPosts(){
        return \App\Post::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
    } 
    private function allCategories() {
        return \App\Category::orderBy('updated_at', 'DESC')->where("deleted_at", null)->get();
    }
    


    public function index()
    {
        $posts = self::paginatePosts(3);
        $recent_post = $posts->first();

        $categories = self::allCategories();
        $recent_category = $categories->first();



        return view('post.index', compact('posts', 'recent_category', 'recent_post'));
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

        return view('post.show', compact('post', 'recent_post', 'category'));
    }

    public function create() {
        $categories = self::allCategories();

        return view('post.create', compact('categories'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'nullable',
            'image' => 'nullable|image',

        ]);


        if ($data['image']) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            auth()->user()->posts()->create([
                'title' => $data['title'],
                'body' => Purifier::clean($data['body']),
                'slug' => $data['slug'],
                'category_id' => $data['category_id'],
    
                'image' => $imgPathWithStorage,
            ]);
        }
        else{
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        auth()->user()->posts()->create([
            'title' => $data['title'],
            'body' => Purifier::clean($data['body']),
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],

            'image' => null,
        ]);

        }
   
        

        return redirect("/posts");
        
    }

    public function edit($post) {    
        // get user and authorize
        $post = \App\Post::where('slug', $post)->firstOrFail();

        $categories = self::allCategories();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update($post){
        // get user and authorize
        $post = \App\Post::where('slug', $post)->whereNull('deleted_at')->firstOrFail();

       $data = request()->validate([
        'title' => 'required',
        'body' => 'required',
        'slug' => 'required',
        'category_id' => 'nullable',
        'image' => 'nullable|image',

       ]);

       //$imgPath = request('image')->store('uploads', 'public');
       if (request('image')) {
           $imgPath = request('image')->store('uploads', 'public');

           // adds the storage dir to the front of the path
           $imgPathWithStorage = '/storage/' . $imgPath;

           $post->update([
               'title' => $data['title'],
               'body' => Purifier::clean($data['body']),
               'slug' => $data['slug'],
               'category_id' => $data['category_id'],

               'image' => $imgPathWithStorage,
           ]);
       }
       else{
       // create post assoc with auth'd user
       // uses validated $data var items and also the image path
       $post->update([
        'title' => $data['title'],
        'body' => Purifier::clean($data['body']),
        'slug' => $data['slug'],
        'category_id' => $data['category_id'],

       ]);

       }
       
       

       return redirect("/post/$post->slug");
   }

   public function delete_confirm($post) {
        $post = \App\Post::where('slug', $post)->whereNull('deleted_at')->firstOrFail();
        return view('confirm-delete', compact('post'));
   }

    public function destroy($post) {
        $post = \App\Post::where('slug', $post)->whereNull('deleted_at')->firstOrFail();
        $post->delete();
        return redirect('/blog');
    }


}
