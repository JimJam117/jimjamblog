<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Post::orderBy('updated_at', 'DESC')->paginate(3);
        $recent_post = $posts->first();

        $categories = \App\Category::all()->sortByDesc('updated_at');
        $recent_category = $categories->first();



        return view('post.index', compact('posts', 'recent_category', 'recent_post'));
    }


    public function show($post = null) {
        // if the post is null return a redirect
        if ($post == null) {
            return redirect("/posts");
        }

        //grab the post
        $post = \App\Post::where("slug", $post)->firstOrFail();

        // grab the most recent post, if it is the same as the $post then find the next most recent one
        $posts = \App\Post::all()->sortByDesc('updated_at');
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
        $categories = \App\Category::all();

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

        $categories = \App\Category::all();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update($post){
        // get user and authorize
        $post = \App\Post::where('slug', $post)->firstOrFail();

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

    public function destroy() {}


}
