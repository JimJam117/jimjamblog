@extends('layouts.blog')
@section('title')
{{$category->title}}
@endsection

@section('content')

<div class="container">
    <div class="post">
        <img class="post_thumbnail" src="{{$category->image}}" alt="{{$category->title}}">
        <div class="post_container">
            <br>
            <p class="timestamp">{{$category->created_at}}</p>
            @auth
            <div class="endSection">
                <button onclick="location.href='/category/{{$category->title}}/delete-confirm';"
                    class="social-button">X</button>
                <button onclick="location.href='/category/{{$category->title}}/edit';" class="social-button"><i
                        class="fas fa-pen"></i></button>
            </div>

            @endauth
            <h1>{{$category->title}}</h1>
            {!!$category->body!!}
            <br>
            <hr><br>
            @if($category->posts->count() > 0)
            Posts:
            <br>
            <hr>
            @foreach ($category->posts as $post)
            <a href="/post/{{$post->slug}}">{{$post->title}}</a>
            @endforeach
            @endif
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
                <li><a class="btn sidebar-btn" href="/github"><i class="fab fa-github"></i> Github</a></li>
                <li><a class="btn sidebar-btn" href="/contact"><i class="fas fa-envelope-square"></i> Contact</a></li>
            </ul>
            <hr>
            <br>
            <h3><i class="fas fa-pen"></i> Recent Post</h3>
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
