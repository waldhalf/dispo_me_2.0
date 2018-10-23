
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


<div class="container">
    <br>
    <h1>Page Admin</h1>
    <hr>
    <br>
    <p><a href="{{ url ('/posts') }}" type="button" class="btn btn-success rounded inline-block">Liste des posts</a></p>
    <p><a href="{{ route ('partners.index') }}" type="button" class="btn btn-success rounded">Liste des partenaire</a></p>
    <p><a href="{{ url ('/posts/create') }}" type="button" class="btn btn-success rounded">Créer un post</a></p>
    <p><a href="{{ url ('/categories/index') }}" type="button" class="btn btn-success rounded">Créer une catégorie</a></p>
    <p><a href="{{ url ('/tags/create') }}" type="button" class="btn btn-success rounded">Créer Tags de compétences</a></p>
    <p><a href="{{ route ('partners.create') }}" type="button" class="btn btn-success rounded">Créer un partenaire</a></p>
    
    <p><a class="navbar-brand" href="/">Retour à la page d'accueil</a></p>
</div>