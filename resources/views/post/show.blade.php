@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="post_container">
        <div class="post">

            <img class="post_thumbnail" src="{{$post->image}}" alt="{{$post->title}}">

            <div class="post_container">
                <br>
                <p class="timestamp">{{$post->created_at}}</p>
                <h1>{{$post->title}}</h1>

                {!!$post->body!!}
                <br>
                <hr><br>
                <br>
                <a href="/posts" class="btn readMore">Go Back</a>
                <br><br>
            </div>
            <br>
        </div>
    </div>


    <div class="sidebar_container">
        <div class="sidebar">
            <h3>Links</h3>
            <ul style="list-style: none;">
                <li><a class="sidebar_link" href="#"><i class="fab fa-github"></i> Github</a></li>
                <li><a class="sidebar_link" href="#"><i class="fas fa-envelope-square"></i> Contact</a></li>
            </ul>
            <hr>

            @isset($category)
            <small><em>Project:</em></small>
            <br><br>
            <a class="sidebar_post" href="/category/{{$category->title}}">
                <img class="sidebar_post_image" src="{{$category->image}}" />
                <div class="sidebar_post_content">
                    <h4>{{$category->title}}</h4>
                    <em>{{strip_tags(Str::limit($category->body, 50))}}</em>
                </div>
            </a>
            <hr>
            @endisset

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
