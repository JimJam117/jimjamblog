@extends('layouts.backend')

@section('title')
    Confirm Delete
@endsection

@section('content')

@isset($post)
<form action="/post/{{$post->slug}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$post->title}}</h1>
    <p>Are you sure you want to delete this post?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

@isset($category)
<form action="/category/{{$category->title}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$category->title}}</h1>
    <p>Are you sure you want to delete this category?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

@isset($portfolio)
<form action="/portfolio/{{$portfolio->id}}" method="POST">
    @csrf
    @method('DELETE')

    <h1>Confrim deleting {{$portfolio->title}}</h1>
    <p>Are you sure you want to delete this portfolio?</p>
    <button type="submit">Confirm</button>
</form>
@endisset

    
@endsection

@section('extra-scripts')
   <style>
    button{
        background-color: #bf3737;
color: white;
padding: 1em;
margin: 1em;
    }   
    </style> 
@endsection