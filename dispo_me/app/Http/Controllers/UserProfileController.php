<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfileModel;

class UserProfileController extends Controller
{
    public function getStep1() {
        return view('step1_profile');
    }

    public function storeStep1(Request $request) {

        // Validation du formulaire profile_step1
        $validatesData = $request->validate([
            'profile_free'              => 'required',
            'profile_search'            => 'required',
            'profile_listen'            => 'required',
            'profile_notice'            => 'required|integer',
            'profile_percentage'        => 'required|integer|min:0|max:100',
            'profile_visible_on_web'    => 'required',
            'profile_visible_on_website'=> 'required',
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
        $profile->save();

        return redirect('/');
    }

    public function getProfile() {
        return view('get_profile_step_1');
    }
}
