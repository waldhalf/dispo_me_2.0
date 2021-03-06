<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfileModel;
use App\SkillTagModel;
use App\User;
use App\Follow;
use App\Partner;
use App\PartnerProfile;
use App\Mail\EmailDispo;
use Session;
use Mail;
use DB;

class UserProfileController extends Controller
{

    public function getFollowedProfile() {
        $followedProfiles = [];
        $user_id = Auth::id();
        $list = Follow::where('follower_id', $user_id)->get();

        foreach ($list as $id) {
            $followed = UserProfileModel::where('user_id', $id->followed_id)->first();
            array_push($followedProfiles, $followed);
        }      
        
        return view ('profile_follow')->withFollowedProfiles($followedProfiles);
    }

    public function searchForm() {
        return view ('profile_search');
    }

    public function searchProfile(Request $request) {
        $tabProfiles    = [];
        $id_user_log = Auth::id();
        $explodedQuerry = explode(" ", $request->query_profile);

        // On appelle la fonction static research (à voir dans le modéle correspondant)
        $searchedTag = UserProfileModel::researchUserByTagOrName($explodedQuerry);

        // A la sortie de laravel 5.7 "groupBy" connait des pbs
        // les lignes suivantes sont là pour le faire "a la main"

        // On les met dans un array pour y avoir accés via un indice
        // qui commence à 0
        $list2 = [];
        foreach($searchedTag as $key=>$value) {
            array_push($list2, $value);
        }
        // Liste des suivi par suiveur
        $listFollowedByFollower = Follow::where('follower_id', $id_user_log)->get();
        
        // On va récupérer dans la base les lignes correspondantes avec
        // une id unique même si 2 tag se ressemblent (exemple CSS et CSS 3)
        // renvoie 2 lignes différentes alors qu'il s'agit du même profil
        // Le profil en question avait les deux tags donc.
        foreach ($list2 as $L) {
            $profile = UserProfileModel::where('user_id', $L->user_id)->first();
            array_push($tabProfiles, $profile);
        }
        // On ajoute l'attribut suivi à l'objet s'il fait partie des suivis du user
        for ($i = 0 ; $i < count($tabProfiles) ; $i++) {
            for ($j = 0 ; $j < count($listFollowedByFollower) ; $j++) {
                if ($tabProfiles[$i]->user_id == $listFollowedByFollower[$j]->followed_id) {
                    $tabProfiles[$i]->suivi = true;
                }
            }
        }
        // On rend les profils uniques
        $unique = array();
        foreach ($tabProfiles as $tag)
        {
            $unique[$tag['user_id']] = $tag;
        } 
        $data = array_values($unique);

        return view ('profile_search')->withTabProfiles($data);
    }

    public function getStep1() {
        $skills = SkillTagModel::all();
        return view('profile_create_step1')->withSkills($skills);
    }

    public function storeStep1(Request $request) {
        // Validation du formulaire profile_edit_step_1
        $validatesData = $request->validate([
            'profile_free'              => 'required',
            'profile_search'            => 'required',
            'profile_listen'            => 'required',
            'profile_notice'            => 'required|integer',
            'profile_percentage'        => 'required|integer|min:0|max:100',
            'profile_visible_on_web'    => 'required',
            'profile_visible_on_website'=> 'required',
            'searched_job'              => 'required',
            'actuel_job'                => 'required',
            'actual_company'            => 'required',
            'status_job'                => 'required'
        ]);
        $user = Auth::user();
        $user_id = Auth::id();

        $profile = new UserProfileModel;
        $profile->user_id               = $user_id;
        $profile->free                  = $request->profile_free;
        $profile->search_job            = $request->profile_search;
        $profile->listen                = $request->profile_listen;
        $profile->notice                = $request->profile_notice;
        $profile->percentage            = $request->profile_percentage;
        $profile->visible_on_web        = $request->profile_visible_on_web;
        $profile->visible_on_website    = $request->profile_visible_on_website;
        $profile->searched_job          = $request->searched_job;
        $profile->actuel_job            = $request->actuel_job;
        $profile->actual_company        = $request->actual_company;
        $profile->status_job            = $request->status_job;
        $profile->save();

        $user->has_profile = TRUE;
        $user->save();
        // On appelle la methode tags de UserProfileModel afin de lier
        // sur la table user_skill_tags le profile_id de la table user_profile
        // et le skill_tag_id dans la mếme table
        $profile->tags()->sync($request->skill_tags, false);
        Session::flash('msg', 'La première étape de votre profil a été enregistré');
        return redirect('/profile_step_2');
    }

