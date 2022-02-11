@extends('layouts.backend')

@section('title')
Categories
@endsection

@section('content')
<h1 class="portfolio-title" style="font-size: 3rem;">Categories Backend</h1>


@foreach ($categories as $category)
<div class="backend-list-item">
    <div class="endSection">
        <button onclick="location.href='/category/{{$category->title}}/delete-confirm';"
            class="backend-button" style="background-color:#a00;">X</button>
        <button onclick="location.href='/category/{{$category->title}}/edit';" class="backend-button"><i
                class="fas fa-pen"></i></button>
    </div>
    <h1>{{$category->title}}</h1>
</div>
@endforeach


@auth
<style>
    .unfinished,
    .unfinished:hover {
        background-color: #595959;
        color: grey;
    }

</style>
@endauth

@guest
<style>
    .unfinished,
    .unfinished:hover {
        display: none;
    }

</style>
@endguest

@endsection
