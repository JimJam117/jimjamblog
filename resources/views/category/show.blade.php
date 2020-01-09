@extends('layouts.frontend')
@section('content')
<div class="container">
        <div class="post">
            <img class="post_thumbnail" src="{{$category->image}}" alt="{{$category->title}}">
            <div class="post_container">
                <br>
                <p class="timestamp">{{$category->created_at}}</p>
                <h1>{{$category->title}}</h1>
                {!!$category->body!!}
                <br>
                <hr><br>
                Posts:
                <br>
                @foreach ($category->posts as $post)
                <a href="/post/{{$post->slug}}">{{$post->title}}</a>
                @endforeach
                <hr>
                <br>
                <a href="/categories" class="btn readMore">Go Back</a>
                <br><br>
            </div>
            <br>
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
            
            <!--<a href="/category/{{$category->title}}/all">All Posts within this project</a>-->
            <br>

        </div>
    </div>
</div>


@endsection
