<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use Session;

class CategoryController extends Controller
{

    // Cette méthode protége l'ensemble des routes afin
    // que seul l'admin puisse y accéder
    public function __construct() {
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display toutes les catégories
        // il y aura aussi un formualire dessus
        $categories = CategoryModel::all();
        return view ('index_categories')->withCategories($categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save la nouvelle catégorie et redirect vers l'index
        // Validation du formulaire categorie_create
        $validatesData = $request->validate([
            'category_name' => 'required|max:255',
        ]);

        // Save dans DB si validation OK
        $category = new CategoryModel;
        $category->category_name = $request->category_name;
        $category->save();

        // On créé un flash message qui sera envoyé à la prochaine view (only once)
        Session::flash('msg', 'La catégorie a bien été sauvée dans le base de données');
        
        // redirection vers la page souhaitée
        return redirect('/categories/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CategoryModel::find($id);
        $category->delete();

        // On indique que tout s'est bien passé via un flas message
        Session::flash('msg', 'La catégorie a bien été supprimé de la base de données');

        return redirect()->route('categories.index');
    }
}
