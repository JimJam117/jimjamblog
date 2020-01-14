<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class CategoryController extends Controller
{
    //
    public function index() {
        $posts = \App\Post::all()->sortByDesc('updated_at');
        $recent_post = $posts->first();

        $categories = \App\Category::orderBy('updated_at', 'DESC')->paginate(3);
        $recent_category = $categories->first();
        return view('category.index', compact('categories', 'recent_post', 'recent_category'));
    }

    public function show($category = null) {
        if ($category == null) {
            return redirect("/categories");
        }
        $category = \App\Category::where("title", $category)->firstOrFail();

        
        $recent_posts = \App\Post::where('category_id', $category->id)->get()->sortByDesc('updated_at');
        $posts = \App\Post::all()->sortByDesc('updated_at');
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

        $categories = \App\Category::orderBy('updated_at', 'DESC')->paginate(3);
        $recent_category = $categories->first();        

        return view('category.show', compact('category', 'recent_posts', 'recent_post', 'recent_category'));
    }

    public function create() {
        return view('category.create');
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required|unique:categories',
            'body' => 'required',
            'image' => 'nullable|image',

        ]);

        //$imgPath = request('image')->store('uploads', 'public');
        if ($data['image']) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            \App\Category::create([
                'title' => $data['title'],
                'body' => Purifier::clean($data['body']),

                'image' => $imgPathWithStorage,
            ]);
        }
        else{
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        \App\Category::create([
            'title' => $data['title'],
            'body' => Purifier::clean($data['body']),

            'image' => null,
        ]);

        }
        


        return redirect("/categories");
    }

    public function edit($category) {    
        // get user and authorize
        $category = \App\Category::where('title', $category)->firstOrFail();
        return view('category.edit', compact('category'));
    }

    public function update($category){
         // get user and authorize
         $category = \App\Category::where('title', $category)->firstOrFail();

        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',

        ]);

        //$imgPath = request('image')->store('uploads', 'public');
        if (request('image')) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            $category->update([
                'title' => $data['title'],
                'body' => Purifier::clean($data['body']),

                'image' => $imgPathWithStorage,
            ]);
        }
        else{
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        $category->update([
            'title' => $data['title'],
            'body' => Purifier::clean($data['body']),

            'image' => null,
        ]);

        }
        


        return redirect("/category/$category->title");
    }
}
