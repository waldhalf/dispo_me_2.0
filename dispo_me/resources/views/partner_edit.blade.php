@extends('layout')

@section('content')

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Dispo.me</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                @endauth
            </div>
            @endif
        </div>
    </nav>
    @if (Session::has('msg'))
    <div class="col-md-8">
        <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
    </div>
    @endif
    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <br>
        <h1>Editer le partenaire</h1>
        <br>
        <div class="form-group">
            <label for="network_name">Nom du partenaire</label>
            <input type="text" class="form-control" id="network_name" name="network_name" placeholder="Insérez le nom du partenaire ici."
                value="{{ $partner->network_name }}">
            @if ($errors->has('network_name'))
            <p class="alert alert-danger">{{ $errors->first('network_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="active">Activer ce partenaire &nbsp; </label> </br>
            <input type="radio" name="active" value="1" class="radio-inline" checked="checked">
            Oui <input type="radio" name="active" value="0" class="radio-inline"> Non
            @if ($errors->has('active'))
            <p class="alert alert-danger">{{ $errors->first('active') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="ranking">Classement</label>
            <input type="text" class="form-control" id="ranking" name="ranking" placeholder="Insérez le rang ici."
                value="{{ $partner->ranking }}">
            @if ($errors->has('ranking'))
            <p class="alert alert-danger">{{ $errors->first('ranking') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="icon">Icône à associer au partenaire</label>
            <input type="file" class="form-control-file" id="icon" name="icon">
            @if ($errors->has('icon'))
            <p class="alert alert-danger">{{ $errors->first('icon') }}</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary" name="upload">Envoyer</button>
    </form>
</div>

@endsection
