<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ '/css/profile.css' }}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Profil</title>
</head>
<body>    
        <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                                    <div class="file btn btn-lg btn-primary">
                                        Changer la Photo
                                        <input type="file" name="file"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                            <h5>
                                                Nom du User à mettre ici
                                            </h5>
                                            <h6>
                                                Mon emploi à mettre ici
                                            </h6>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mon Profil</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editer mon profil"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-work">
                                    <p>Infos Personnelles</p>
                                    <a href="">Région</a><br/>
                                    <a href="">Profil Linkdin?</a><br/>
                                    <a href="">A définir</a>
                                    <p>Mes compétences</p>
                                    <a href="">PHP</a><br/>
                                    <a href="">Laravel</a><br/>
                                    <a href="">Python</a><br/>
                                    <a href="">Django</a><br/>
                                    <a href="">C#</a><br/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Nom</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Default</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Disponible</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Default</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>En recherche</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Default</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>A l'écoute</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Default</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Préavis</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Default</p>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Profession</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Default</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Visible sur le web</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Default</p>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Visible sur le site</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Default</p>
                                                        </div>
                                                </div> 
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Mon url Unique</label>
                                                        </div>
                                                </div>
                                                <div class="row">                                    
                                                        <div class="col-md-6">
                                                            <p><a href="http://"> http://dispo.me/profile/mon_slugfdfdsfsdfsdfsdfsdfsdfsdfsfsfsd</a></p>
                                                        </div>
                                                </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
</body>
</html>