<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        .topbar {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: row;
            padding: 5px;
            width: 100%;
        }
        .topbar div a{
            color:white;
        }
        .topbar div a:visited{
            color:white;
        }

    </style>
</head>

<body>
    <div class="topbar">
        <div> <img class="ProfilePic" src="/img/profile_pic.png" alt="James"></div>
        <div class="title">
                <h1>James Sparrow</h1>
            <h3>The coolest chap around</h3>
        </div>

        <nav class="navbar">
            <a href="/home">Home</a>
            <a href="blog.php">Blog</a>
            <a href="projects.php">Projects</a>
            <a style="background-color: darkgray; border-color: darkgray" href="#">CV</a>
        </nav>
    </div>



    <div class="topbar">
        <div>
            <a href="/backend">Backend</a>
            <a href="/posts">All Posts</a>
            <a href="/categories">All Categories</a>
            <a href="/home">Home</a>
        </div>
        <div>
            @auth
            <br><button onclick="document.getElementById('logout-form').submit();">{{Auth::user()->name}}: logout</button>
            

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
            @guest
                <button onclick="window.location.href=('/login')">Login</button>
            @endguest
        </div>

    </div>
    @yield('content')
</body>

</html>
