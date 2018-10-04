<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfileModel;
use App\SkillTagModel;
use Session;

class UserProfileController extends Controller
{
    public function getStep1() {
        $tags = SkillTagModel::all();
        return view('profile_create_step1')->withTags($tags);
    }

    public function storeStep1(Request $request) {
        // dd($request);
        // Validation du formulaire profile_step1
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
        // On appelle la methode tags de UserProfileModel afin de lier
        //sur la table user_skill_tags le profile_id de la table user_profile
        // et le skill_tag_id dans la mếme table
        $profile->tags()->sync($request->skill_tags, false);
        Session::flash('msg', 'Votre profil a bien été créé');
        return redirect('/');
    }

    public function getProfile($slug) {
        $user = Auth::user();
        $id = Auth::id();
        $profile = UserProfileModel::where('user_id', $id)->first();     
          
        return view('profile_index')->withProfile($profile)->withUser($user);
    }
}
