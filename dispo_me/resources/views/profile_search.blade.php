<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}" />
    <link rel="stylesheet" href="{{'/css/profile.css'}}">

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Profil</title>
</head>
<body>
    <div class="container col-md-8">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="/">Dispo.Me</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="btn btn-primary nav-button">Déconnexion</a>
                    </li>
                    @if (Auth::user()->is_admin == 1)
                    <li class="nav-item">
                        <a href="{{ url('/admin') }}" class="btn btn-danger nav-button">Admin</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary nav-button">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-danger nav-button">S'inscrire</a>
                    </li>
                    @endauth
                    </li>
                </ul>
                @endif
            </div>
        </nav>
    </div>

    <div class="container col-md-8">
        <div class="row">
            <div class="col-md-5">
                <h2 class="mt-3 mb-3">Rechercher de nouveaux profils</h2>
            </div>
            <div class="col-md-7">
                <form class="form-inline float-sm-right" method="POST">
                    @csrf
                    <input name="query_profile" class="form-control col-md-9 mt-3 mb-3 mr-0" type="search" placeholder="Compétence recherchée ou nom"
                        style="width: 500px;">
                    <button class="btn btn-info ml-auto" type="submit">Chercher</button>
                </form>
            </div>
       </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Compétences</th>
                    <th scope="col" class="text-center">Profil</th>
                    <th scope="col" class="text-right">Disponible</th>
                    <th scope="col" class="text-center">Suivre?</th>
                </tr>
            </thead>
            <tbody>
                
                @if (isset($tabProfiles))
                @foreach ($tabProfiles as $profile)
                @if ($profile->visible_on_website == 1)
                <tr>
                    <th scope="row">{{$profile->user->id}}</th>
                    <td>{{$profile->user->name}}</td>
                    <td>{{$profile->user->last_name}}</td>
                    <td>
                        @foreach ($profile->tags as $tag)
                        <span class="badge badge-info"> {{$tag->skill_name}} </span>
                        @endforeach
                    </td>
                    <td><a href="/profile/{{ $profile->user->slug}}" class="btn btn-primary float-right">Voir le profil</a></td>
                    @if ($profile->free == 0)
                    <td class="text-right">Non</td>
                    @else
                    <td class="text-right">Oui</td>
                    @endif

                    <td><a href="{{ url ('/profile/add_followed/'.$profile->user_id) }}" class="btn btn-success float-right">Ajouter</a></td>
                           {{-- href="{{ route ('categories.delete', $categorie['id']) }}" --}}
                </tr>
                @endif
                @endforeach
                @endif                
            </tbody>
        </table>
    </div>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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
</body>
</html>
