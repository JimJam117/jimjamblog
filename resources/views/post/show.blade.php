@extends('layouts.frontend')
@section('content')
<div class="post">

    <img class="post_thumbnail" src="{{$post->image}}" alt="{{$post->title}}">
  
<div class="post_container">
  <br>
  <p class="timestamp">{{$post->created_at}}</p>
<h1>{{$post->title}}</h1>

{!!$post->body!!}
 
    <br><hr><br>
<br>
            <a href="/posts" class="btn readMore">Go Back</a>
<br><br>


</div>

<br>

</div>
@endsection