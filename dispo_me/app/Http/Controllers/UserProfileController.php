<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfileModel;
use App\SkillTagModel;
use App\User;
use Session;
use DB;

class UserProfileController extends Controller
{

    public function getFollowedProfile() {
        return view ('profile_follow');
    }

    public function searchForm() {
        return view ('profile_search');
    }

    public function searchProfile(Request $request) {
        $searchedTag = DB::table('skill_tags')
        ->join('user_skill_tags', 'skill_tags.id', '=', 'user_skill_tags.skill_tag_id' )
        ->join('user_profile', 'user_profile.id' , '=', 'user_skill_tags.profile_id')
        ->where('skill_name', 'like', '%' . $request->query_profile .'%')
        ->get();

        $tabProfiles = [];

        foreach ($searchedTag as $tag){
            $profile = UserProfileModel::where('id', $tag->profile_id)->first();
            array_push($tabProfiles, $profile);
        }
        
        return view ('profile_search')->withtabProfiles($tabProfiles);
    }

    public function getStep1() {
        $skills = SkillTagModel::all();
        return view('profile_create_step1')->withSkills($skills);
    }

    public function storeStep1(Request $request) {
        // dd($request);
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
        $profile->user_id = $user_id;
        $profile->free = $request->profile_free;
        $profile->search_job = $request->profile_search;
        $profile->listen = $request->profile_listen;
        $profile->notice = $request->profile_notice;
        $profile->percentage = $request->profile_percentage;
        $profile->visible_on_web = $request->profile_visible_on_web;
        $profile->visible_on_website = $request->profile_visible_on_website;
        $profile->searched_job = $request->searched_job;
        $profile->actuel_job = $request->actuel_job;
        $profile->actual_company = $request->actual_company;
        $profile->status_job = $request->status_job;
        $profile->save();

        $user->has_profile = TRUE;
        $user->save();
        // On appelle la methode tags de UserProfileModel afin de lier
        //sur la table user_skill_tags le profile_id de la table user_profile
        // et le skill_tag_id dans la mếme table
        $profile->tags()->sync($request->skill_tags, false);
        Session::flash('msg', 'La première étape de votre profil a été enregistré');
        return redirect('/profile_step_2');
        // return redirect('/profile/'.Auth::user()->slug);
    }

    public function getStep2() {
        return view('profile_create_step2');
    }

    public function storeStep2(Request $request) {
        // dd($request);
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
        $profile = UserProfileModel::where('user_id', $user_id)->first();
        // récupération du nom du fichier, déplacement dans le dossier profile_photo et sauvegarde
        // du path dans la BD
        if ($request->file('profile_photo') != null){
            $photo = $request->file('profile_photo');
            $newPhotoName = rand(). '.' . $photo->getClientOriginalExtension();
            $newPhotoName = '/img/profile_img/'.$newPhotoName;
            $photo->move(public_path('/img/profile_img/'), $newPhotoName);
            $profile->profile_photo = $newPhotoName;
        }
        
        $profile->user_id = $user_id;
        $profile->profile_city = $request->profile_city;
        $profile->profile_city_range = $request->profile_city_range;
        $profile->profile_county = $request->profile_county;
        $profile->profile_county_mobile = $request->profile_county_mobile;
        $profile->profile_region = $request->profile_region;
        $profile->profile_region_mobile = $request->profile_region_mobile;
        $profile->profile_country_mobile = $request->profile_country_mobile;
        $profile->profile_google = $request->profile_google;
        $profile->profile_google_visible = $request->profile_google_visible;
        $profile->profile_linkedin = $request->profile_linkedin;
        $profile->profile_google = $request->profile_linkedin_visible;
        $profile->profile_viadeo = $request->profile_viadeo;
        $profile->profile_viadeo_visible = $request->profile_viadeo_visible;
        $profile->profile_facebook = $request->profile_facebook;
        $profile->profile_facebook_visible = $request->profile_facebook_visible;
        
 
        $profile->save();

        Session::flash('msg', 'Votre profil complet a bien été créé');
        
        return redirect('/profile/'. Auth::user()->slug);
        
    }

    public function getProfile($slug) {
        $user = Auth::user();
        $id = Auth::id();
        $profile = UserProfileModel::where('user_id', $id)->first();     
        return view('profile_index')->withProfile($profile)->withUser($user);
    }

    public function editStep1($id) {
        $user = User::find($id);
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
        $profile->free = $request->profile_free;
        $profile->search_job = $request->profile_search;
        $profile->listen = $request->profile_listen;
        $profile->notice = $request->profile_notice;
        $profile->percentage = $request->profile_percentage;
        $profile->visible_on_web = $request->profile_visible_on_web;
        $profile->visible_on_website = $request->profile_visible_on_website;
        $profile->searched_job = $request->searched_job;
        $profile->actuel_job = $request->actuel_job;
        $profile->actual_company = $request->actual_company;
        $profile->status_job = $request->status_job;
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
        $profile = UserProfileModel::where('user_id', $user->id)->first();
        return view ('profile_edit_step2')->withProfile($profile);
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
        
        $profile->user_id = $user_id;
        $profile->profile_city = $request->profile_city;
        $profile->profile_city_range = $request->profile_city_range;
        $profile->profile_county = $request->profile_county;
        $profile->profile_county_mobile = $request->profile_county_mobile;
        $profile->profile_region = $request->profile_region;
        $profile->profile_region_mobile = $request->profile_region_mobile;
        $profile->profile_country_mobile = $request->profile_country_mobile;
        $profile->profile_google = $request->profile_google;
        $profile->profile_google_visible = $request->profile_google_visible;
        $profile->profile_linkedin = $request->profile_linkedin;
        $profile->profile_google = $request->profile_linkedin_visible;
        $profile->profile_viadeo = $request->profile_viadeo;
        $profile->profile_viadeo_visible = $request->profile_viadeo_visible;
        $profile->profile_facebook = $request->profile_facebook;
        $profile->profile_facebook_visible = $request->profile_facebook_visible;
 
        $profile->save();

        Session::flash('msg', 'Votre profil complet a bien été mis à jour');
        
        return redirect('/profile/'. Auth::user()->slug);

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
