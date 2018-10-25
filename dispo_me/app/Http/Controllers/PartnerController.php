<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use Session;

class PartnerController extends Controller
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
        $partners = Partner::orderBy('ranking')->get();
        return view('partner_index')->withPartners($partners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partner_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation du formulaire partner_create
        $validatesData = $request->validate([
            'network_name' => 'required|unique:partners,network_name|max:255',
            'active' => 'required|boolean',
            'ranking' => 'required|unique:partners,ranking',
            'icon' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        $icon = $request->file('icon');
        
        $newIconName = rand(). '.' . $icon->getClientOriginalExtension();
        $newIconName = 'img/partners_icon/'.$newIconName;
        $icon->move(public_path('img/partners_icon'), $newIconName);

        $partner = new Partner;
        $partner->network_name = $request->network_name;
        $partner->active = $request->active;
        $partner->ranking = $request->ranking;
        $partner->icon = $newIconName;

        $partner->save();

        Session::flash('msg', 'Le partenaire a bien été créé dans le base de données');

        // redirection vers la page souhaitée
        return redirect()->route('partners.index');

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = Partner::find($id);

        return view('partner_edit')->withPartner($partner);
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
        
        // Validation du formulaire partner_edit
        $validatesData = $request->validate([
            'network_name' => 'required|max:255',
            'active' => 'required|boolean',
            'ranking' => 'required',
            'icon' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $icon = $request->file('icon');
        
        $newIconName = rand(). '.' . $icon->getClientOriginalExtension();
        $newIconName = 'img/partners_icon/'.$newIconName;
        $icon->move(public_path('img/partners_icon'), $newIconName);

        $partner = Partner::find($id);
        // On efface l'icone du partenaire avant d'update le partenaire en tant que tel
        unlink($partner->icon);
        $partner->network_name = $request->network_name;
        $partner->active = $request->active;
        $partner->ranking = $request->ranking;
        $partner->icon = $newIconName;

        $partner->save();

        Session::flash('msg', 'Le partenaire a bien été updaté dans le base de données');

        // redirection vers la page souhaitée
        return redirect()->route('partners.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);

        // On efface l'icone du partenaire avant de supprimer le partenaire en tant que tel
        unlink($partner->icon);

        // On efface le partenaire
        $partner->delete();

        // On indique que tout s'est bien passé via un flas message
        Session::flash('msg', 'Le partenaire a bien été supprimé de le base de données');

        return redirect()->route('partners.index');
    }
}