    public function getStep2() {
        $dpts = DB::select('SELECT nom FROM dpts');
        $regions = DB::select('SELECT region_name FROM region');
        $partners = Partner::orderBy('ranking')->take(4)->get();
        return view('profile_create_step2')->withDpts($dpts)->withPartners($partners)->withRegions($regions);
    }

    public function storeStep2(Request $request) {
        // Validation du formulaire profile_edit_step_2
        $validatesData = $request->validate([
            'profile_city'          => 'required|min:2|max:255',
            'profile_city_range'    => 'required|integer',
            'profile_county'        => 'required',
            'profile_county_mobile' => 'required',
            'profile_region'        => 'required',
            'profile_region_mobile' => 'required',
            'profile_country_mobile'=> 'required',
            'profile_photo'         => 'mimes:png,jpg,jpeg|max:2048',
        ]);
        $user = Auth::user();
        $user_id = Auth::id();
        // On récupére les infos du step 1
        $profile = UserProfileModel::where('user_id', $user_id)->first();
        // On récupére les 4 premiers partenaires de la base de données que 'lon veut mettre en avant
        $partners = Partner::orderBy('ranking')->take(4)->get();
        
        // Test sur les entrées user pour s'assurer que l'url entré contient mot clef (regexp à faire pour être au plus juste)
        // Si le test échoue on affecte à l'entrée une valeur par défaut, ici, "Non renseigné"
        if ($request->profile_network_01 == NULL || strpos(strtolower($request->profile_network_01), strtolower($partners[0]->network_name)) === FALSE) {
            $request->profile_network_01 = 'Non renseigné';
        }
        if ($request->profile_network_02 == NULL || strpos(strtolower($request->profile_network_02), strtolower($partners[1]->network_name)) === FALSE) {
            $request->profile_network_02 = 'Non renseigné';
        }
        if ($request->profile_network_03 == NULL || strpos(strtolower($request->profile_network_03), strtolower($partners[2]->network_name)) === FALSE) {
            $request->profile_network_03 = 'Non renseigné';
        }
        if ($request->profile_network_04 == NULL || strpos(strtolower($request->profile_network_04), strtolower($partners[3]->network_name)) === FALSE) {
            $request->profile_network_04 = 'Non renseigné';
        }
        // Récupération du nom du fichier en provenance du form, déplacement dans le dossier profile_photo et sauvegarde
        // du path dans la BD
        if ($request->file('profile_photo') != null){
            $photo = $request->file('profile_photo');
            $newPhotoName = rand(). '.' . $photo->getClientOriginalExtension();
            $newPhotoName = '/img/profile_img/'.$newPhotoName;
            $photo->move(public_path('/img/profile_img/'), $newPhotoName);
            $profile->profile_photo = $newPhotoName;
        }
        
        $profile->user_id                   = $user_id;
        $profile->profile_city              = $request->profile_city;
        $profile->profile_city_range        = $request->profile_city_range;
        $profile->profile_county            = $request->profile_county;
        $profile->profile_county_mobile     = $request->profile_county_mobile;
        $profile->profile_region            = $request->profile_region;
        $profile->profile_region_mobile     = $request->profile_region_mobile;
        $profile->profile_country_mobile    = $request->profile_country_mobile;
        
        $profile->save();
        $index = 0;
        $tabPartners = [
            $request->profile_network_01,
            $request->profile_network_02,
            $request->profile_network_03,
            $request->profile_network_04
        ];
        $tabVisible = [
            $request->profile_network_01_visible,
            $request->profile_network_02_visible,
            $request->profile_network_03_visible,
            $request->profile_network_04_visible
        ];
        foreach ($partners as $partner) {
            $tmp = new PartnerProfile;
            $tmp->profile_id = $profile->id;
            $tmp->partner_id = $partner->id;
            $tmp->urlPartner = $tabPartners[$index];
            $tmp->visible    = $tabVisible[$index];
            $index++;
            $tmp->save();
        }        

        Session::flash('msg', 'Votre profil complet a bien été créé');
        
        return redirect('/profile/'. Auth::user()->slug);
        
    }

    public function getProfile($slug) {
        $user       = User::where('slug', $slug)->first();
        $profile    = UserProfileModel::where('user_id', $user->id)->first();
        $partners   = PartnerProfile::join('partners', 'partners.id', '=', 'partners_UserProfile.partner_id')
        ->where('profile_id', $profile->id)->get();

        return view('profile_index')->withProfile($profile)->withUser($user)->withPartners($partners);
    }

    public function editStep1($id) {
        $user = User::find($id);

        $user_id = Auth::id();
        if ($user_id != (int)$id)
        {
            return 'Vous ne pouvez pas modifier un profil qui n\'est pas le vôtre!';
        }

        $profile = UserProfileModel::where('user_id', $user->id)->first();
        $skills = SkillTagModel::all();  
        return view ('profile_edit_step1')->withProfile($profile)->withSkills($skills);
    }

