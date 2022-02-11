<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class RSSFeedController extends Controller
{
    public function main_feed() {

        $posts = Post::orderBy('created_at', 'DESC')->where("deleted_at", null)->get();

        return response()->view('rss', compact('posts'))->header('Content-Type', 'application/xml');
    }
}
