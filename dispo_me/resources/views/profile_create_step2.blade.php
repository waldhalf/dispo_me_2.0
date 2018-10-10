<!DOCTYPE html>

<html>

<head>

    <title>Dispo.me | Mon profil</title>

    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

    <link rel="stylesheet" href="{{'/css/profile.css'}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<body>
    <div class="container">
        <h1 class="text-center head-profile">Compléter votre Profil : étape 2/2</h1>
        <form action="" method="POST" class="well" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <h4>Ma zone géographique</h4>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_city">Votre ville</label>
                            <input type="text" name="profile_city" class="form-control" id="profile_city" placeholder="Votre ville">
                            @if ($errors->has('profile_city'))
                            <p class="alert alert-danger">{{ $errors->first('profile_city') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_city_range">Par rapport à votre lieu d'habitation combien de kms
                                êtes-vous prêt à faire?</label>
                            <input type="text" name="profile_city_range" class="form-control" id="profile_city_range"
                                placeholder="exemple : 50">
                            @if ($errors->has('profile_city_range'))
                            <p class="alert alert-danger">{{ $errors->first('profile_city_range') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_county">Votre département</label>
                            <select name="profile_county" class="form-control" id="profile_county">
                                @foreach ($dpts as $dpt)
                                <option value="{{ $dpt->nom }}">{{ $dpt->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_county_mobile">Êtes-vous mobile dans votre département? &nbsp; </label>
                            </br>
                            <input type="radio" name="profile_county_mobile" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_county_mobile" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_county_mobile'))
                            <p class="alert alert-danger">{{ $errors->first('profile_county_mobile') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_region">Votre Région</label>
                            <select name="profile_region" class="form-control" id="profile_region">
                                    <option value="Hauts de France">Hauts de France</option>
                                    <option value="Normandie">Normandie</option>
                                    <option value="Ile de France">Ile de France</option>
                                    <option value="Grand Est">Grand Est</option>
                                    <option value="Bretagne">Bretagne</option>
                                    <option value="Pays de la Loire">Pays de la Loire</option>
                                    <option value="Centre Val de Loire">Centre Val de Loire</option>
                                    <option value="Bourgogne Franche-Comté">Bourgogne Franche-Comté</option>
                                    <option value="Nouvelle Aquitaine">Nouvelle Aquitaine</option>
                                    <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
                                    <option value="Occitanie">Occitanie/option>
                                    <option value="Provence-Alpes-Côtes d'Azur">Provence-Alpes-Côtes d'Azur</option>
                                    <option value="Corse">Corse</option>
                            </select>
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_region_mobile">Êtes-vous mobile dans votre région? &nbsp; </label> </br>
                            <input type="radio" name="profile_region_mobile" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_region_mobile" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_region_mobile'))
                            <p class="alert alert-danger">{{ $errors->first('profile_region_mobile') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_country_mobile">Êtes-vous mobile à l'échelle nationale? &nbsp; </label>
                            </br>
                            <input type="radio" name="profile_country_mobile" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_country_mobile" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_country_mobile'))
                            <p class="alert alert-danger">{{ $errors->first('profile_country_mobile') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_photo">Votre photo (non obligatoire)</label>
                            <input type="file" class="btn" id="profile_photo" name="profile_photo">
                            @if ($errors->has('profile_photo'))
                            <p class="alert alert-danger">{{ $errors->first('profile_photo') }}</p>
                            @endif
                        </div>
                    </div>

                </div>
                <!--Fin de la première md-6-->
                <div class="col-md-6">
                    <h4>Mes réseaux sociaux</h4>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_google">Votre profil Google</label>
                            <input type="text" name="profile_google" class="form-control" id="profile_google"
                                placeholder="Le lien vers vers profil Google (non obligatoire)">
                            @if ($errors->has('profile_google'))
                            <p class="alert alert-danger">{{ $errors->first('profile_google') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_google_visible">Souhaitez vous que votre profil Google apparaisse sur
                                votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_google_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_google_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_google_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_google_visible') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_linkedin">Votre profil LinkedIn</label>
                            <input type="text" name="profile_linkedin" class="form-control" id="profile_linkedin"
                                placeholder="Le lien vers vers profil LinkedIn (non obligatoire)">
                            @if ($errors->has('profile_linkedin'))
                            <p class="alert alert-danger">{{ $errors->first('profile_linkedin') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_linkedin_visible">Souhaitez vous que votre profil LinkedIn apparaisse
                                sur votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_linkedin_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_linkedin_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_linkedin_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_linkedin_visible') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_viadeo">Votre profil Viadeo</label>
                            <input type="text" name="profile_viadeo" class="form-control" id="profile_viadeo"
                                placeholder="Le lien vers vers profil Viadéo (non obligatoire)">
                            @if ($errors->has('profile_viadeo'))
                            <p class="alert alert-danger">{{ $errors->first('profile_viadeo') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_viadeo_visible">Souhaitez vous que votre profil Viadeo apparaisse sur
                                votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_viadeo_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_viadeo_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_viadeo_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_viadeo_visible') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_facebook">Votre profil Facebook</label>
                            <input type="text" name="profile_facebook" class="form-control" id="profile_facebook"
                                placeholder="Le lien vers vers profil Facebook (non obligatoire)">
                            @if ($errors->has('profile_facebook'))
                            <p class="alert alert-danger">{{ $errors->first('profile_facebook') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_facebook_visible">Souhaitez vous que votre profil Facebook apparaisse
                                sur votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_facebook_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_facebook_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_facebook_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_facebook_visible') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <a href="{{ route ('welcome') }}" class="btn btn-danger">Revenir à la page d'accueil</a>
                    </div>
                </div><!-- Fin du secon col-md-6-->
            </div>
    </div><!-- Fin du row-->
    </form>

    </div><!-- Fin du container-->


    <script>
        $(document).ready(function () {
            $(".sel-status").select2({
                placeholder: 'Compétences'
            });
        });

    </script>
</body>

</html>
