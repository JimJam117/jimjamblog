@extends('layouts.standard')

@section('title')
Home
@endsection

@section('content')
<div class="banner">

    <h1>Welcome!</h1>

</div>

<div class="container">


    <div class="homepage-container">
        <div class="homepage-content">
            <div>
                
                <p>
                    <img class="homepage-profile-pic" src="/img/jimjam3.png" alt="Me">
                    My name's James Sparrow, I'm a 20 year old former software development student who's passionate about web development.
                    Check out my portfolio or blog to see what I've been up to!
                </p>
                <br>
                <hr>
                <br>
                <ul class="homepage-quick-links">
                    <li><a href="/blog"><i class="fas fa-pen"></i> Blog</a></li>
                    <li><a href="/blog/projects"><i class="fas fa-project-diagram"></i> Projects</a></li>
                    <li><a href="/portfolio"><i class="far fa-gem"></i> Portfolio</a></li>
                    <li><a href="/CurriculumVitae.pdf"><i class="fas fa-scroll"></i> CV</a></li>
                </ul>
            </div>
            <div class="homepage-gallery">

                <img src="/img/logos/htmlcssjs.png" alt="">
                <img src="/img/logos/php.png" alt="">
                <img src="/img/logos/lamp.png" alt="">
                <img src="/img/logos/laravel.png" alt="">
                <img src="/img/logos/vue.js.png" alt="">
                <img src="/img/logos/unity.png" alt="">

            </div>



        </div>



    </div>


</div>

@endsection
