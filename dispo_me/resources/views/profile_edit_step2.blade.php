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
        <h1 class="text-center head-profile">Editer votre Profil : étape 2/2</h1>
        <form action="" method="POST" class="well" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <h4>Ma zone géographique</h4>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_city">Votre ville</label>
                            <input type="text" value="{{ $profile->profile_city }}" name="profile_city" class="form-control" id="profile_city" placeholder="Votre ville">
                            @if ($errors->has('profile_city'))
                            <p class="alert alert-danger">{{ $errors->first('profile_city') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_city_range">Par rapport à votre lieu d'habitation combien de kms
                                êtes-vous prêt à faire?</label>
                            <input type="text" name="profile_city_range" class="form-control" value="{{ $profile->profile_city_range }}" id="profile_city_range"
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
                                <option value="{{$dpt->nom}}">{{$dpt->nom}}</option>
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
                            <label for="profile_network_01">Votre profil {{ $partners[0]->network_name}}</label>
                            <input type="text" name="profile_network_01" class="form-control" id="profile_network_01"
                                value="{{ $partners[0]->urlPartner}}">
                            @if ($errors->has('profile_network_01'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_01') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_01_visible">Souhaitez vous que votre profil {{ $partners[0]->network_name}} apparaisse sur
                                votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_network_01_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_network_01_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_network_01_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_01_visible') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_02">Votre profil {{ $partners[1]->network_name}}</label>
                            <input type="text" name="profile_network_02" class="form-control" id="profile_network_02"
                            value="{{ $partners[1]->urlPartner}}">
                            @if ($errors->has('profile_network_02'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_02') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_02_visible">Souhaitez vous que votre profil {{ $partners[1]->network_name}} apparaisse
                                sur votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_network_02_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_network_02_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_network_02_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_02_visible') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_03">Votre profil {{ $partners[2]->network_name}}</label>
                            <input type="text" name="profile_network_03" class="form-control" id="profile_network_03"
                            value="{{ $partners[2]->urlPartner}}">
                            @if ($errors->has('profile_network_03'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_03') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_03_visible">Souhaitez vous que votre profil {{ $partners[2]->network_name}} apparaisse sur
                                votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_network_03_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_network_03_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_network_03_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_03_visible') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_04">Votre profil {{ $partners[3]->network_name}}</label>
                            <input type="text" name="profile_network_04" class="form-control" id="profile_network_04"
                            value="{{ $partners[3]->urlPartner}}">
                            @if ($errors->has('profile_network_04'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_04') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="sect">
                        <div class="form-group">
                            <label for="profile_network_04_visible">Souhaitez vous que votre profil {{ $partners[3]->network_name}} apparaisse
                                sur votre fiche? &nbsp; </label> </br>
                            <input type="radio" name="profile_network_04_visible" value="1" class="radio-inline" checked="checked">
                            Oui <input type="radio" name="profile_network_04_visible" value="0" class="radio-inline"> Non
                            @if ($errors->has('profile_network_04_visible'))
                            <p class="alert alert-danger">{{ $errors->first('profile_network_04_visible') }}</p>
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
