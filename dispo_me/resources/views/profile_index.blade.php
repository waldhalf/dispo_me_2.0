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
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/"style="font-size: 20px; color:black;">Dispo.me</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                @if ($user=Auth::user())
                <li class="nav-item">
                  <a class=" btn btn-info" href="{{ url ('/profile/'.Auth::user()->id.'/edit') }}" style="font-size: 15px; color:black;">Mettre mon profil à jour</a>
                </li>
                <li class="nav-item">
                    <a class=" btn btn-danger" href="{{ url ('/profile/'.Auth::user()->id.'/delete') }}" style="font-size: 15px; color:black;">Effacer mon profil</a>
                  </li>
                @endif
                  </ul>
                </li>
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
                        <img class="img-circle img-responsive" alt="" src="{{'/img/profil-default.jpg'}}">
                      </figure>
                      
                      <div class="row">
                        <div class="col-xs-12 social-btns">
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-google">
                                <i class="fa fa-google"></i> </a>
                            </div>
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-facebook">
                                <i class="fa fa-facebook"></i> </a>
                            </div>
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-twitter">
                                <i class="fa fa-twitter"></i> </a>
                            </div>
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-linkedin">
                                <i class="fa fa-linkedin"></i> </a>
                            </div>
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-github">
                                <i class="fa fa-github"></i> </a>
                            </div>
                          
                            <div class="col-xs-3 col-md-1 col-lg-1 social-btn-holder">
                              <a href="#" class="btn btn-social btn-block btn-stackoverflow">
                                <i class="fa fa-stack-overflow"></i> </a>
                            </div>
                          
                        </div>
                      </div>
                      
                    </div>
        
                    <div class="col-xs-12 col-sm-8">
                      <ul class="list-group">
                        <li class="list-group-item">{{ $user->name }} {{ $user->last_name }}</li>
                        <li class="list-group-item">{{ $profile->actuel_job }}</li>
                        <li class="list-group-item">{{ $profile->actual_company }}</li>
                        @if ($profile->free == 1)
                        <li class="list-group-item">Disponible : Oui </li>
                        @else
                        <li class="list-group-item">Disponible : Non </li>
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
              <div class="bs-callout bs-callout-danger">
                <h4>Langages pratiqués</h4>
                <ul class="list-group">
                  <a class="list-group-item inactive-link" href="#">
                    
        
                    <div class="progress">
                      <div data-placement="top" style="width: 20%;" 
                      aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar progress-bar-warning">
                        <span class="sr-only">20%</span>
                        <span class="progress-type">Java/ JavaEE/ Spring Framework </span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-success">
                        <span class="sr-only">70%</span>
                        <span class="progress-type">PHP/ Lamp Stack</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-success">
                        <span class="sr-only">70%</span>
                        <span class="progress-type">JavaScript/ NodeJS/ MEAN stack </span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 65%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="1" role="progressbar" class="progress-bar progress-bar-warning">
                        <span class="sr-only">65%</span>
                        <span class="progress-type">Python/ Numpy/ Scipy</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                        <span class="sr-only">60%</span>
                        <span class="progress-type">C</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 50%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                        <span class="sr-only">50%</span>
                        <span class="progress-type">C++</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div data-placement="top" style="width: 10%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-danger">
                        <span class="sr-only">10%</span>
                        <span class="progress-type">Go</span>
                      </div>
                    </div>
        
                  </a>
        
                </ul>
              </div>
              <div class="bs-callout bs-callout-danger">
                <h4>Diplômes</h4>
                <table class="table table-striped table-responsive ">
                  <thead>
                    <tr><th>Nom du diplôme</th>
                    <th>Année d'obtention</th>
                  </tr></thead>
                  <tbody>
                    <tr>
                      <td>Masters in Computer Science and Engineering</td>
                      <td>2014</td>
                    </tr>
                    <tr>
                      <td>BSc. in Computer Science and Engineering</td>
                      <td>2011</td>
                    </tr>
                  </tbody>
                </table>
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