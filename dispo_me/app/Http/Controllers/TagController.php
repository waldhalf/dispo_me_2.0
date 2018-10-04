<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SkillTagModel;
use Session;

class TagController extends Controller
{

    // Cette méthode protége l'ensemble des routes afin
    // que seul l'admin puisse y accéder
    public function __construct() {
        $this->middleware('is_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = SkillTagModel::orderBy('skill_name', 'ASC')->paginate(8);
        
        return view('tags_index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('skill_name' => 'required|max:255|unique:skill_tags,skill_name'));

        $tag = new SkillTagModel;
        $tag->skill_name = $request->skill_name;

        $tag->save();

        Session::flash('msg', 'La compétence a été ajoutée à la base de données');

        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = SkillTagModel::orderBy('skill_name', 'ASC')->paginate(8);
        $edited = SkillTagModel::find($id);
        
        return view('tags_edit')->withTags($tags)->withEdited($edited);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $skill = SkillTagModel::find($id);

        $this->validate($request, array('skill_name' => 'required|max:255|unique:skill_tags,skill_name'));

        $skill->skill_name = $request->skill_name;
        $skill->save();

        Session::flash('msg', 'La compétence a été modifié en base de données');

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = SkillTagModel::find($id);
        // On enléve de la base référentielle les occurences du skill_tags
        // Comme il s'agit de foreign key si on ne fait pas ce detach avant 
        // on ne peut pas delete le tag du fait de la contrainte SQL
        $tag->userProfile()->detach();
        $tag->delete();

        // On indique que tout s'est bien passé via un flash message
        Session::flash('msg', 'Le tag a bien été supprimé de la base de données');

        return redirect()->route('tags.index');
    }
}
