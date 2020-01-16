@extends('layouts.blog')

@section('title')
    Blog
@endsection



@section('posts_content')
@foreach($posts as $post)
<a href="\post\{{$post->slug}}" class="unlinkStyle">
    <div class="section post_link">
        <div class="post_thumbnail" style="background-image: url('{{$post->image}}');" alt="{{$post->title}}">
        </div>
        <div class="post_container">
            <br>
            <p class="timestamp">{{$post->created_at}} by {{$post->user->name}}</p>

            <h1>{{$post->title}}</h1>

            <em>{{strip_tags(Str::limit($post->body, 200))}}</em>
            <br>
            <br>
        </div>

    </div>
</a>
@endforeach

{{$posts->links()}}
@endsection

@section('extra-scripts')
    <style>
        .posts_container {
            width: 100%;
        }
    </style>
@endsection