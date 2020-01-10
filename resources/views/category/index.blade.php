@extends('layouts.standard')

@section('title')
    Projects
@endsection

@section('banner')
<div class="banner">
    <h2>Projects</h2>
    <p>
        Here are some of the categories that the blog posts are about. These can be either projects I am working on
        and have made multiple posts about or just topics in general which some undirectly related posts are grouped
        together.
    </p>
</div>
@endsection

@section('posts_content')
@foreach($categories as $category)
<a href="\category\{{$category->title}}" class="unlinkStyle">
    <div class="section post_link">
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
@endsection
