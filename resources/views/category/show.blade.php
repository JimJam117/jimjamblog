@extends('layouts.frontend')
@section('content')
<div class="post">

    <img class="post_thumbnail" src="{{$category->image}}" alt="{{$category->title}}">
  
<div class="post_container">
  <br>
  <p class="timestamp">{{$category->created_at}}</p>
<h1>{{$category->title}}</h1>

{!!$category->body!!}
 
    <br><hr><br>
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
@endsection