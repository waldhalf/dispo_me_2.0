
<link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


@extends('layout')

@section('content')


<div class="container">
@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
@endif

@if ($errors->has('skill_name'))
<p class="alert alert-danger">{{ $errors->first('skill_name') }}</p>
@endif
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
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                @endauth
            </div>
            @endif
        </div>
    </nav>
<div class="row">
    <div class="col-md-8">
        <div class="row mt-5">
            <h1 class="col-md-8">Lists des catégories</h1>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Nom de la catégorie</th>
                    <th >Actions</th>      
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                <tr>
                    <td>{{$categorie['id']}}</td>
                    <td>{{$categorie['category_name']}}</td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-default btn-lg "> <i class="fa fa-pencil"></i></a>
                        <a href="{{route ('categories.delete', $categorie['id']) }}" class="btn btn-default btn-lg "><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div> <!--fin de la md-8-->
    
    <div class="col-md-4">
        <br><br>
        <div class="jumbotron">
            {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
            <h2>Nouvelle catégorie</h2>
            {{ Form::label('category_name', 'Nom de la catégorie: ')}}
            {{ Form::text('category_name', null, ['class' => 'form-control'])}}
            {{ Form::submit('Créer', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:5px;']) }}
            {!!Form::close() !!}
        </div>
    </div><!--fin de la md-3-->
</div>
</div>
<!-- Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.scrollex.min.js"></script>
<script src="js/jquery.scrolly.min.js"></script>
<script src="js/browser.min.js"></script>
<script src="js/breakpoints.min.js"></script>
<script src="js/util.js"></script>
<script src="js/main.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>


@endsection