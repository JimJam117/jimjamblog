@extends('layouts.base')

@section('title')
Home
@endsection

@section('content')
@include('partials.search')

@php
    $rq = request()->post();
    if(isset($rq['mailSent'])){
        $mailSent = $rq['mailSent'];
    }
    
@endphp
@isset($mailSent)
    <div class="mail-banner">
        Thank you {{$mailSent}}!
    </div>
@endisset


<div class="banner">

    <h1>Welcome!</h1>

</div>

<div class="container">

    <div class="homepage-container">
        <div class="homepage-content">
            <div>
                <img class="homepage-profile-pic-top" src="/img/jimjam3.png" alt="Me">
                <p>
                    <img class="homepage-profile-pic" src="/img/jimjam3.png" alt="Me">
                    My name's James Sparrow, I'm a 20 year old former software development student who's passionate
                    about web development.
                    Check out my portfolio or blog to see what I've been up to!
                </p>
                <br>
                <hr>
                <br>
                <ul class="homepage-quick-links">
                    <li><a href="/blog"><i class="fas fa-pen"></i> Blog</a></li>
                    <li><a href="/blog/projects"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="/portfolio"><i class="far fa-gem"></i> Portfolio</a></li>
                    <li><a href="/github"><i class="fab fa-github"></i> Github</a></li>
                    <li><a href="/contact"><i class="fas fa-envelope"></i> Contact</a></li>
                    <!--<li><a href="/CurriculumVitae.pdf"><i class="fas fa-scroll"></i> CV</a></li>-->
                </ul>
            </div>
            <div class="homepage-gallery">

                <img src="/img/logos/htmlcssjs.png" alt="">
                <img src="/img/logos/php.png" alt="">
                <img src="/img/logos/lamp.png" alt="">
                <img src="/img/logos/laravel.png" alt="">
                <img src="/img/logos/c-sharp.png" alt="">
                <img src="/img/logos/unity.png" alt="">

            </div>



        </div>



    </div>


</div>

@endsection

@section('extra-scripts')
<style>
    .mail-banner {
    width: 100%;
    padding: 1em;
    margin: 1em 0;
    background-color: rgba(190, 255, 190, 0.34);
    font-family: "Open Sans";
    font-weight: 500;
    border: 1px solid #62b062;
    border-radius: 1em;
    }

    /*HOMEPAGE*/
    .container{
        font-size: 1rem;
    }

    .homepage-container {
        width: 100%;
    }

    .homepage-content {
        display: flex;
        margin: 2em;
        justify-content: space-between;
        font-family: "Public Sans";
        color: #151515;
    }

    .homepage-content div {
        width: 45%;
        max-width: 1000px;
        text-align: initial;
        margin-top: 2em;
    }

    .homepage-profile-pic {
        width: 7em;
        float: left;
        padding: 1em;
        border-radius: 100%;
    }

    .homepage-profile-pic-top {
        display: none;
    }

    .homepage-quick-links {
        display: grid;
        list-style: none;
    }

    .homepage-quick-links a {
        text-decoration: none;
        color: rgb(71, 113, 177);
        transition: 0.2s;
        font-size: 1.25rem;
    }

    .homepage-quick-links li {
        padding: 0.5em 0;
    }

    .homepage-quick-links a:hover {
        color: rgba(0, 0, 0, 0.4);
    }

    .homepage-gallery {
        display: grid;
        grid-template-columns: 50% 50%;
    }

    .homepage-gallery img {
        width: 100%;
    }

    @media only screen and (max-width: 985px) {
        .homepage-content{
            flex-direction: column;
            margin: 0em;
        }

        .homepage-profile-pic-top {
            display: initial;
            width: 10em;
            padding: 0 1em 1em 1em;
            border-radius: 100%;
        }
        .homepage-profile-pic{
            display: none;
        }

        .homepage-content div{
            width: 100%;
            text-align: center;
        }

        .homepage-quick-links li {
            padding: 1.5em 0em;
            text-align: center;
        }
    }

</style>
@endsection
