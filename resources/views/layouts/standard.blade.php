@extends('layouts.base')

@section('search')
<div class="form-group search">
    <form method="POST" action="/search">
        @csrf
        <button type="submit" class="searchButton"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="query" class="form-control searchInput" id="exampleInputName2"
            placeholder="Search...">
    </form>
</div>
@endsection
