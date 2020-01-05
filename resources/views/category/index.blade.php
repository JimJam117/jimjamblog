@extends('layouts.frontend')
@section('content')
<div class="banner">
    <h3>
        Projects
    </h3>
    <p>
        Here are some of the categories that the blog posts are about. These can be either projects I am working on and have made multiple posts about or just topics in general which some undirectly related posts are grouped together.
    </p>
</div>
@foreach($categories as $category)
<a href="\category\{{$category->title}}" class="unlinkStyle">
    <div class="section post">
    <div class="post_thumbnail" style="background-image: url('{{$category->image}}');" alt="{{$category->title}}"></div>
        <div class="post_container">
            <br>
        <p class="timestamp">{{$category->created_at}}</p>
            
            <h1>{{$category->title}}</h1>
            
            <em>{{strip_tags(Str::limit($category->body, 100))}}</em>
            <br>
            <br>
        </div>
        
    </div>
</a>

@endforeach
@endsection


