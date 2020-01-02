@extends('layouts.frontend')
@section('content')
<h1>All Categories:</h1>
<hr>
@foreach($categories as $category)
<a href="\category\{{$category->title}}">
    <h1>{{$category->title}}</h1>
    <p>{{$category->body}}</p>
    
    <hr>
</a>

@endforeach
@endsection
