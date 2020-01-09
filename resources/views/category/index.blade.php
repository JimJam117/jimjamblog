@extends('layouts.frontend')
@section('content')

<div class="banner">
    <h3>
        Projects
    </h3>
    <p>
        Here are some of the categories that the blog posts are about. These can be either projects I am working on
        and have made multiple posts about or just topics in general which some undirectly related posts are grouped
        together.
    </p>
</div>

<div class="container">
    
    <div class="posts_container">
        @foreach($categories as $category)
        <a href="\category\{{$category->title}}" class="unlinkStyle">
            <div class="section post">
                <div class="post_thumbnail" style="background-image: url('{{$category->image}}');"
                    alt="{{$category->title}}"></div>
                <div class="post_container">

                    <div class="timestamp">{{$category->created_at}}</div>

                    <h1>{{$category->title}}</h1>

                    <em>{{strip_tags(Str::limit($category->body, 100))}}</em>
                    <br>
                    <br>
                </div>

            </div>
        </a>
        @endforeach
    </div>
    <div class="sidebar_container">
        <div class="sidebar">
            <h3>Links</h3>
            <ul style="list-style: none;">
                <li><a class="sidebar_link" href="#"><i class="fab fa-github"></i> Github</a></li>
                <li><a class="sidebar_link" href="#"><i class="fas fa-envelope-square"></i> Contact</a></li>
            </ul>
            <hr>

            <small><em>Recent Post:</em></small>
            <br><br>
            <a class="sidebar_post" href="/post/{{$recent_post->slug}}">
                <img class="sidebar_post_image" src="{{$recent_post->image}}" />
                <div class="sidebar_post_content">
                    <h4>{{$recent_post->title}}</h4>
                    <em>{{strip_tags(Str::limit($recent_post->body, 50))}}</em>
                </div>
            </a>
        </div>
    </div>



</div>
@endsection
