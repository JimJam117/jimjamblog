@extends('layouts.base')

@section('search')
<div class="form-group search">
    <form method="POST" action="/search">
        @csrf
        <button type="submit" class="searchButton"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="query" class="form-control searchInput" id="exampleInputName2"
            placeholder="Search...">
    </form>
</div>
@endsection

@section('content')
@yield('banner')
<div class="container">
    <div class="posts_container">
        @yield('posts_content')
    </div>

    <!--sidebar-->
    <div class="sidebar_container">
        <div class="sidebar">
            <h3><i class="fas fa-link"></i> Links</h3>
            <ul style="list-style: none;">
                <li><a class="btn sidebar-btn" href="/github"><i class="fab fa-github"></i> Github</a></li>
                <li><a class="btn sidebar-btn" href="/contact"><i class="fas fa-envelope-square"></i> Contact</a></li>
            </ul>
            <hr>
            <br>
            <h3><i class="fas fa-project-diagram"></i> Projects</h3>
            <a class="sidebar_post" href="/category/{{$recent_category->title}}">
                <img class="sidebar_post_image" src="{{$recent_category->image}}"/>
                <div class="sidebar_post_content">
                    <h4>{{$recent_category->title}}</h4>
                    <em>{{strip_tags(Str::limit($recent_category->body, 50))}}</em>
                </div>
            </a>   
            <br>
            <a style="text-decoration: none" href="/categories"><strong>View All Projects</strong></a> 

            <hr>
            <br>
            <h3><i class="fas fa-pen"></i> Posts</h3>
            <a class="sidebar_post" href="/post/{{$recent_post->slug}}">
                <img class="sidebar_post_image" src="{{$recent_post->image}}"/>
                <div class="sidebar_post_content">
                    <h4>{{$recent_post->title}}</h4>
                    <em>{{strip_tags(Str::limit($recent_post->body, 50))}}</em>
                </div>
            </a>   
            <br>
            <a style="text-decoration: none" href="/posts"><strong>View All Posts</strong></a> 
        </div>
    </div>
    <!--sidebar-->
</div>    


@endsection