    public function updateStep1(Request $request, $id) {
        $validatesData = $request->validate([
            'profile_free'              => 'required',
            'profile_search'            => 'required',
            'profile_listen'            => 'required',
            'profile_notice'            => 'required|integer',
            'profile_percentage'        => 'required|integer|min:0|max:100',
            'profile_visible_on_web'    => 'required',
            'profile_visible_on_website'=> 'required',
            'searched_job'              => 'required',
            'actuel_job'                => 'required',
            'actual_company'            => 'required',
            'status_job'                => 'required'
        ]);
        $user = User::find($id);
        $profile = UserProfileModel::where('user_id', $user->id)->first();
        // On récupére de la BD l'état du User avant modif
        $free = $profile->free;
        $search_job = $profile->search_job;
        $listen = $profile->listen;
        // On récupére la liste des personnes qui suivent le user
        $listeFollower = Follow::where('followed_id', $user->id)->get();
        // On teste chacun des statuts entre l'ancien et le nouveau statut
        // Si un des trois statut a changé on envoie un mail de notif au follower
        if ($free != $request->profile_free || 
            $search_job != $request->profile_search || 
            $listen != $request->profile_listen &&
            $listeFollower != null) {

                $data = array(
                    'name'          => $user->name,
                    'last_name'     => $user->last_name,
                    'bodyMessage'   => 'a changé son statut. Ce message vous est envoyé depuis le site dispo.me : http://www.dispo.me', 
                    'email'         => 'dispo.me.contact@gmail.com',
                    'slug'          => 'http://www.dispo.me/profile/' . $user->slug
            );
            // Pour ajouter $toFollower il faut l'inclure dans la closure car le scope de la closure est restreint
            foreach ($listeFollower as $follower) {
                $toFollower = User::where('id', $follower->follower_id)->first();

                Mail::to($toFollower)->send(new EmailDispo($data));
            }
        }
        $profile->free              = $request->profile_free;
        $profile->search_job        = $request->profile_search;
        $profile->listen            = $request->profile_listen;
        $profile->notice            = $request->profile_notice;
        $profile->percentage        = $request->profile_percentage;
        $profile->visible_on_web    = $request->profile_visible_on_web;
        $profile->visible_on_website= $request->profile_visible_on_website;
        $profile->searched_job      = $request->searched_job;
        $profile->actuel_job        = $request->actuel_job;
        $profile->actual_company    = $request->actual_company;
        $profile->status_job        = $request->status_job;
        $profile->save();
        
        // Si le user ne rentre aucun skill_tag on fait la vérif avant la
        // syncronisation. Si rien n'est passé on envoie un array vide car
        // le paramètre attendu est un array 
        if (isset($request->skill_tags)) {
            $profile->tags()->sync($request->skill_tags, true);
        } 
        else {
            $profile->tags()->sync(array());
        }

        Session::flash('msg', 'Votre profil a bien été mis à jour');

        return redirect('/profile/'. $id .'/edit_step_2');
        // return redirect('/profile/'.Auth::user()->slug);
    }

    public function editStep2($id) {
        $user = User::find($id);
        $user_id = Auth::id();
        
        $profile = UserProfileModel::where('user_id', $user->id)->first();
        $partners = PartnerProfile::
        join('partners', 'partners.id', '=', 'partners_UserProfile.partner_id')
        ->join('user_profile', 'user_profile.id', '=', 'partners_UserProfile.profile_id')
        ->where('user_profile.id', $profile->id)
        ->orderBy('ranking')
        ->get();
        $regions = DB::select('SELECT region_name FROM region');
        
        if ($user_id != (int)$id)
        {
            return 'Vous ne pouvez pas modifier un profil qui n\'est pas le vôtre!';
        }

        $dpts = DB::select('SELECT nom from dpts');        

        return view ('profile_edit_step2')->withProfile($profile)->withDpts($dpts)->withPartners($partners)->withRegions($regions);
    }

