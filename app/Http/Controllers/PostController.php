<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Post::all()->sortByDesc('created_at');
        return view('post.index', compact('posts'));
    }
    public function show($post = null) {
        if ($post == null) {
            return redirect("/posts");
        }
        $post = \App\Post::where("slug", $post)->firstOrFail();
        return view('post.show', compact('post'));
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

    public function destroy() {}


}
