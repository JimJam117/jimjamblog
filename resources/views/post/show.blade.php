@extends('layouts.frontend')
@section('content')
<h1>Post: {{$post->title}}</h1>
{{$post->body}}
<img src="{{$post->image}}" alt="">
@endsection