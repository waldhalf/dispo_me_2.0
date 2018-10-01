<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dispo.me</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ '/css/blog-post.css' }}" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Dispo.me</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/manual">Mode d'emploi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contact">Qui sommes-nous?</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            
        <!-- Post Content Column -->
            <div class="col-lg-8">
                
                
                <!-- Title -->
                <h1 class="mt-4">{{ $post[0]->title }}</h1>         
                <hr>   
                <!-- Date/Time -->
                <p>Le {{ date('j M, Y', strtotime($post[0]->updated_at))}}</p>
                <hr>
                <p>Url: <a href="{{ url('/public/posts/'.$post[0]->slug) }}">{{ url('/public/posts/'.$post[0]->slug) }}</a></p>
                <p><a class="btn btn-primary" href="{{route ('public.posts')}}">Revenir à l'index des métiers</a></p>
                <hr>
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/{{ $post[0]->img_path }}" alt="image représentant le job" style="width: 900px; height:300px;">
                <hr>
                <!-- Post Content -->
                <p class="lead">{{ $post[0]->content }} </p>
                <hr>
                {{-- {{ $post[0]->category->category_name}} --}}
            </div> 
        </div>
        

    
        </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Dispo.me 2018</p>
      </div>
      <!-- /.container -->
    </footer>



  </body>

</html>
