@extends('layouts.base')
@section('content')
<h1>Edit Portfolio:</h1>
<form action="/portfolio/{{$portfolio->id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class=" form-group row">
        <label for="title">Title</label>
        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') ?? $portfolio->title ?? "" }}" required>

        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    

    <div class=" form-group row">
        <label for="body">Body</label>
        <br><br>
        <textarea class="form-control @error('body') is-invalid @enderror" type="text" name="body">{{old('body') ?? $portfolio->body ?? ""}}</textarea>

        @error('body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <br>
    <hr>
    <br>

    <div class=" form-group row">
        <label for="revealed_title">Revealed Title</label>
        <input id="revealed_title" type="title" class="form-control @error('revealed_title') is-invalid @enderror" name="revealed_title"
            value="{{ old('revealed_title') ?? $portfolio->revealed_title ?? "" }}" required>

        @error('revealed_title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class=" form-group row">
        <label for="revealed_body">Revealed Body</label>
        <br><br>
        <textarea class="form-control @error('revealed_body') is-invalid @enderror" type="text" name="revealed_body">{{old('revealed_body') ?? $portfolio->revealed_body ?? ""}}</textarea>

        @error('revealed_body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>



    <div class=" form-group row">
        <label for="features">Features</label>
        <h2>Example:</h2>
        <p>html;css;js</p>
        <input id="features" class="form-control @error('features') is-invalid @enderror" name="features"
            value="{{ old('features') ?? $features_str ?? "" }}" required>

        @error('features')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    {{-- Links --}}
    <br>
    <h2>Links</h2>
    <hr>
    <br>


    <div class=" form-group row">
        <label for="link_to_site">Link to Live Site</label>
        <input id="link_to_site" class="form-control @error('link_to_site') is-invalid @enderror" name="link_to_site"
            value="{{ old('link_to_site') ?? $portfolio->link_to_site ?? "" }}">

        @error('link_to_site')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class=" form-group row">
        <label for="link_to_source">Link to Source</label>
        <input id="link_to_source" class="form-control @error('link_to_source') is-invalid @enderror" name="link_to_source"
            value="{{ old('link_to_source') ?? $portfolio->link_to_source ?? "" }}">

        @error('link_to_source')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <div class=" form-group row">
        <label for="link_to_blog">Link to Blog Page</label>
        <input id="link_to_blog" class="form-control @error('link_to_blog') is-invalid @enderror" name="link_to_blog"
            value="{{ old('link_to_blog') ?? $portfolio->link_to_blog ?? "" }}">

        @error('link_to_blog')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    {{-- Images --}}
    <br>
    <h2>Images</h2>
    <hr>
    <br>

    <div class="row form-group">
        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
        <div class="col-md-6">
            <input type="file" class="form-control-file" id="image" name="image">
            @error('image')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    <div class="row form-group">
        <label for="revealed_image" class="col-md-4 col-form-label text-md-right">Revealed Image</label>
        <div class="col-md-6">
            <input type="file" class="form-control-file" id="revealed_image" name="revealed_image">
            @error('revealed_image')
            <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <button class="btn btn-primary text-center align-items-center" type="submit" name="button">Update Portfolio Entry</button>
    </div>
</form>

@endsection




@section('extra-scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
  var editor_config = {
    forced_root_block : false,
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    // file_browser_callback : function(field_name, url, type, win) {
    //   var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    //   var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    //   var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    //   if (type == 'image') {
    //     cmsURL = cmsURL + "&type=Images";
    //   } else {
    //     cmsURL = cmsURL + "&type=Files";
    //   }
    //   tinyMCE.activeEditor.windowManager.open({
    //     file : cmsURL,
    //     title : 'Filemanager',
    //     width : x * 0.8,
    //     height : y * 0.8,
    //     resizable : "yes",
    //     close_previous : "no"
    //   });
    // }
  };
  tinymce.init(editor_config);
</script>

@endsection