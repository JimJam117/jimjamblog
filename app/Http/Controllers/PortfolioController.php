<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Portfolio;
use Purifier;


class PortfolioController extends Controller
{
    public $purifierAllowedElements = 'div,h1,h2,h3,h4,h5,h6,code,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]';

    public function index() {
        dd(\App\Portfolio::all());
    }




    public function create() {
        return view('portfolio.create');
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
            'revealed_title' => 'required',
            'revealed_body' => 'required',
            'revealed_image' => 'nullable|image',
            'features' => 'string',
            'link_to_site' => 'nullable',
            'link_to_source' => 'nullable',
            'link_to_blog' => 'nullable',

        ]);

        $purified_body = Purifier::clean($data['body'], array('HTML.Allowed' => $this->purifierAllowedElements));
        $purified_revealed_body = Purifier::clean($data['revealed_body'], array('HTML.Allowed' => $this->purifierAllowedElements));
        
        $features_array = explode(";", $data['features']);

        $create_array = [
            'title' => $data['title'],
            'body' => $purified_body,
            'revealed_title' => $data['title'],
            'revealed_body' => $purified_revealed_body,
            'features' => $features_array,
            'link_to_site' => $data['link_to_site'],
            'link_to_source' => $data['link_to_source'],
            'link_to_blog' => $data['link_to_blog'],
        ];

        // if image is provided and a created_at_manual
        if ($data['image']) {
            $imgPath = request('image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgPathWithStorage = '/storage/' . $imgPath;

            //dd($create_array);
            $create_array = array_merge($create_array, ['image' => $imgPathWithStorage]);
        }
        if (isset($data['revealed_image'])) {
            $imgPath = request('revealed_image')->store('uploads', 'public');

            // adds the storage dir to the front of the path
            $imgRevealedPathWithStorage = '/storage/' . $imgPath;

            $create_array = array_merge($create_array, ['revealed_image' => $imgRevealedPathWithStorage]);
        }

       
        Portfolio::create($create_array);
   
        
        return redirect("/portfolio");
        
    }


    

    public function edit() {
        dd(\App\Portfolio::all());
    }

    public function update() {
        dd(\App\Portfolio::all());
    }

    public function delete_confirm() {
        dd(\App\Portfolio::all());
    }
    
    public function destroy() {
        dd(\App\Portfolio::all());
    }
}


