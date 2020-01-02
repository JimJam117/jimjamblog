<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class CategoryController extends Controller
{
    //
    public function index() {
        $categories = \App\Category::all();
        return view('category.index', compact('categories'));
    }

    public function show($category = null) {
        if ($category == null) {
            return redirect("/categories");
        }
        $category = \App\Category::where("title", $category)->firstOrFail();
        return view('category.show', compact('category'));
    }

    public function create() {
        return view('category.create');
    }

    public function store() {
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
        

        
        
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        \App\Category::create([
            'title' => $data['title'],
            'body' => Purifier::clean($data['body']),

            'image' => null,
        ]);


        return redirect("/categories");
    }
}
