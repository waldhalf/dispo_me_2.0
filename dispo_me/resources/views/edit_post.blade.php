@extends('layout')

@section('content')

<div class="container">
<form method="POST" action="#" enctype="multipart/form-data" >
    @csrf
    <br>
    <h1>Editer le Post</h1>
    <br>
    <div class="form-group">
        <label for="post_title">Titre du Post</label>
        <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Insérez le titre ici." value="{{ $post->title }}">
        @if ($errors->has('post_title'))
        <p class="alert alert-danger">{{ $errors->first('post_title') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="post_text">Texte du post</label>
        <textarea class="form-control" id="post_text" rows="3" name="post_text" placeholder="Insérez le texte du post ici.">{{ $post->content }}</textarea>
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
    <div class="form-group">
        <label for="post_slug">Slug</label>
        <input type="text" class="form-control" id="post_slug" name="post_slug" value="{{ $post->slug }}" placeholder="Insérez le slug ici." value="{{ old('post_title') }}">
        @if ($errors->has('post_slug'))
        <p class="alert alert-danger">{{ $errors->first('post_slug') }}</p>
        @endif
    </div>
    <!-- Partie à ajouter si l'on veut add les catégories aux posts -->
    {{-- <div class="form-group">
        <label for="post_category">Catégorie</label>
        <select class="form-control" id="post_category" name="post_category" }}>
            @foreach ($categories as $category)                 
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select> 
        @if ($errors->has('post_category'))
        <p class="alert alert-danger">{{ $errors->first('post_category') }}</p>
        @endif
    </div> --}}
    <button type="submit" class="btn btn-primary" name="upload">Save</button>
    <a href="{{ url('/posts')}}" class="btn btn-danger">Cancel</a>
</form>
</div>
    
@endsection