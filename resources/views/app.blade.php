<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="James Sparrow - Web Developer">
    <title>James Sparrow</title>
    <link rel="icon" href="/img/jimjam.ico">
    
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans:300S&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" media="all" rel="stylesheet" defer="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>

  <style>
.toBackend {
    position: fixed;
    z-index: 99;
    background-color: #478247;
    padding: 10px;
    border-radius: 10px;
    top: 0;
    right: 0;
    font-size: 1.25rem;
    color: white !important;
    font-family: sans;
  }

  </style>

  </head>


<body>
    
  @auth
    <a class="toBackend" href="/backend">Go To Backend</a>
  @endauth

<div id="app"></div>

<script src="/js/app.js"></script>


</body>
</html>