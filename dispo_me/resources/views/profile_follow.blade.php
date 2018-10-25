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
    {{-- Utilisation de DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Profil</title>
</head>

<body> 
        @if (Session::has('msg'))
        <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
        @endif
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

    <div class="container col-md-8">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mt-3 mb-3">Liste des profils suivis</h2>
            </div>
            <div class="col-md-8">
                <a href="{{route ('profile.search')}}" class="btn btn-info float-right mt-3 mb-3">Chercher de nouveaux profils</a>
            </div>
        </div>
        <table class="table table-striped table-dark" id="table_id">
            <thead>
                <tr>     
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Compétences</th>
                    <th scope="col" class="text-right">Disponible</th>
                    <th scope="col" class="text-right">Ne plus suivre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($followedProfiles as $profile)
                <tr>               
                    <td>{{$profile->user->last_name}}</td>
                    <td>{{$profile->user->name}}</td>
                    <td>
                    @foreach ($profile->tags as $tag)
                    <span class="badge badge-info"> {{$tag->skill_name}} </span>
                    @endforeach
                    </td>
                    @if ($profile->free == 0)
                    <td class="text-right">Non</td>
                    @else
                    <td class="text-right">Oui</td>
                    @endif
                    <td><a href="{{route('profile.deleteFollowed', $profile->user_id)}}" class="btn btn-danger float-right">Ne plus suivre</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable( {
                "columns": [
                    null,
                    null,
                    { "orderable": false },
                    null,
                    { "orderable": false },
                ],
                "searching": false,
                "language": {
                    "lengthMenu": "Accés à  _MENU_ résulats par page",
                    "zeroRecords": "Rien de trouvé, désolé",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Pas de résultats disponibles",
                    "infoFiltered": "(filtré sur un total de _MAX_ résultats)",
                    "search": "Rechercher dans les résultats",
                    "paginate": {
                        "previous": "Précédent",
                        "next": "Suivant"
                    }
                }
            });
        });
    </script>
</body>

</html>
