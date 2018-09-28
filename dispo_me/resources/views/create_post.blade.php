@extends('layout')


@section('content')

<div class="container">
<form method="POST" action="#" enctype="multipart/form-data" >
    @csrf
    <br>
    <h1>Créer un nouveau post</h1>
    <br>
    <div class="form-group">
        <label for="post_title">Titre du Post</label>
        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Insérez le titre ici." value="{{ old('post_title') }}">
        @if ($errors->has('post_title'))
        <p class="alert alert-danger">{{ $errors->first('post_title') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="post_text">Texte du post</label>
        <textarea class="form-control" id="post_text" rows="3" name="post_text" placeholder="Insérez le texte du post ici.">{{ old('post_text') }}</textarea>
        @if ($errors->has('post_text'))
        <p class="alert alert-danger">{{ $errors->first('post_text') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="post_image">Image à associer au Post</label>
        <input type="file" class="form-control-file" id="post_image" name="post_image">
        @if ($errors->has('post_image'))
        <p class="alert alert-danger">{{ $errors->first('post_image') }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary" name="upload">Submit</button>
</form>
</div>
    
@endsection