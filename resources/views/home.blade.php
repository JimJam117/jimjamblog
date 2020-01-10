@extends('layouts.frontend')

@section('title')
    Home
@endsection

@section('content')
<div class="banner">

    <strong>Welcome!</strong>
    <p>My name's James Sparrow, I'm a 20 year old former software development student who's passionate about web
        development. Check out my blog and portfolio to see what I've been up to!</p>
    
</div>

<div class="container">


    <div class="homepage-container">


        <h2>title</h2>
        <div class="homepage-content">
            <div>
                left content
            </div>
            <div>
                right content
            </div>



        </div>

        <strong>Quick Links:</strong>
        <div class="homepage-quick-links">
            <a href="#"><i class="far fa-gem"></i> Portfolio</a> |
            <a href="#"><i class="fas fa-pen"></i> Blog</a> |
            <a href="#"><i class="fas fa-scroll"></i> CV</a>
        </div>

    </div>


</div>

@endsection
