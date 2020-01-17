@extends('layouts.base')


@section('search')

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

<div class="form-group search">
    <form method="POST" action="/search">
        @csrf
        <button type="submit" class="searchButton"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="query" class="form-control searchInput" id="exampleInputName2"
            placeholder="Search...">
    </form>
</div>
@endsection
