<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class CategoryController extends Controller
{
    public $purifierAllowedElements = 'div,h1,h2,h3,h4,h5,h6,code,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]';


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

    public function backend() {
        $categories = \App\Category::all();
        return view('category.backend', compact('categories'));
    }

    //
    public function index() {
        $posts = self::allPosts();
        $recent_post = $posts->first();

        $categories = self::paginateCategories(3);
        $recent_category = $categories->first();

        return view('category.index', compact('categories', 'recent_post', 'recent_category'));
    }

    public function show($category = null) {
        if ($category == null) {
            return redirect("/categories");
        }
        $category = \App\Category::where("title", $category)->whereNull('deleted_at')->firstOrFail();

        
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

        $categories = self::paginateCategories(3);
        $recent_category = $categories->first();        

        return view('category.show', compact('category', 'recent_posts', 'recent_post', 'recent_category'));
    }

    public function create() {
        return view('category.create');
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required|unique:categories',
            'emoji_name' => 'required',
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
                'emoji_name' => $data['emoji_name'],
                'body' => Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements)),

                'image' => $imgPathWithStorage,
            ]);
        }
        else{
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        \App\Category::create([
            'title' => $data['title'],
            'emoji_name' => $data['emoji_name'],
            'body' => Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements)),

            'image' => null,
        ]);

        }
        


        return redirect("/categories");
    }

    public function edit($category) {    
        // get user and authorize
        $category = \App\Category::where('title', $category)->whereNull('deleted_at')->firstOrFail();
        return view('category.edit', compact('category'));
    }

    public function update($category){
         // get user and authorize
         $category = \App\Category::where('title', $category)->whereNull('deleted_at')->firstOrFail();

        $data = request()->validate([
            'title' => 'required',
            'emoji_name' => 'required',
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
                'emoji_name' => $data['emoji_name'],
                'body' => Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements)),

                'image' => $imgPathWithStorage,
            ]);
        }
        else{
        // create post assoc with auth'd user
        // uses validated $data var items and also the image path
        $category->update([
            'title' => $data['title'],
            'emoji_name' => $data['emoji_name'],
            'body' => Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements)),

        ]);

        }
        


        return redirect("/category/$category->title");
    }


    public function delete_confirm($category) {
        $category = \App\Category::where('title', $category)->whereNull('deleted_at')->firstOrFail();
        return view('confirm-delete', compact('category'));
   }

    public function destroy($category) {
        $category = \App\Category::where('title', $category)->whereNull('deleted_at')->firstOrFail();
        $category->delete();
        return redirect('/blog');
    }
}