    public function updateStep2(Request $request, $id) {
        // Validation du formulaire profile_update_step_2
        $validatesData = $request->validate([
            'profile_city'          => 'required|min:2|max:255',
            'profile_city_range'    => 'required|integer',
            'profile_county'        => 'required',
            'profile_county_mobile' => 'required',
            'profile_region'        => 'required',
            'profile_region_mobile' => 'required',
            'profile_country_mobile'=> 'required',
            'profile_photo'         => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = User::find($id);
        $user_id = Auth::id();
        $profile = UserProfileModel::where('user_id', $user->id)->first();

        if ($request->file('profile_photo') != null){
            $photo = $request->file('profile_photo');
            $newPhotoName = rand(). '.' . $photo->getClientOriginalExtension();
            $newPhotoName = '/img/profile_img/'.$newPhotoName;
            $photo->move(public_path('/img/profile_img/'), $newPhotoName);
            $profile->profile_photo = $newPhotoName;
        }
        
        $profile->user_id                   = $user_id;
        $profile->profile_city              = $request->profile_city;
        $profile->profile_city_range        = $request->profile_city_range;
        $profile->profile_county            = $request->profile_county;
        $profile->profile_county_mobile     = $request->profile_county_mobile;
        $profile->profile_region            = $request->profile_region;
        $profile->profile_region_mobile     = $request->profile_region_mobile;
        $profile->profile_country_mobile    = $request->profile_country_mobile;

        $profile->save();

        // On récupére les 4 premiers partenaires de la base de données que l'on veut mettre en avant
        $partners = Partner::
        join('partners_UserProfile', 'partners_UserProfile.partner_id', '=', 'partners.id')
        ->where('profile_id', $profile->id)
        ->orderBy('ranking')
        ->get();

        // Test sur les entrées user pour s'assurer que l'url entrée contient mot clef (regexp à faire pour être au plus juste)
        // Si le test échoue on affecte à l'entrée une valeur par défaut, ici, "Non renseigné"
        if ($request->profile_network_01 == NULL || strpos(strtolower($request->profile_network_01), strtolower($partners[0]->network_name)) === FALSE) {
            $request->profile_network_01 = 'Non renseigné';
        }
        if ($request->profile_network_02 == NULL || strpos(strtolower($request->profile_network_02), strtolower($partners[1]->network_name)) === FALSE) {
            $request->profile_network_02 = 'Non renseigné';
        }
        if ($request->profile_network_03 == NULL || strpos(strtolower($request->profile_network_03), strtolower($partners[2]->network_name)) === FALSE) {
            $request->profile_network_03 = 'Non renseigné';
        }
        if ($request->profile_network_04 == NULL || strpos(strtolower($request->profile_network_04), strtolower($partners[3]->network_name)) === FALSE) {
            $request->profile_network_04 = 'Non renseigné';
        }
        // On récupére les entrées Form et on les met dans un tableau afin de pouvoir boucler dedans avec un foreach
        //(Il faudra trouver quelquechose de plus élégant)
        $index=0;
        $tabPartners = [
            $request->profile_network_01,
            $request->profile_network_02,
            $request->profile_network_03,
            $request->profile_network_04
        ];
        $tabVisible = [
            $request->profile_network_01_visible,
            $request->profile_network_02_visible,
            $request->profile_network_03_visible,
            $request->profile_network_04_visible
        ];
        foreach ($partners as $partner) {
            $partner = PartnerProfile::find($partner->id);
            $partner->urlPartner = $tabPartners[$index];
            $partner->visible = $tabVisible[$index];
            $partner->save();
            $index++;
        }

        Session::flash('msg', 'Votre profil complet a bien été mis à jour');
        
        return redirect('/profile/'. Auth::user()->slug);

    }

    public function addFollowed($id_followed) {
        
        $follower = UserprofileModel::where('user_id',Auth::id())->first();
        $followed = UserprofileModel::where('user_id',$id_followed)->first();
        $follows_maybe = Follow::where('follower_id', $follower->user_id)->where('followed_id', $followed->user_id)->first();
        if ($follows_maybe ==  null) {
            $follows = new Follow();
            $follows->follower_id = $follower->user_id;
            $follows->followed_id = $followed->user_id;
            $follows->save();
            Session::flash('msg', 'Le profil a bien été ajouté à votre liste de suivi');
            return redirect()->route('profile.followed');
        }
        else {
            Session::flash('msg', 'Vous suivez déjà ce profil');
            return redirect()->route('profile.followed');
        }
    }

    public function deleteFollowed($id_followed) { 
        $follower = UserprofileModel::where('user_id',Auth::id())->first();
        $followed = UserprofileModel::where('user_id',$id_followed)->first();
        $follows = Follow::where('follower_id', $follower->user_id)->where('followed_id', $followed->user_id);
        $follows->delete();
        Session::flash('msg', 'Le profil a bien été effacé de votre liste de suivi');
        return redirect()->route('profile.followed');
    }

    public function destroy($id) {  
        // dd($user_profile);
        $user = User::find($id);
        $user_profile = UserProfileModel::where('user_id', $user->id)->first();
        // On enléve de la base référentielle les occurences du user_profile
        $user_profile->tags()->detach();
        $user_profile->delete();

        $user->has_profile = FALSE;
        $user->save();

        Session::flash('msg', 'Votre profil a bien été effacé');

        return redirect('/'); 
    }

}
