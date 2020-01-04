<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        .ProfilePic {
            display: inline-block;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 80px;
            width: 80px;
            border-radius: 100%;
            margin-left: 30px;

        }

        .control-nav {
            float: right;
        }

        .control-nav a, .control-nav button {
            border: none;
            text-decoration: none;
            padding: 10px;
            margin: 0 2px;
            font-size: 11px;
            background-color: #fff;
            color: rgb(177, 71, 92);
            display: inline-block;
            transition: background-color 0.15s, color 0.15s;
        }

        .control-nav a:hover {
            background-color: rgb(177, 71, 92);
            color: #fff;
        }

    </style>
</head>

<body>


    <div class="topbar">
        <div> <img class="ProfilePic" src="https://www.jsparrow.uk/legacy/img/jamesold.png" alt="James"></div>
        <div class="title">
            <h1>James Sparrow</h1>
            <h3>The coolest chap around</h3>
        </div>

        <nav class="navbar">
            <a href="/home">Home</a>
            <a href="/posts">Blog</a>
            <a href="/categories">Projects</a>
            <a style="background-color: darkgray; border-color: darkgray" href="#">CV</a>
        </nav>



        <div class="control-nav">
            @auth
            <a href="/post/create">Create Post</a>
            <a href="/category/create">Create Category</a>
            <button class="login" onclick="document.getElementById('logout-form').submit();">{{Auth::user()->name}}:
                logout</button>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
            @guest
            <button class="login" onclick="window.location.href=('/login')">Login</button>
            @endguest
        </div>

    </div>
    <div class="main">
        @yield('content')
    </div>

</body>

</html>
