@extends('layouts/app')

@section('content')
<div class="container">
        <h1 class="text-center">Step 1 du profil</h1>
    <div class="row">
        <div class = "col-md-6">
            <form action="" method="POST" class="well">
            @csrf
            <h4 class="head">Créer votre compte gratuitement</h4>
            <div class="sect">
                <div class="form-group">
                <label for="profile_free">Êtes-vous actuellement disponible ? &nbsp; </label></br>
                <input type="radio" name="profile_free" value="1" class="radio-inline" checked="checked"> Oui <input type="radio" name="profile_free" value="0" class="radio-inline"> Non
                @if ($errors->has('profile_free'))
                <p class="alert alert-danger">{{ $errors->first('profile_free') }}</p>
                @endif
                </div>
            </div>
            <div class="sect">
                <div class="form-group">
                <label for="profile_search">Êtes-vous à la recherche d'emploi ? &nbsp; </label> </br>
                <input type="radio" name="profile_search" value="1" class="radio-inline" checked="checked"> Oui <input type="radio" name="profile_search" value="0" class="radio-inline"> Non
                @if ($errors->has('profile_search'))
                <p class="alert alert-danger">{{ $errors->first('profile_search') }}</p>
                @endif
                </div>
            </div>
            <div class="sect">
                <div class="form-group">
                    <label for="profile_listen">Êtes-vous à l'écoute du marché ? &nbsp; </label> </br>
                    <input type="radio" name="profile_listen" value="1" class="radio-inline" checked="checked"> Oui <input type="radio" name="profile_listen" value="0" class="radio-inline"> Non
                    @if ($errors->has('profile_listen'))
                    <p class="alert alert-danger">{{ $errors->first('profile_listen') }}</p>
                    @endif
                </div>
            </div>
            <div class="sect">
                <div class="form-group">
                <label for="profile_notice">Durée de votre préavis (en jours)</label>
                <input type="text" name="profile_notice" class="form-control" id="profile_notice" placeholder=" exemple : 90">
                @if ($errors->has('profile_notice'))
                <p class="alert alert-danger">{{ $errors->first('profile_notice') }}</p>
                @endif
                </div>
            </div>
                <div class="sect">
                <div class="form-group">
                <label for="profile_percentage">Temps de travail disponible</label>
                <input type="text" name="profile_percentage" class="form-control" id="profile_percentage" placeholder="exemple : 50">
                @if ($errors->has('profile_percentage'))
                <p class="alert alert-danger">{{ $errors->first('profile_percentage') }}</p>
                @endif
                </div>
            </div>
            <div class="sect">
                <div class="form-group">
                    <label for="profile_visible_on_web">Souhaitez-vous être visible sur le Web ? &nbsp; </label> </br>
                    <input type="radio" name="profile_visible_on_web" value="1" class="radio-inline" checked="checked"> Oui
                    <input type="radio" name="profile_visible_on_web" value="0" class="radio-inline"> Non
                    @if ($errors->has('profile_visible_on_web'))
                    <p class="alert alert-danger">{{ $errors->first('profile_visible_on_web') }}</p>
                    @endif
                </div>
            </div>
            <div class="sect">
                <div class="form-group">
                    <label for="profile_visible_on_website">Souhaitez-vous être visible dans les recherches du site ? &nbsp; </label> </br>
                    <input type="radio" name="profile_visible_on_website" value="1" class="radio-inline" checked="checked"> Oui
                    <input type="radio" name="profile_visible_on_website" value="0" class="radio-inline"> Non
                    @if ($errors->has('profile_visible_on_website'))
                    <p class="alert alert-danger">{{ $errors->first('profile_visible_on_website') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class = "col-md-6">
            <div class="sect">
                <div class="form-group">
                    <label for="searched_job">Emploi recherché ? &nbsp; </label> </br>
                    <input type="text" name="searched_job" class="form-control" id="searched_job" placeholder=" exemple : Web Developper">
                    @if ($errors->has('searched_job'))
                    <p class="alert alert-danger">{{ $errors->first('searched_job') }}</p>
                    @endif
                </div>
            </div>
            <div class="sect">
                    <div class="form-group">
                        <label for="actual_job">Emploi actuel &nbsp; </label> </br>
                        <input type="text" name="actual_job" class="form-control" id="actual_job" placeholder=" exemple : Web Developper">
                        @if ($errors->has('actual_job'))
                        <p class="alert alert-danger">{{ $errors->first('actual_job') }}</p>
                        @endif
                    </div>
            </div>
            <div class="sect">
                    <div class="form-group">
                        <label for="actual_company">Entreprise actuelle &nbsp; </label> </br>
                        <input type="text" name="actual_company" class="form-control" id="actual_company" placeholder=" exemple : Web Developper">
                        @if ($errors->has('actual_company'))
                        <p class="alert alert-danger">{{ $errors->first('actual_company') }}</p>
                        @endif
                    </div>
            </div>
            <div class="sect">
                    <div class="form-group">
                        <label for="status_job">Statut &nbsp; </label> </br>
                        <select id="status_job" name="status_job" class="form-control">
                                <option value="CDD">CDD</option> 
                                <option value="CDI" selected>CDI</option>
                                <option value="Contrat d'apprentissage">Contrat d'apprentissage</option>
                                <option value="Contrat professionnel">Contrat professionnel</option>
                                <option value="Contrat de travail intermittent">Contrat de travail intermittent</option>
                                <option value="Contrat de travail saisonnier">Contrat de travail saisonnier</option>
                                <option value="Indépendant">Indépendant</option>
                                <option value="Portage salarial">Portage salarial</option>
                                <option value="Stagiaire">Stagiaire</option>
                                <option value="Autre">Autre</option>
                              </select>
                        @if ($errors->has('status_job'))
                        <p class="alert alert-danger">{{ $errors->first('status_job') }}</p>
                        @endif
                    </div>
            </div>
            <div class="sect">
                    <div class="form-group">
                        <label for="actual_company">Compétences &nbsp; </label> </br>
                        <input type="text" name="actual_company" class="form-control" id="actual_company" placeholder=" exemple : Web Developper">
                        @if ($errors->has('actual_company'))
                        <p class="alert alert-danger">{{ $errors->first('actual_company') }}</p>
                        @endif
                    </div>
            </div>








        </div><!-- Fin du secon col-md-6-->
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="{{ route ('welcome') }}" class="btn btn-danger">Finir plus tard</a>
                </form>
            </div>
    </div><!-- Fin du row-->
    
 
</div><!-- Fin du container-->
@endsection