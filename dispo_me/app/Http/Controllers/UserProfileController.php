<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfileModel;
use App\SkillTagModel;
use App\User;
use Session;

class UserProfileController extends Controller
{
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
        Session::flash('msg', 'Votre profil a bien été créé');
        return redirect('/profile/'.Auth::user()->slug);
    }

    public function getProfile($slug) {
        $user = Auth::user();
        $id = Auth::id();
        $profile = UserProfileModel::where('user_id', $id)->first();     
          
        return view('profile_index')->withProfile($profile)->withUser($user);
    }

    public function edit($id) {
        $user = User::find($id);
        $profile = UserProfileModel::where('user_id', $user->id)->first();
        $skills = SkillTagModel::all();  
        return view ('profile_edit_step1')->withProfile($profile)->withSkills($skills);
    }

    public function update(Request $request, $id) {
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
        return redirect('/profile/'.Auth::user()->slug);
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
