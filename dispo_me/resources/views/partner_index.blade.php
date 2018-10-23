@extends('layout')

<link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
@section('content')
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

<h1>Index des partenaires</h1>
@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom du partenaires</th>
            <th scope="col">Actif?</th>
            <th scope="col">Rang</th>
            <th scope="col">Créé le</th>
            <th scope="col">Voir</th>
            <th scope="col">Effacer</th>
        </tr>
    </thead>
    @foreach ($partners as $partner)
        <tbody>
          <tr>
            <td>{{ $partner->id }}</td>
            <td>{{ $partner->network_name }}</td>
            <td>
                @if ($partner->active == 0)
                    non
                @else
                    oui
                @endif
            </td>
            <td>{{ $partner->ranking }}</td>
            <td>{{ date('j M, Y', strtotime($partner->created_at)) }}</td>
            <td><a href="{{route ('partners.edit', $partner->id) }}" class="btn btn-info btn-lg  "> <i class="fa fa-pencil"></i></a></td>
            <td><a href="{{url ('/partners/'.$partner->id.'/delete')}}"></a>
                {{ Form::open(['route' => ['partners.delete', $partner->id], 'method' => 'DELETE']) }}
                    {{ Form::button('<i class="fa fa-trash-o"></i></a>', ['type' => 'submit','class' => 'btn btn-danger btn-lg'])}}
                {{ Form::close() }}
            </td>
          </tr>
        </tbody>
        @endforeach
</table>

{{-- <img style="width:30px; height:30px;" src="{{$post['img_path']}}" alt="une image" srcset="">  --}}
    

@endsection