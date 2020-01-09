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
    
</div>
@endsection
