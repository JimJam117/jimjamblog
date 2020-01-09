@extends('layouts.frontend')
@section('content')
<h1>Create Post:</h1>
<form action="/post" method="post" enctype="multipart/form-data">
    @csrf
    <div class=" form-group row">
        <label for="title">Title</label>
        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="slug">slug</label>
        <input id="slug" type="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
            value="{{ old('slug') }}" required>

        @error('slug')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="category_id">Project</label>
        <select id="category_id" type="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id"
        value="{{ old('category_id') }}" >
            <option value="0">None</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
          </select>

        @error('category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class=" form-group row">
        <label for="body">Body</label>
        <textarea class="form-control @error('body') is-invalid @enderror" type="text"
            name="body">{{old('body')}}</textarea>
        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row form-group">
        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
        <div class="col-md-6">
            <input type="file" class="form-control-file" id="image" name="image" required>
            @error('image')
            <strong>{{ $message }}</strong>
            @enderror
        </div>

    </div>

    <div class="form-group row mb-0">
        <button class="btn btn-primary text-center align-items-center" type="submit" name="button">Add New Post</button>
    </div>
</form>
<hr>
@endsection
