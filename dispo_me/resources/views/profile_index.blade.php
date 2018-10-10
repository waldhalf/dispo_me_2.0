<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}" />
    <link rel="stylesheet" href="{{'/css/profile.css'}}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Profil</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/" style="font-size: 20px; color:black;">Dispo.me</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="vertical-align">
                        <ul class="nav navbar-nav">
                            @if ($user=Auth::user())
                            <a class=" btn btn-primary" href="{{ url ('/profile/'.Auth::user()->id.'/edit_step_1') }}" style="font-size: 15px;">Mettre
                                mon profil à jour</a>
                            <a href="{{ url ('/profile/'.Auth::user()->id.'/delete') }}" class=" btn btn-danger delete" style="font-size: 15px;">Effacer
                                mon profil</a>
                               
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                <a href="{{ url('/home') }}" class="btn btn-primary">Déconnexion</a>
                                @if (Auth::user()->is_admin == 1)
                                <a href="{{ url('/admin') }}" class="btn btn-danger">Admin</a>
                                @endif
                                @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
                                @endauth
                            </div>
                            @endif
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="resume">
            <header class="page-header">
                <h1 class="head-profile">Profil de {{ $user->name }} {{ $user->last_name }} </h1>
                <small id="head-time"> <i class="fa fa-clock-o"></i> Mis à jour: <time>{{ $profile->updated_at }}</time></small>
            </header>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading resume-heading">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-xs-12 col-sm-4">
                                        <figure>
                                            <img id="image_de_profil" class="img-circle img-responsive" alt="photo_de_profil" src="{{$profile->profile_photo}}">
                                        </figure>
                                    </div>
                                    <div class="col-xs-12 col-sm-8">
                                        <ul class="list-group">
                                            <li class="list-group-item">{{ $user->name }} {{ $user->last_name }}</li>
                                            <li class="list-group-item">Emploi actuel: {{ $profile->actuel_job }}</li>
                                            <li class="list-group-item">Entreprise actuelle: {{
                                                $profile->actual_company }}</li>
                                            @if ($profile->free == 1)
                                            <li class="list-group-item">Disponible: Oui </li>
                                            @else
                                            <li class="list-group-item">Disponible: Non </li>
                                            @endif
                                            @if ($profile->visible_on_web == 1)
                                            <li class="list-group-item"><i class="fa fa-envelope"></i> {{$user->email}}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bs-callout bs-callout-danger">
                            <h4>Expertises</h4>
                            <div>
                                @foreach ($profile->tags as $tag)
                                <span class="label label-info" id="skill_tag">{{$tag->skill_name}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="geo bs-callout bs-callout-danger col-md-12" style="background-color: white;">
                            <div class="col-md-6">
                                <h4>Zone géographique</h4>
                                <h5>Ville : {{$profile->profile_city}}</h5>
                                <p style="color:black">Rayon en km autour de {{$profile->profile_city}}:
                                    {{$profile->profile_city_range}} </p>
                                <h5>Département : {{$profile->profile_county}}</h5>
                                <p style="color:black">Mobilité dans le département:
                                    @if ($profile->profile_county_mobile == 1 )
                                    OUI</p>
                                @else
                                NON</p>
                                @endif
                                <h5>Région: {{$profile->profile_region}}</h5>
                                <p style="color:black">Mobilité dans la région:
                                    @if ($profile->profile_region_mobile == 1 )
                                    OUI</p>
                                @else
                                NON</p>
                                @endif
                                <h5>Modilité nationale:
                                    @if ($profile->profile_country_mobile == 1 )
                                    OUI</h5>
                                @else
                                NON</h5>
                                @endif
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <h4>Réseaux Sociaux</h4>
                                <div>
                                    @if ($profile->profile_google_visible == 1)
                                    <a style="" href="{{$profile->profile_google}}">
                                        <img src="/img/icone_google.png" class="icone_social" alt=""></a>
                                    @endif
                                    @if ($profile->profile_facebook_visible == 1)
                                    <a href="{{$profile->profile_facebook}}">
                                        <img src="/img/icone_facebook.jpg" class="icone_social" alt=""></a>       
                                    @endif
                                    @if ($profile->profile_linkedin_visible == 1)
                                    <a href="{{$profile->profile_linkedin}}">
                                        <img src="/img/icone_linkedin.png" class="icone_social" alt=""></a> 
                                    @endif
                                    @if ($profile->profile_viadeo_visible == 1)
                                    <a href="{{$profile->profile_viadeo}}">
                                        <img src="/img/icone_viadeo.png" class="icone_social" alt=""></a>
                                    @endif
                                </div>
                                <h4 style="margin-top:10px;">Infos</h4>
                                <h5>Préavis :{{ $profile->notice }} jours</h5>
                                <h5>Temps de travail souhaité : {{ $profile->percentage }} %</h5>
                                <h5>Emploi recherché: {{ $profile->searched_job }} </h5>
                            </div><!--fin de la seconde md-6-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    <!-- Scripts -->
    <script>
        $('.delete').click(function() {
            return confirm("Etes-vous sûr de vouloir effacer votre profil?");
        });
    </script>
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
