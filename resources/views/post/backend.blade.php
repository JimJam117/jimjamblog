@extends('layouts.backend')

@section('title')
Posts
@endsection

@section('content')
<h1 class="portfolio-title" style="font-size: 3rem;">Posts Backend</h1>

@foreach ($posts as $post)
<div class="backend-list-item">
    <div class="endSection">
        <button onclick="location.href='/post/{{$post->slug}}/delete-confirm';"
            class="backend-button" style="background-color:#a00;">X</button>
        <button onclick="location.href='/post/{{$post->slug}}/edit';" class="backend-button"><i
                class="fas fa-pen"></i></button>
    </div>
    <h1>{{$post->title}}</h1>
    <p>{{$post->slug}}</p>
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
