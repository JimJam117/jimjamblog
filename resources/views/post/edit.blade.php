@extends('layouts.backend')
@section('title')
    Edit Post
@endsection
@section('content')
<h1>Edit Post:</h1>
<form action="/post/{{$post->slug}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class=" form-group row">
        <label for="title">Title</label>
        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') ?? $post->title ?? "" }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="slug">slug</label>
        <input id="slug" type="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
            value="{{ old('slug') ?? $post->slug ?? "" }}" required>

        @error('slug')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="category_id">Project</label>
        <br>
        <select id="category_id" type="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id"
        value="{{ old('category_id') ?? $post->category_id ?? ""}}" >
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

    <div class="form-group row">
      <label for="created_at_manual">created_at_manual</label>
      <p>Example</p>
      <p>2020-01-27 15:30:49</p>
      <input id="created_at_manual" type="created_at_manual" class="form-control @error('created_at_manual') is-invalid @enderror" name="created_at_manual"
          value="{{ old('created_at_manual') ?? $post->created_at ?? "" }}" required>

      @error('created_at_manual')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
  </div>



    <div class=" form-group row">
        <label for="body">Body</label>
        <br><br>
        <textarea class="form-control @error('body') is-invalid @enderror" type="text" name="body">{{old('body') ?? $post->body ?? ""}}</textarea>

        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="row form-group">
        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
        <div class="col-md-6">
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
            <strong>{{ $message }}</strong>
            @enderror
        </div>

    </div>

    <div class="form-group row mb-0">
        <button class="btn btn-primary text-center align-items-center" type="submit" name="button">Update</button>
    </div>
</form>
<hr>
@endsection