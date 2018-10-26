<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Dispo.me</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ '/css/main.css' }}" />
    <link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body class="is-preload">
    @if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
    @endif
    <!-- Wrapper -->
    <div id="wrapper" class="fade-in">
        <!-- Intro -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#" id="nav-header-brand">Dispo.me |BETA VERSION|</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a style="color:black;margin-left:15px;" href="/public/posts">Présentation des métiers !</a>
                        @if (Auth::user() && Auth::user()->has_profile == 0)
                        <a style="color:black;margin-left:15px;" href="{{ url ('/profile_step_1') }}">Créer un profil</a>
                        @endif
                        @if (Auth::user() && Auth::user()->has_profile == 1)
                        <a style="color:black;margin-left:15px;" href="{{ url ('/profile/'.Auth::user()->slug) }}">Mon
                            profil</a>
                        @endif
                        <a style="color:black;margin-left:15px;" href="/profile/search">Chercher un profil</a>
                        <a style="color:black;margin-left:15px;" href="/profile/followed">Profils suivis</a>
                        <a style="color:black;margin-left:15px;" href="/manual">Mode d'emploi</a>
                        <a style="color:black;margin-left:15px;" href="/contact">Qui sommes-nous ?</a>
                        {{-- <li class="nav-item">
                        <a class="nav-link active" href="#">Mes disponibilités</a>
                    </li> --}}
                    </li>
                </ul>
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary">Déconnexion</a>
                    @if ($user=Auth::user()->is_admin == 1)
                    <a href="{{ url('/admin') }}" class="btn btn-danger">Admin</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Se Connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-danger">S'inscrire</a>
                    @endauth
                </div>
                @endif
            </div>
        </nav>
        <div id="intro">
            <h1>Changez instantanément vos
                disponibilités<br />
            </h1>
            <p> Prenez votre planning en main!</p>
            <ul class="actions">
                <li class="mode-emploi"><img src="../img/nbr1.png" alt="number1" class="imgnbr"> Renseignez vos informations ainsi que vos
                    disponibilités</li>
                <li class="mode-emploi"><img src="../img/nbr2.png" alt="number1" class="imgnbr"> Un lien unique vous est attribué. Recopiez
                    le lien et synchronisez le avec tous vos profils.</li>
                <li class="mode-emploi"><img src="../img/nbr3.png" alt="number1" class="imgnbr"> Changez sans délai et sans contrainte
                    votre statut sur l'ensemble des plateformes.</li>
            </ul>
        </div>

        <!-- Header -->
        <header id="header">
            <a href="/" class="logo">Dispo.me</a>
        </header>

        <!-- Nav -->
        <nav id="nav">
            <ul class="links">
                <li class="active"><a href="{{ url('/public/posts/'.$posts[0]->slug) }}">A la une</a></li>
                @if ($user=Auth::user())
                {{-- <li><a href="{{ route ('profile.index') }}">Mon profil</a></li> --}}
                @endif
            </ul>
            <ul class="icons">
                <li><a href="#"><img src="../img/twitter-logo_318-40459.jpg " alt="logo-twitter" class="logo-img"></a></li>
                <li><a href="#"><img src="../img/facebook-symbol_318-37686.jpg" alt="logo-facebook" class="logo-img"></a></li>
                <li><a href="#"><img src="../img/logo-instagram.png" alt="logo-instagram" class="logo-img"></a></li>
                <li><a href="#"><img src="../img/logo-github.png" alt="logo-github" class="logo-img"></a></li>
            </ul>
        </nav>

        <!-- Main -->
        <div id="main">
            <!-- Featured Post -->
            <article class="post featured">
                <header class="major">
                    <span class="date">{{ date('j M, Y', strtotime($posts[0]->updated_at))}}</span>
                    <h2><a href="{{ url('/public/posts/'.$posts[0]->slug) }}">{{ $posts[0]->title }}</a></h2>
                    <p>{!! substr($posts[0]->content, 0, 400) !!}{!! (strlen($posts[0]->content)) > 400 ? "..." : ""!!}</p>
                </header>
                <hr>
                <ul class="actions special">
                    <li><a href="{{ url('/public/posts/'.$posts[0]->slug) }}" class="button large">Lire le focus</a></li>
                </ul>
            </article>

            <!-- Posts -->
            <section class="posts">
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[1]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[1]->slug) }}">{{ $posts[1]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[1]->content, 0, 400)!!}{!!strlen($posts[1]->content) > 400 ? "..." : ""!!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[1]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[2]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[2]->slug) }}">{{ $posts[2]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[2]->content, 0, 400)!!}{!!strlen($posts[2]->content) > 400 ? "..." : ""!!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[2]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[3]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[3]->slug) }}">{{ $posts[3]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[3]->content, 0, 400)!!}{!!strlen($posts[3]->content) > 400 ? "..." : ""!!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[3]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[4]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[4]->slug) }}">{{ $posts[4]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[4]->content, 0, 400)!!}{!!strlen($posts[4]->content) > 400 ? "..." : ""!!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[4]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[5]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[5]->slug) }}">{{ $posts[5]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[5]->content, 0, 400) !!}{!! strlen($posts[5]->content) > 400 ? "..." : ""!!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[5]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
                <article>
                    <header>
                        <span class="date">{{ date('j M, Y', strtotime($posts[6]->updated_at)) }}</span>
                        <h2><a href="{{ url('/public/posts/'.$posts[6]->slug) }}">{{ $posts[6]->title }}</a></h2>
                    </header>
                    <hr>
                    <p>{!! substr($posts[6]->content, 0, 400) !!}{!! strlen($posts[6]->content) > 400 ? "..." : "" !!}</p>
                    <ul class="actions special">
                        <li><a href="{{ url('/public/posts/'.$posts[6]->slug) }}" class="button">Lire le focus</a></li>
                    </ul>
                </article>
            </section>

            <!-- Footer -->
            <footer>
                <div class="pagination">
                    <!--<a href="#" class="previous">Prev</a>-->
                    {{-- <a href="#" class="page active">1</a>
                    <a href="#" class="page">2</a>
                    <a href="#" class="page">3</a>
                    <span class="extra">&hellip;</span>
                    <a href="#" class="page">8</a>
                    <a href="#" class="page">9</a>
                    <a href="#" class="page">10</a>
                    <a href="#" class="next">Next</a> --}}
                </div>
            </footer>

        </div>

        <!-- Footer -->
        <a type="hidden" id="anchor_form">coucoucoucou</a>
        <footer id="footer">
            <section>
                @if (Session::has('msg'))
                <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
                @endif
                <form method="POST">
                    @csrf
                    <div class="fields">
                        <div class="field">
                            <label for="name_contact_form">Nom</label>
                            <input type="text" name="name_contact_form" id="name_contact_form" />
                            @if ($errors->has('name_contact_form'))
                            <p class="alert alert-danger">{{ $errors->first('name_contact_form') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <label for="email_contact_form">Email</label>
                            <input type="text" name="email_contact_form" id="email_contact_form" />
                            @if ($errors->has('email_contact_form'))
                            <p class="alert alert-danger">{{ $errors->first('email_contact_form') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <label for="message_contact_form">Message</label>
                            <textarea name="message_contact_form" id="message_contact_form" rows="3"></textarea>
                            @if ($errors->has('message_contact_form'))
                            <p class="alert alert-danger">{{ $errors->first('message_contact_form') }}</p>
                            @endif
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Envoyer le message" /></li>
                    </ul>
                </form>
            </section>
        </footer>

        <!-- Copyright -->
        <div id="copyright">
            <ul>
                <li>&copy; Dispo.me</li>
                <li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
            </ul>
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

</body>

</html>
