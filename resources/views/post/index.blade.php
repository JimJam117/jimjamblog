@extends('layouts.frontend')
@section('content')
<h1>All Posts:</h1>
<hr>
@foreach($posts as $post)
<a href="\post\{{$post->slug}}">
    <h1>{{$post->title}}</h1>
    <small>By: {{$post->user->name}}</small>
    <p>{{$post->body}}</p>
    
    <hr>
</a>

@endforeach
@endsection
