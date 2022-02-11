@extends('layouts.backend')

@section('title')
Portfolio
@endsection

@section('content')
<h1 class="portfolio-title" style="font-size: 3rem;">Portfolio Backend</h1>

@foreach ($portfolios as $portfolio)
<div class="backend-portfolio">
    <div class="endSection">
        <button onclick="location.href='/portfolio/{{$portfolio->id}}/delete-confirm';"
            class="backend-button" style="background-color:#a00;">X</button>
        <button onclick="location.href='/portfolio/{{$portfolio->id}}/edit';" class="backend-button"><i
                class="fas fa-pen"></i></button>
    </div>
    <h1>{{$portfolio->title}}</h1>
    <p>{{$portfolio->body}}</p>
</div>
@endforeach

@endsection


@section('extra-scripts')

<style>
    .backend-list-item{
        margin: 1em;
        padding: 1em;
        background-color: #ddd;
    }

    html {
        scroll-behavior: smooth;
    }

    .expandable {
        background: #595959;
        overflow: hidden;
        transition: all .5s ease-in-out;
        height: 0;
        padding: 0 1em;
        color: #fff;
    }

    .expandable:target {
        line-height: 1.5;
        padding-top: 1em;
        padding-bottom: 1em;
        margin-bottom: 1em;
        color: #fff;
        height: initial;
    }

    .expandable:target .expandable-image {
        display: block;
    }

    .expandable-image {
        display: none;
    }
    .expandable-image img{
        width: 100%;
    }

    .expandable-top {
        display: flex;
        margin-top: 1em;
    }
    .expandable-top div{
        width: 50%;
    }

    .expandable-middle{
        text-align: center;
    display: flex;
    justify-content: space-evenly;
    padding: 1em;
    flex-wrap: wrap;
    }
    .expandable-middle div{
        padding: 1em;
        color: #dfdfdf;
    }
    

    .expandable-bottom {
        text-align: center;
        padding: 2em 1em 1em 1em;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;

    }

    .expandable-bottom a {
        text-decoration: none;
        border: none;
        font-weight: 500;
        margin: 1em;
    }

    .expandable-text {
        padding: 0 1em 1em 1em;
    }

    .portfolio-title {
        text-align: center;
        margin-bottom: 1em;
    }

    .portfolio-link {
        width: 100%;
        display: flex;
        margin-top: 1em;
        color: #595959;
        text-decoration: none;
        transition: 0.2s;
    }

    .portfolio-link:hover {
        background-color: rgb(69, 77, 90);
        color: #fff;
    }

    .portfolio-link-image {
        width: 20%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .portfolio-link img {
        border-radius: 100%;
        padding: 1em;
        width: 100%;
    }

    .portfolio-link-text {
        padding: 1em;
        font-weight: 400;
        width: 80%;
    }

    .portfolio-link-text p {
        font-size: 1.25rem;
    }

    .portfolio-link-text h3 {
        font-size: 2rem;
    }

    @media only screen and (max-width: 985px) {
        .portfolio-link-text {
            font-size: 0.8rem;
            width: 65%;
        }

        .portfolio-link-image {
            width: 35%;
        }
        .expandable-top{
            flex-direction: column;
        }
        .expandable-top div{
            width: 100%;
        }
        .expandable-image{
            margin-bottom: 1em;
        }
    }

    @media only screen and (max-width: 650px) {
        .portfolio-link-text {
            width: 60%;
        }

        .portfolio-link-image {
            width: 40%;
        }
        .main{
            padding: 1em 0;
        }
    }

    @media only screen and (max-width: 488px) {
        .portfolio-link-text {
            font-size: 0.6rem;
        }
    }

</style>

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
