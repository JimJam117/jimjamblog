@extends('layouts.base')

@section('title')
Portfolio
@endsection

@section('content')
<h1 class="portfolio-title" style="font-size: 3rem;">Portfolio</h1>


@foreach ($portfolios as $portfolio)
    <a class="portfolio-link" href="#{{$portfolio->id}}">
        <div class="portfolio-link-image">
            <img src="{{$portfolio->image}}" alt="{{$portfolio->title}}">
        </div>
        
        <div class="portfolio-link-text">
            <h3>{{$portfolio->title}}</h3>
            <br>
            <p>{{$portfolio->body}}</p>
        </div>

    </a>
    <!-- expand -->
    <div class="expandable" id="{{$portfolio->id}}">
        <div class="expandable-top">
            <img src="{{$portfolio->revealed_image}}" alt="{{$portfolio->title}}">
            <div class="expandable-text">
                <h3>{{$portfolio->revealed_title}}</h3>
                <p>{{$portfolio->revealed_body}}</p>
            </div>
        </div>
        <div class="expandable-middle">
            @if (in_array("html", $portfolio->features))
            <div><i class="fab fa-html5"></i> <small>HTML5</small></div>
            @endif

            @if (in_array("css", $portfolio->features))
                <div><i class="fab fa-css3-alt"></i> <small>CSS3</small></div>
            @endif

            @if (in_array("wordpress", $portfolio->features))
                <div><i class="fab fa-wordpress"></i> <small>Wordpress</small></div>
            @endif

            @if (in_array("php", $portfolio->features))
                <div><i class="fab fa-php"></i> <small>PHP</small></div>
            @endif

            @if (in_array("responsive", $portfolio->features))
                <div><i class="fab fa-mobile-alt"></i> <small>Responsive Design</small></div>
            @endif

            @if (in_array("laravel", $portfolio->features))
                <div><i class="fab fa-laravel"></i> <small>Laravel</small></div>
            @endif

            @if (in_array("js", $portfolio->features))
                <div><i class="fab fa-js"></i> <small>JavaScript</small></div>
            @endif

            @if (in_array("react", $portfolio->features))
                <div><i class="fab fa-react"></i> <small>React</small></div>
            @endif

            @if (in_array("unity", $portfolio->features))
                <div><i class="fab fa-unity"></i> <small>Unity</small></div>
            @endif
            
            @if (in_array("python", $portfolio->features))
                <div><i class="fab fa-python"></i> <small>Python</small></div>
            @endif

        </div>
        <div class="expandable-bottom">

            @isset($portfolio->link_to_site)
                <a class="btn" href="{{$portfolio->link_to_site}}"><i class="far fa-window-maximize"></i> Live Demo</a>
            @endisset 

            
            @isset($portfolio->link_to_source)
                <a class="btn" href="{{$portfolio->link_to_source}}"><i class="fas fa-code"></i> Source</a>
            @else
                <p style="color:#a1a1a1; margin: auto 0;">
                    <i class="fas fa-lock"></i> Source Private
                </p>
            @endisset 

            @isset($portfolio->link_to_blog)
                <a class="btn" href="{{$portfolio->link_to_blog}}"><i class="fas fa-pen"></i> Blog Page</a>
            @endisset 
             
        </div>
    </div>
@endforeach

@endsection


@section('extra-scripts')

<style>
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
