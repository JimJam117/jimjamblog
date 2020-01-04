@extends('layouts.frontend')

@section('content')
<div class="container">
    
            <div class="">
                <div class="">Dashboard</div>

                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @auth
                    You are logged in!
                    @endauth
            </div>
        <h1>Homepage</h1>
    
</div>
@endsection
