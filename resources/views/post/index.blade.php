@extends('layouts.frontend')

@section('content')
<div class="banner">
    <h2>Blog</h2>
</div>
<div class="container">
    <div class="posts_container">
        @foreach($posts as $post)
        <a href="\post\{{$post->slug}}" class="unlinkStyle">
            <div class="section post">
                <div class="post_thumbnail" style="background-image: url('{{$post->image}}');" alt="{{$post->title}}">
                </div>
                <div class="post_container">
                    <br>
                    <p class="timestamp">{{$post->created_at}} by {{$post->user->name}}</p>

                    <h1>{{$post->title}}</h1>

                    <em>{{strip_tags(Str::limit($post->body, 100))}}</em>
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
            <small><em>Recent Project:</em></small>
            <br><br>
            <a class="sidebar_post" href="/post/{{$recent_category->slug}}">
                <img class="sidebar_post_image" src="{{$recent_category->image}}"/>
                <div class="sidebar_post_content">
                    <h4>{{$recent_category->title}}</h4>
                    <em>{{strip_tags(Str::limit($recent_category->body, 50))}}</em>
                </div>
            </a>    
        </div>
    </div>
</div>
@endsection
