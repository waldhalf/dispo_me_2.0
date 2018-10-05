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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                <h1 class="mt-4">{{ $post->title }}</h1>
                <hr>
                <!-- Date/Time -->
                <p>Le {{ date('j M, Y', strtotime($post->updated_at))}}</p>
                <hr>
                <p>Url: <a href="{{ url('/public/posts/'.$post->slug) }}">{{ url('/public/posts/'.$post->slug) }}</a></p>
                <p><a class="btn btn-primary" href="{{route ('public.posts')}}">Revenir à l'index des métiers</a></p>
                <hr>
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/{{ $post->img_path }}" alt="image représentant le job" style="width: 900px; height:300px;">
                <hr>
                <!-- Post Content -->
                <p class="lead">{{ $post->content }} </p>
                <hr>
                {{-- {{ $post[0]->category->category_name}} --}}
            </div>
        </div><!-- Fin de la Row 1 -->

        <div class="row">
            <div class="col-md-8">
                @foreach ($post->comments as $comment)
                <div class="comment">
                  <div class="author-info">
                    <img src="" alt="img" class="author-img">
                    <div class="author-name">
                      <h4>{{ $comment->name }}</h4>
                      <p>{{ date('j M, Y', strtotime($comment->updated_at))}}</p>
                    </div>
                  </div>
                  <div class="comment-content">
                    {{ $comment->comment }}
                  </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="row">
            <div class="comment-form">
                @csrf
                @if (Session::has('msg'))
                <div class="col-md-8">
                    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
                </div>
                @endif
                {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
                <div class="row">
                    <div class="col-md-4">
                        {{ Form::label('name', 'Nom: ')}}
                        {{ Form::text('name', null, ['class' => 'form-control'])}}
                        @if ($errors->has('name'))
                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('email', 'Email: ')}}
                        {{ Form::text('email', null, ['class' => 'form-control'])}}
                        @if ($errors->has('email'))
                        <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        {{ Form::label('comment', 'Commentaire: ')}}
                        {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])}}
                        @if ($errors->has('comment'))
                        <p class="alert alert-danger">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        {{ Form::submit('Ajouter un commentaire', ['class' => 'btn btn-success mt-3 mb-3 btn-block'])}}
                    </div>
                </div><!-- Fin de la row -->
                {{ Form::close() }}
            </div>
        </div><!-- Fin de la row 2 -->


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
