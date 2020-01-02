@extends('layouts.frontend')
@section('content')
<h1>Post: {{$category->title}}</h1>
{{$category->body}}
<img src="{{$category->image}}" alt="">
@endsection