<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Présentation des métiers</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ '/css/blog-post.css' }}" rel="stylesheet">

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Dispo.me</a>
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
    <!-- Page Content -->
    <div class="container">
        <!-- Post Content Column -->
        <div class="row">
            <div class="col-lg-8">
            
                @foreach ($posts as $post)     
                <!-- Title -->
                <h1 class="mt-4">{{ $post->title }}</h1>
                            
                <hr>   
                <!-- Date/Time -->
                <p>Le {{ date('j M, Y', strtotime($post->updated_at))}}</p>
                <hr>
                <p>Url: <a href="{{ url('/public/posts/'.$post->slug) }}">{{ url('/public/posts/'.$post->slug) }}</a></p>
                <hr>
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/{{ $post->img_path }}" alt="image représentant le job" style="width: 900px; height:300px;">
                <hr>
                <!-- Post Content -->
                <p class="lead">{!! substr($post->content, 0, 400) !!}{!! strlen($post->content) > 400 ? "..." : ""!!} <a href="{{ url('/public/posts/'.$post->slug) }}">Lire la suite</a></p>
                <hr>

                @endforeach
            </div>
        </div>
        
        
        
        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
            {!! $posts->links() !!}
          </div>
          </div>
        </div> 
        
      </div>
      <!-- /.container -->
      <!-- Pagination -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Dispo.me 2018</p>
      </div>
      <!-- /.container -->
      
    </footer>



  </body>

</html>
