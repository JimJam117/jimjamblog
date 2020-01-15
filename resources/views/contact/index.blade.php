@extends('layouts.base')

@section('title')
Contact
@endsection

@section('content')
<h1>Contact</h1>
<br>
<form action="/contact" method="post" enctype="multipart/form-data">
    @csrf
    <div class=" form-group row">

        <input id="name" placeholder="Name" type="name" class="form-control @error('name') is-invalid @enderror"
            name="name" value="{{ old('name') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class=" form-group row">

        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class=" form-group row">
        <textarea placeholder="Message" class="form-control @error('message') is-invalid @enderror" type="text"
            name="message" rows="8">{{old('message')}}</textarea>
        @error('message')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row mb-0">
        <button class="submit-button" type="submit" name="button">Send</button>
    </div>
</form>

@endsection

@section('extra-scripts')
<style>
    textarea {
        width: 100%;
        padding: 1em;
        margin: 1em 0;
        resize: vertical;
        font-family: "Open Sans";
    }

    h1 {
        text-align: center;
    }

    form {
        text-align: center;
        width: 50%;
        margin: auto;

    }

    .submit-button {
        background-color: rgb(177, 71, 92);
        color: #fff;
        padding: 1em 2em;
        font-size: 1em;
        border: 2px solid rgb(177, 71, 92);
        transition: 0.2s;
        margin: 3rem 0;
    }

    .submit-button:hover {
        background-color: #fff;
        color: rgb(177, 71, 92);
        border: 2px solid rgb(177, 71, 92);
    }

    .row {
        padding: 0;
    }


    @media only screen and (max-width: 650px) {
        form {
            width: 90%;
            margin: auto;

        }

        .submit-button {
            padding: 1em 2em;
            font-size: initial;
        }
    }

</style>
@endsection
