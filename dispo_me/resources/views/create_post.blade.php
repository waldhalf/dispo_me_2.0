@extends('layout')

<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
      selector: '#post_text'
    });
    </script>

@section('content')

<div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">Dispo.me</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        {{-- ici on peut mettre des link si necessaire dans la partie admin --}}
                    </ul>
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Déconnexion</a>
                        @if ($user=Auth::user()->is_admin == 1)
                        <a href="{{ url('/admin') }}" class="btn btn-danger">Admin</a>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                        <a href="{{ route('register') }}" class="btn btn-danger">S'inscrire</a>
                        @endauth
                    </div>
                    @endif
                </div>
            </nav>
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
    <div class="form-group">
        <label for="post_slug">Slug</label>
        <input type="text" class="form-control" id="post_slug" name="post_slug" placeholder="Insérez le slug ici." value="{{ old('post_title') }}">
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

    <button type="submit" class="btn btn-primary" name="upload">Submit</button>
</form>
</div>
    
@endsection